<?php
// session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
// $clientId = '576215159453-45c2ol95ink6kdt6mcgtbk28mevqj1ej.apps.googleusercontent.com';
$clientId = '535270179120-nijbnm2n201n6asruu2l0j05ehtng61r.apps.googleusercontent.com';
// $clientSecret = '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';
$clientSecret = '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';
$redirectURL = 'http://irul20176.domcloud.io/login.php';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to SewaKuy');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>