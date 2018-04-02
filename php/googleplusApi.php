<?php 
	/*require "php/instagram.php";
	
	$Instagram= new Instagram_Api();
	class Instagram_Api
	{
		public $api;

		public function __CONSTRUCT(){

			$this->api = new Api_Key();

		}

		public function getLoginURL(){
			return("https://api.instagram.com/oauth/authorize/?client_id=".$api->key['Client_Id']."&redirect_uri=".$api->key['RedirectURL']."&response_type=code")


		}


		
	}*/

	llamar_instagarm();

	function llamar_instagarm()
	{

		$key =  array('Client_Id' => 'e90baeb390e14189a0b0a055683b48a7',
					'Client_Secret' => '8ae870aff8174428909cf24d89305377',
					'RedirectURL' => 'http://127.0.0.1/boss'
					);

		$json = file_get_contents("https://api.instagram.com/oauth/authorize/?client_id=".$key['Client_Id']."&redirect_uri=".$key['RedirectURL']."&response_type=code");

		echo $json;

	}



 ?>