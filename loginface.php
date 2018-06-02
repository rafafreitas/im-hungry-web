<?php 
require_once 'lib/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '414679185647587', // Replace {app-id} with your app id
  'app_secret' => '84e62486fd0d31d865989fdf8f7ea53c',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://app.rafafreitas.com/fb-callback.php', $permissions);

//echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>
