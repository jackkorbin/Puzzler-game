<?php

if(isset($session)){
    

    $access_token = $session->getToken();

    $attachment =  array(
        'access_token' => $access_token,
        'message' => "xzzxc essage",
        'name' => "zx ame",
        'description' => "zxc x xzczxc ription",
        'link' => "http://www.magentocommerce.com/",
        'picture' => "http://sampleimage.com/images/logo.png",
        'actions' => array('name'=>'Try it now', 'link' => "$appUrl")
    );
    
    try{
        $post_id = $facebook->api("me/feed","POST",$attachment);
    }catch(Exception $e){
        error_log($e->getMessage());
    }
    
}


?>