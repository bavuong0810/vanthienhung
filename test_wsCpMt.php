<?php
	class SmsBrandnameProvider {

		private $userName;
		private $password;
		private $parameters = array();

		const SERVICE_URI = 'http://ams.tinnhanthuonghieu.vn:8009/bulkapi?wsdl';
				
		const TEST_USER = 'smsbrand_vanthienhug';
		const TEST_PASS = '123456a@';
		const TEST_CPCODE = 'VANTHIENHUNG';
		const TEST_ALIAS = 'vanthienhug';
		
		/**
		 * Function to handle SMS Send operation
		 * @param <String> $message
		 * @param <String> $toNumbers One number
		 */
		public function sendBulkSms($message, $toNumbers) {
				$client = new SoapClient(self::SERVICE_URI);
				$params = array(    "User" => self::TEST_USER,    "Password" => self::TEST_PASS,    "CPCode" => self::TEST_CPCODE,    "RequestID" => "1",    "UserID" => $toNumbers,     "ReceiverID" => $toNumbers,    "ServiceID" => self::TEST_ALIAS,    "CommandCode" => "bulksms",    "Content" => $message,    "ContentType" => "0"     );
				$response = $client->__soapCall("wsCpMt", array($params));
				return $response;
		}
	}

	$obj = new SmsBrandnameProvider();
	var_dump($obj->sendBulkSms('Cam on quy khach da quan tam san pham tai vanthienhung.vn, yeu cau ca quy khach da duoc tiep nhan.','84964155769'));
?>  