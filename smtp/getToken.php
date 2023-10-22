<?php
require __DIR__ . '/php-gmail/vendor/autoload.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
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
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = 'token.json';
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
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);

// // Print the labels in the user's account.
// $user = 'me';
// $results = $service->users_labels->listUsersLabels($user);

// if (count($results->getLabels()) == 0) {
//   print "No labels found.\n";
// } else {
//   print "Labels:\n";
//   foreach ($results->getLabels() as $label) {
//     printf("- %s\n", $label->getName());
//   }
// }

function encodeRecipients($recipient){
    $recipientsCharset = 'utf-8';
    if (preg_match("/(.*)<(.*)>/", $recipient, $regs)) {
        $recipient = '=?' . $recipientsCharset . '?B?' . base64_encode($regs[1]) . '?= <' . $regs[2] .'>';
    }
    return $recipient;
}


$user = 'me';
$from = 'xe.xenang@gmail.com';
$to = 'minhtranfu@gmail.com';
$boundary = uniqid(rand(), true);
$subjectCharset = $charset = 'utf-8';
$message = '<h1 style="color:red;">ahihi đồ ngốc chào mấy bạn nhé ahihihihi</h1>';
$strSubject = 'Re:Test send email lần 2';
$strRawMessage = "From: " . encodeRecipients("Vân Thiên Hùng <".$from.">") . "\r\n";
$strRawMessage .= "To:  <".$to.">\r\n";
$strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($strSubject) . "?=\r\n";
$strRawMessage .= "MIME-Version: 1.0\r\n";
$strRawMessage .= 'Content-type: Multipart/Mixed; boundary="' . $boundary . '"' . "\r\n"; //"Content-Type: text/html; charset=utf-8\r\n"
//$strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";

//$filePath = 'test.pdf';
//$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
//$mimeType = finfo_file($finfo, $filePath);
//$fileName = 'abc.pdf';
//$fileData = base64_encode(file_get_contents($filePath));
//
//$strRawMessage .= "\r\n--{$boundary}\r\n";
//$strRawMessage .= 'Content-Type: '. $mimeType .'; name="'. $fileName .'";' . "\r\n";
//$strRawMessage .= 'Content-ID: <' . $from . '>' . "\r\n";
//$strRawMessage .= 'Content-Description: ' . $fileName . ';' . "\r\n";
//$strRawMessage .= 'Content-Disposition: attachment; filename="' . $fileName . '"; size=' . filesize($filePath). ';' . "\r\n";
//$strRawMessage .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
//$strRawMessage .= chunk_split(base64_encode(file_get_contents($filePath)), 76, "\n") . "\r\n";
//$strRawMessage .= "--{$boundary}\r\n";
$strRawMessage .= 'Content-Type: text/html; charset=' . $charset . "\r\n";
$strRawMessage .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
$strRawMessage .= $message."\r\n";

// The message needs to be encoded in Base64URL
$mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
$msg = new Google_Service_Gmail_Message();
$msg->setRaw($mime);
//The special value **me** can be used to indicate the authenticated user.
$service->users_messages->send("me", $msg);
