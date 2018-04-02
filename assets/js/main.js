$(function(){
	// api key de facebook
	var app_id = '344000776100300';
	var scopes = 'email,user_friends,public_profile';
	

	var btn_login = '<ul class="actions" id="logout_facebook"><li><a href="#" class="button">Cerrar sesion</a></li></ul>';
	var btn_login_instagram = '<ul class="actions" id="logout_instagram"><li><a href="#" class="button">Cerrar sesion</a></li></ul>';

	/*var div_session = '<div id="facebook-session">'+
					   '<strong></strong>'+
					   '<img />'+
					   '<li><a href="#" id="logout" class="fa-facebook">Cerrar sesion</a></li>'+
					   '</div>';*/


	window.fbAsyncInit = function() {
	    FB.init({
	      appId      : app_id,
	      cookie     : true,  
	      status     : true,                    
	      xfbml      : true,  
	      version    : 'v2.8'
	    });   

	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response, function(){

	      });
	    });

  	};

  	var statusChangeCallback= function(response, callback) {
	    //console.log('statusChangeCallback');
	    console.log(response);
	   
	    if (response.status === 'connected') {
	     	getFacebookData();
	      //testAPI();
	    } else {
	     
	      callback(false);
	    }
  	}

  	var checkLoginState = function(callback) {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response, function(data){
	      	//console.log(data);
	      	callback(data);
	      });
	    });
  	}

  	var getFacebookData = function(){
  		FB.api('/me', function(response){  		
  			$('#bienvenido').text('Bienvenido '+response.name);
  			$('#imagen img').attr('src','http://graph.facebook.com/'+response.id+'/picture?type=large');
  			$('#sesion').html(btn_login);
  			$('#redes_sociales').text('Facebook');
  			
  		});  		
  	}

  	var FacebookLogin = function(){
  		checkLoginState(function(response){

  			if(! response){
  				FB.login(function(response){
  					if(response.status==='connected'){
  						getFacebookData();
  					}
  				}, {scope : scopes });

  			}
  			else{
  				//console.log(response);
  			}

  		});
  	}

  	var FacebookLogout = function(){
  		 FB.getLoginStatus(function(response) {

  		 	if(response.status === 'connected'){
  		 		FB.logout(function(response){

  		 			$('#logout').remove();
  		 			$('#bienvenido').remove();
		  			$('#imagen img').attr('src','images/avatar.jpg');
		  			$('#sesion').remove();
		  			$('#redes_sociales').remove();
		  			window.location.href='http://localhost/boss/index.php'; 	  			

  		 		});

  		 	}
  		 });
  	}


  	$(document).on('click', '#loging_facebook', function(event) {
  		event.preventDefault();
  		FacebookLogin();
  	});

  	$(document).on('click', '#logout_facebook', function(event) {
  		event.preventDefault();
  		if(confirm("¿Estas seguro cerrar sesion ?"))
  			FacebookLogout();

  		else
  			return false;
  	});

  	$(document).on('click', '#logout_instagram', function() {
  		if(confirm("¿Estas seguro cerrar sesion ?")){
  			$('#bienvenido').remove();
  		 	$('#imagen img').attr('src','images/avatar.jpg');
  		 	$('#sesion').remove();
  		 	$('#redes_sociales').remove();
  		 	window.location.href='http://localhost/boss/index.php';
  		} 			

  		else
  			return false;
  	});


  	$(document).on('click', '#loging_instagram', function() {

  		 $.getJSON('https://api.instagram.com/v1/users/self/?access_token=319395559.e90baeb.602d30410fc64784afaea8c3dc207879',function(data){
  		 	var data=data.data;
  		 	console.log(data);
  		 	$('#bienvenido').text('Bienvenido '+data.full_name);
  		 	$('#imagen img').attr('src',data.profile_picture);
  		 	$('#sesion').html(btn_login_instagram);
  		 	$('#redes_sociales').text('Instagram');
  		 }); 
  		
  	});


  	$(document).on('click','#logout_linkedin', function(){


  		/*var url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id="+client_id+"&redirect_uri="+redirect_url+"&state="+crst_token;

  		var url2 = "https://www.linkedin.com/oauth/v2/accessToken?grant_type=&client_id=&client_secret"

  		window.open(url,'_blank');*/

  		if(confirm("¿Estas seguro que quieres salir ? ")){
  			$('#bienvenido').remove();
  		 	$('#imagen img').attr('src','images/avatar.jpg');
  		 	$('#sesion').remove();
  		 	$('#redes_sociales p').remove();
  		 	window.location.href='http://localhost/boss/index.php';

  		}
  		else
  			return false;
  		

  	});




});
