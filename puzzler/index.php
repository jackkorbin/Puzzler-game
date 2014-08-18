<?php

session_start();

require_once( '../Facebook/FacebookSession.php' );
require_once( '../Facebook/FacebookRedirectLoginHelper.php' );
require_once( '../Facebook/FacebookRequest.php' );
require_once( '../Facebook/FacebookResponse.php' );
require_once( '../Facebook/FacebookSDKException.php' );
require_once( '../Facebook/FacebookRequestException.php' );
require_once( '../Facebook/FacebookAuthorizationException.php' );
require_once( '../Facebook/GraphObject.php' );
require_once( '../Facebook/GraphUser.php' );
require_once( '../Facebook/GraphSessionInfo.php' );
 
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

$helper = new FacebookRedirectLoginHelper('http://lykpic.com/puzzler/index.php');

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

<title>Puzzler</title>

<!-- Bootstrap -->
<link href="../style/bootstrap.css" rel="stylesheet">
<link href="../style/bootstrap-theme.min.css" rel="stylesheet">
<link href="../style/bootstrap-social-buttons/bootstrap-social.css" rel="stylesheet">
<link href="../style/bootstrap-social-buttons/font-awesome.css" rel="stylesheet">
<link href="../style/font-awesome/css/font-awesome.css" rel="stylesheet" >
<link href="../style/whole.css" rel="stylesheet">
<link href="style/custom.css" rel="stylesheet">




<style>
    body{
        background:#8ec1da url(../images/2.jpg) no-repeat center center fixed;
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
            <span class="link">Also try <a href="../wordmaster" target="_blank">Word Master</a></span>
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
            <span class="link">Also try <a href="../wordmaster" target="_blank">Word Master</a></span>
        </div>
    </header>
';
}
?>

<div class="custom-container row">
    
  
    
    
    
    <div class="col-sm-5 puzzle">
    
        <div class="row">
            <div class="box col-xs-4 box1">
                <img src="puzzleimages/1/1.jpg" class="img-responsive">
            </div>

            <div class="box col-xs-4 box2">
                <img src="puzzleimages/1/2.jpg" class="img-responsive">
            </div>

            <div class="box col-xs-4 box3">
                <img src="puzzleimages/1/3.jpg" class="img-responsive">
            </div>
        </div>

        <div class="row">
            <div class="box col-xs-4 box4">
                <img src="puzzleimages/1/4.jpg" class="img-responsive">
            </div>

            <div class="box col-xs-4 box5">
                <img src="puzzleimages/1/5.jpg" class="img-responsive">
            </div>

            <div class="box col-xs-4 box6">
                <img src="puzzleimages/1/6.jpg" class="img-responsive">
            </div>
        </div>

        <div class="row">
            <div class="box col-xs-4 box7">
                <img src="puzzleimages/1/7.jpg" class="img-responsive">
            </div>

            <div class="box col-xs-4 box8">
                <img src="puzzleimages/1/8.jpg" class="img-responsive">
            </div>

            <div class="box col-xs-4" id="cursor">
                <i class="fa fa-arrow-down"></i>
                <i class="fa fa-arrow-up"></i>
                <i class="fa fa-arrow-left"></i>
                <i class="fa fa-arrow-right"></i>
            </div>
        </div>
        
    </div>
   
    
    <div class="col-sm-2 buttons">
    
        <div class="btn btn-info btn-lg btn-block changeimg">Change Image</div>
        <div class="btn btn-warning btn-lg btn-block random">Scramble</div>
        <div class="btn btn-danger btn-lg btn-block resetimg" disabled>Reset</div>
        
        <div class="score">
            Your score : <span>0000</span>
        </div>
        <div class="h-score">
            Highest score : <span>0000</span>
        </div>
        
        <div class="timer">
            <div class="time">
                <!--<span class="hour">00</span> :-->
                <span class="min">00</span> :
                <span class="sec">00</span> :
                <span class="milisec">00</span>
            </div>
            <div class="row">
                <!--
                <div class="col-sm-6">
                    <div class="btn btn-success btn-lg btn-block starttimer">Start</div>
                </div>
                -->
                <div class="col-sm-12">
                    <div class="btn btn-primary btn-lg btn-block stoptimer">Pause</div>
                </div>
                <!--
                <div class="col-sm-12">
                    <div class="btn btn-danger btn-lg btn-block resettimer">Reset Timer</div>
                </div>
                -->
            </div>
        </div>
        
    </div>
    
    <div class="col-sm-5 whole">
        <img src="puzzleimages/1/puzzle.jpg" class="img-responsive">
    </div>
    
   
    
 
</div>
    

    

    

    
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../javascript/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../javascript/bootstrap.min.js"></script>

<script src="javascript/custom.js"></script> 
    
    
</body>
</html>

