<?php

session_start();

require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'Facebook/GraphSessionInfo.php' );
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

$id = '696921913720819';
$secret = 'dbeeb743f2808522f4bef123090e6024';

FacebookSession::setDefaultApplication($id, $secret);

$helper = new FacebookRedirectLoginHelper('http://lykpic.com/index.php');

try{
	$session = $helper->getSessionFromRedirect();
}catch(Exception $e){
	
}

if(isset($_SESSION['token'])){
	$session = new FacebookSession($_SESSION['token']);
	
	try{
		$session->Validate($id, $secret);
	}catch(FacebookAuthorizationException $e){
		$session = '';
	}
}
?>




<html>
<head>

<title>Lykpic Games</title>

<!-- Bootstrap -->
<link href="style/bootstrap.css" rel="stylesheet">
<link href="style/bootstrap-theme.min.css" rel="stylesheet">
<link href="style/bootstrap-social-buttons/bootstrap-social.css" rel="stylesheet">
<link href="style/bootstrap-social-buttons/font-awesome.css" rel="stylesheet">
<link href="style/font-awesome/css/font-awesome.css" rel="stylesheet" >
<link href="style/whole.css" rel="stylesheet">
<link href="style/home.css" rel="stylesheet">




<style>
    body{
        background:#8ec1da url(images/b2.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        font-weight:normal;
    }
</style>

</head>
<body>
    
    
<?php 

if(isset($session)){
	$_SESSION['token'] = $session->getToken();
   
    $request = (new FacebookRequest( $session, 'GET', '/me' ))->execute();

    $user = $request->getGraphObject()->asArray();
    //echo print_r($user);
    $request = (new FacebookRequest( $session, 'GET', '/me/picture?type=large&redirect=false' ))->execute();
    $picture = $request->getGraphObject()->asArray();
    echo '
    <header>
        <div class="nav navbar-default fixed-top bar">
            Welcome, '.$user['name'].'
            <div class="img-box">
                <img src="'.$picture->url.'" class="img-responsive user">
            </div>
        </div>
    </header>
    ';
}
else{
     echo '
    <header>
        <div class="nav navbar-default fixed-top bar">
            <a href = ' . $helper->getLoginUrl() . ' class="btn btn-social btn-lg btn-facebook custom-social-btn">
              <i class="fa fa-facebook"></i>
              Connect with Facebook
            </a>
        </div>
    </header>
';
}
?>

<div class="custom-container row home">
    
  
    <div class="col-sm-8 ourgames">
        <div class="overlay game">
            <i class="fa fa-rocket"></i>
            Our Games
        </div>
        <div class="content">
            <!--
            <div class="newgame row">
                <div class="gameimg col-sm-2">
                    <img src="images/2.jpg" class="img-responsive">
                </div>
                <div class="gamename col-sm-8">
                    Puzzler
                </div>
            </div>
            
            <div class="newgame row">
                <div class="gameimg col-sm-2">
                    <img src="images/2.jpg" class="img-responsive">
                </div>
                <div class="gamename col-sm-8">
                    Wordmaster
                </div>
            </div>
            -->
            
            <div class="row">
                <div class="col-sm-6">
                    <a href="bouncingballs/" target="_blank"><div class="newgame row">
                        <img src="bouncingballs/thumbnail.jpg" class="img-responsive">
                        <span>Bouncing Balls</span>
                        <div>Play Now</div>
                    </div></a>
                </div>
                <div class="col-sm-6">
                    <a href="hungerballs/" target="_blank"><div class="newgame row">
                        <img src="hungerballs/thumbnail.jpg" class="img-responsive">
                        <span>Hunger Balls</span>
                        <div>Play Now</div>
                    </div></a>
                </div>
                <div class="col-sm-6">
                    <a href="wordmaster/" target="_blank"><div class="newgame row">
                        <img src="wordmaster/thumbnail.jpg" class="img-responsive">
                        <span>Wordmaster</span>
                        <div>Play Now</div>
                    </div></a>
                </div>
                <div class="col-sm-6">
                    <a href="puzzler/" target="_blank"><div class="newgame row">
                        <img src="puzzler/thumbnail.jpg" class="img-responsive">
                        <span>Puzzler</span>
                        <div>Play Now</div>
                    </div></a>
                </div>
                
                
            </div>
            
        
               
        </div>
    </div>
    <div class="col-sm-4">
        
        <div class="row aboutus">
            <div class="overlay about">
                <i class="fa fa-tags"></i>
                About us
            </div>
            <div class="content">
                We are small Javascript developers, we love to make and share creative web games for fun.
            </div>
        </div>
        <div class="row joinus">
            <div class="overlay join">
                <i class="fa fa-users"></i>
                Join us
            </div>
            <div class="content">
                Feel free to contact/message us on<br>
                <a href="http://www.facebook.com/tanuj304" target="_blank"> Facebook</a><br>
                <a href="https://plus.google.com/111915683621684516030" target="_blank"> Google+</a>
            </div>
        </div>
    
    </div>
   
    
 
</div>
    

    

    

    
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="javascript/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="javascript/bootstrap.min.js"></script>

<script src="javascript/custom.js"></script> 
    
    
</body>
</html>

