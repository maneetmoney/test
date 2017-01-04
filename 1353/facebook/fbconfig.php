<?php
session_start();
// added in v4.0.0
require 'dbconfig.php';
require_once 'autoload.php';
//require 'functions.php'; // Include functions
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1532648536994849','17712406a208bad8b4724cc9054897a9' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://www.lifetimesathi.com/1353/facebook/fbconfig.php' );
    
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
 // echo "<pre>";
//  print_r($response);
//  echo "</pre>";
 // echo $response['name'];
 
  $graphObject = $response->getGraphObject();
     	 $fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
		 $fgender = $graphObject->getProperty('gender');
		 
		//  die();
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
		 $_SESSION['GENDER'] =  $fgender;
    /* ---- header location after session ----*/
	
	$check = "select * from shadi_user where Fuid='$fbid'";
	$qury =mysql_query($check);
	 $num = mysql_num_rows($qury);
	
	//die(); 
	
	if ($num==0) { // if new user . Insert a new record		
	$query = "INSERT INTO shadi_user (Fuid,Ffname,Femail,gender,user_name) VALUES ('$fbid','$fbfullname','$femail','$fgender','$fbfullname')";
	mysql_query($query);	
	} else {   // If Returned user . update the user record		
	$query = "UPDATE shadi_user SET Ffname='$fbfullname', Femail='$femail', Femail='$fgender' , user_name='$fbfullname' where Fuid='$fbid'";
	mysql_query($query);
	}
	
  header("Location: http://www.lifetimesathi.com/index.php");
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}


?>