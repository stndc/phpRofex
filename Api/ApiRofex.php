<?php

namespace Api;

class ApiRofex{

	public function __construct($username, $password){

		$this->username = $username;
		$this->password = $password;

	}

	public function get_token($url){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;

	}

	public function get_marketdata($url){

		$add_token = $this->get_token('https://api.remarkets.primary.com.ar/auth/getToken');
		$data = json_encode($add_token);

		$explode = explode(":", $data);
		$token = substr($explode[9], 0, -17);
		$cookie_id = $explode[17];

		$autho = [];
		$autho = 'Authorization: Bearer '.$token;

		$cookie = [];
		$cookie = 'Cookie: '.$cookie_id;

		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				$autho,
				$cookie,
				"Content-Type: application/json"
			),
		));

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;

	}

}

?>