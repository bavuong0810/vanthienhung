<?php
require __DIR__ . '/php-gmail/vendor/autoload.php';

function encodeRecipients($recipient)
{
    $recipientsCharset = 'utf-8';
    if (preg_match("/(.*)<(.*)>/", $recipient, $regs)) {
        $recipient = '=?' . $recipientsCharset . '?B?' . base64_encode($regs[1]) . '?= <' . $regs[2] . '>';
    }
    return $recipient;
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    $client->setScopes(Google_Service_Gmail::GMAIL_SEND);
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = __DIR__ . '/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            echo 'window.alert("Please contact admin to connect with GMail")';
            return null;
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

function sendmail($strSubject, $message, $from, $to, $tennguoigui, $attachments = null)
{
    $hasAttachment = !!$attachments;
    $boundary = uniqid(rand(), true);
    $client = getClient();

    if (!$client) {
        return false;
    }

    try {
        $service = new Google_Service_Gmail($client);
        //xe.xenang@gmail.com
        $senderPath = __DIR__ . '/email_admin.json';
        $sender = file_get_contents($senderPath);
        $tennguoigui.= " <".$sender.">";
        $strRawMessage = "From: " . encodeRecipients($tennguoigui) . "\r\n";

        $ccPath = __DIR__ . '/email_admin_cc.json';
        $Cc = file_get_contents($ccPath);
        if($Cc){
            $strRawMessage .= "Cc:  " . $Cc . "\r\n";
        }

        if (is_array($to)) {
            $bccs = array_map(function ($item) {
                return '<' . $item . '>';
            }, $to);
            $strRawMessage .= "Bcc:  " . implode(', ', $bccs) . "\r\n";
        } else {
            $strRawMessage .= "To:  <" . $to . ">\r\n";
        }
        $strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";
        $strRawMessage .= "MIME-Version: 1.0\r\n";
        if ($hasAttachment) {
            $strRawMessage .= 'Content-type: Multipart/Mixed; boundary="' . $boundary . '"' . "\r\n";
            foreach ($attachments as $attachment) {
                $filePath = $attachment['path'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
                $mimeType = finfo_file($finfo, $filePath);
                $fileName = $attachment['fileName'];
                $fileData = base64_encode(file_get_contents($filePath));

                $strRawMessage .= "\r\n--{$boundary}\r\n";
                $strRawMessage .= 'Content-Type: ' . $mimeType . '; name="' . $fileName . '";' . "\r\n";
                $strRawMessage .= 'Content-ID: <' . $from . '>' . "\r\n";
                $strRawMessage .= 'Content-Description: ' . $fileName . ';' . "\r\n";
                $strRawMessage .= 'Content-Disposition: attachment; filename="' . $fileName . '"; size=' . filesize($filePath) . ';' . "\r\n";
                $strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
                $strRawMessage .= chunk_split($fileData, 76, "\n") . "\r\n";
                $strRawMessage .= "--{$boundary}\r\n";
            }
        }
        $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
        $strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
        $strRawMessage .= $message . "\r\n";
        // The message needs to be encoded in Base64URL
        $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
        $msg = new Google_Service_Gmail_Message();
        $msg->setRaw($mime);
        //The special value **me** can be used to indicate the authenticated user.
        $service->users_messages->send("me", $msg);

        return true;
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
}
