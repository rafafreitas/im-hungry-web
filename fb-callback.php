<?php 
require_once 'lib/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '414679185647587', // Replace {app-id} with your app id
  'app_secret' => '84e62486fd0d31d865989fdf8f7ea53c',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

try {
  $accessToken = $helper->getAccessToken();

  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
  $user = $response->getGraphUser();
  $url = 'http://api.rafafreitas.com';

  $data = array(
    'email' => $user['email'],
    'senha' => $user['id'],
  );
  $ch = curl_init($url.'/web/usuario/login');

  $postString = http_build_query($data, '', '&');
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);

  curl_close($ch);
  $var = json_decode($response);

  if ($var->status == 500) {
    $data = array(
      'nome' => $user['name'],
      'email' => $user['email'], 
      'senha' => $user['id'], 
      'fot64' => "wait",
      'tipo_usuario' => "1",
      'enabled' => "1"
    );

    $data = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.'/web/adm/insert');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
      )
    );

    $response = curl_exec($ch);
    curl_close($ch);

    $var = json_decode($response);
    $json=json_encode($var);
    echo "$json";

    session_cache_expire(30);
    session_start();
    $_SESSION['UsuarioID'] = $var->usuario->user_id;
    $_SESSION['UsuarioNome'] = $var->usuario->user_nome;
    $_SESSION['UsuarioLogin'] = $var->usuario->user_email;
    $_SESSION['UsuarioNivel'] = $var->usuario->tipo_id;
    $_SESSION['API'] = $url;
    $_SESSION['Token'] = $var->token;
    
    header("location:red.php");
  }elseif ($var->status == 200) {
    session_cache_expire(30);
    session_start();

    $_SESSION['UsuarioID'] = $var->usuario->user_id;
    $_SESSION['UsuarioNome'] = $var->usuario->user_nome;
    $_SESSION['UsuarioLogin'] = $var->usuario->user_email;
    $_SESSION['UsuarioNivel'] = $var->usuario->tipo_id;
    $_SESSION['API'] = $url;
    $_SESSION['Token'] = $var->token;

    header("location:red.php");

  }else{
    echo "Ocorreu um erro no servidor!";
  }

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('414679185647587'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>
