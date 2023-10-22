<?php

/**
 * Class to send SMS via VietGuys
 * 
 */

class VietGuysSMS
{
  const ENDPOINT_CSKH = 'https://cloudsms4.vietguys.biz:4438/api/index.php';
  const ENDPOINT_AD = 'https://qc.vietguys.biz/api/sendsms.php';
  var $from;
  var $account;
  var $pass;

  public function __construct(array $config = [
    'from' => 'VIETGUYS',
    'u' => 'your_account',
    'pwd' => 'code',
  ])
  {
    $this->from = $config['from'];
    $this->account = $config['u'];
    $this->pass = $config['pwd'];
  }

  public static function postData(String $url, array $data)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }

  public function sendCSKH(String $phone, String $content = null)
  {
    $data = [
      'from' => $this->from,
      'u' => $this->account,
      'pwd' => $this->pass,
      'phone' => $phone,
      'sms' => $content,
      'bid' => time() . $phone,
      'type' => '8',
      'json' => '1',
    ];

    return VietGuysSMS::postData(VietGuysSMS::ENDPOINT_CSKH, $data);
  }

  public function sendAD(String $phone, String $content = null)
  {
    $data = [
      'phone' => $phone,
      'from' => $this->from,
      'sms' => $content,
      'u' => $this->account,
      'pwd' => $this->pass,
      'day' => date('yyyy-mm-dd'),
      'time' => date('hh:mm'),
      'json' => '1',
      'version' => '3',
    ];

    return VietGuysSMS::postData(VietGuysSMS::ENDPOINT_CSKH, $data);
  }
}
