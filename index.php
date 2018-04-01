<?php 

	//include "php/callback.php";

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
		$redirect_url = "http://127.0.0.1/boss/index.php";
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
			

			$url2 = "https://api.linkedin.com/v1/people/~:(id,firstName,lastName,pictureUrl)?format=json&oauth2_access_token=".$token->access_token;

			 $json= json_decode(file_get_contents($url2));
			//print_r ($json);

		}
?>
<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Identity by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>		

	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">

						<header>
							<span class="avatar" id="imagen" > <img src='<?php echo $json != "" ? "".$json->pictureUrl : "images/avatar.jpg"  ?>'></span>
							<h1 id="bienvenido"><?php echo $json != "" ? "Bienvenido ".$json->firstName." ".$json->lastName : "" ?> </h1>
							<div id="linkedin"> <?php echo $json != "" ? '<ul class="actions" id="logout_linkedin"><li><a href="#" class="button">Cerrar sesion</a></li></ul>' : "" ?> </div>
							<p>Conexion con la redes sociales</p>
							<div id="sesion"></div>

						</header>
						
						<hr />
						<!--<h2>Register</h2>					

							
						<form method="post" action="#">
							<div class="field">
								<input type="text" name="name" id="name" placeholder="Name" />
							</div>
							<div class="field">
								<input type="email" name="email" id="email" placeholder="Email" />
							</div>
							<div class="field">
								<input type="password" name="password" id="password" placeholder="Password" />
							</div>
							<div class="field">
								<div class="select-wrapper">
									<select name="department" id="department">
										<option value="">Department</option>
										<option value="sales">Sales</option>
										<option value="tech">Tech Support</option>
										<option value="null">/dev/null</option>
									</select>
								</div>
							</div>

							<div class="field">
								<textarea name="message" id="message" placeholder="Message" rows="4"></textarea>
							</div>
							<div class="field">
								<input type="checkbox" id="human" name="human" /><label for="human">I'm a human</label>
							</div>
							<div class="field">
								<label>But are you a robot?</label>
								<input type="radio" id="robot_yes" name="robot" /><label for="robot_yes">Yes</label>
								<input type="radio" id="robot_no" name="robot" /><label for="robot_no">No</label>
							</div>
							<ul class="actions">
								<li><a href="#" class="button">Get Started</a></li>
							</ul>
						</form>
						<hr />-->
						<strong></strong>
						
						<footer>
							<ul class="icons">
								<li><a href="#" class="fa-twitter">Twitter</a></li>
								<li><a href="#" id="loging_instagram" class="fa-instagram">Instagram</a></li>
								<li><a href="#" id="loging_facebook" class="fa-facebook">Facebook</a></li>
								<li><a href="#" class="fa-google-plus">Google+</a></li>
								<li><a href="https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=780ij8njuz45pr&redirect_uri=http://127.0.0.1/boss/index.php&state= <?php echo $crst_token ?>"  class="fa-linkedin">Linkedin</a></li>
								
							</ul>
						</footer>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>&copy; Erick Brito</li><li>Programador: <a href="http://html5up.net">BiNext</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>
			<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
			<script src="assets/js/main.js" type="text/javascript"></script>
			<script>
				// Load the SDK asynchronously
			  	(function(d, s, id) {
			    var js, fjs = d.getElementsByTagName(s)[0];
			    if (d.getElementById(id)) return;
			    js = d.createElement(s); js.id = id;
			    js.src = "https://connect.facebook.net/es_LA/sdk.js";
			    fjs.parentNode.insertBefore(js, fjs);
			  }(document, 'script', 'facebook-jssdk'));
			</script>
			
	</body>
</html>