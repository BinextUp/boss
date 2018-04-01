<?php 
	
	
	function curl($url,$datos){

		$data = curl_init();
		curl_setopt($data, CURLOPT_URL, $url);
		curl_setopt($data, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($data, CURLOPT_POSTFIELDS, $datos);
		curl_setopt($data, CURLOPT_POST, 1);
		$header = [];
		$header[] = "Content-Type: application/x-www-form-urlencoded";
		curl_setopt($data, CURLOPT_HTTPHEADER, $header);

		$result = curl_exec($data);
		return $result;
	}



		$client_id = "780ij8njuz45pr";
		$client_secret = "2RaXdVYRTyCtzgnL";
		$redirect_url = "http://127.0.0.1/boss/php/callback.php";
		$crst_token = random_int(111111111, 999999999);
		$scopes = "r_basicprofile,r_emailaddress";		

		if (isset($_REQUEST['code'])) {		

			$code_linkedin =$_REQUEST['code'];
			
			$url = "https://www.linkedin.com/oauth/v2/accessToken";
			$parametro= [
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				'redirect_uri' => $redirect_url,
				'code' => $code_linkedin,
				'grant_type' => 'authorization_code'
			];

		
			$token=json_decode(curl($url,http_build_query($parametro)));
			

			$url2 = "https://api.linkedin.com/v1/people/~:(id,firstName,lastName,pictureUrls::(original),publicProfileUrl)?format=json&oauth2_access_token=".$token->access_token;

			echo $json= file_get_contents($url2);
			

		}




	

	








 ?>