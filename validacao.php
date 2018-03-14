<?php

  if (empty($_POST) AND (empty($_POST['login']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }

 try{
      
      $url = 'https://api.rafafreitas.com';
      # Our new data
      $data = array(
          'email' => $_POST["login"],
          'senha' => $_POST["senha"],
          'tipo' => '1',
      );
      $ch = curl_init($url.'/usuario/login');
      # Form data string
      $postString = http_build_query($data, '', '&');
      # Setting our options
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      # Get the response
      $response = curl_exec($ch);
      //curl_error($ch);
      //var_dump(curl_error($ch));
      //var_dump($response);

      curl_close($ch);
      $var = json_decode($response);

      if ($var->status == 500) {
        echo $var->result;
        
      }elseif ($var->status == 200) {
        session_cache_expire(30);
        session_start();

        $_SESSION['UsuarioID'] = $var->usuario->user_id;
        $_SESSION['UsuarioNome'] = $var->usuario->user_nome;
        $_SESSION['UsuarioLogin'] = $var->usuario->user_email;
        $_SESSION['API'] = $url;
        $_SESSION['Token'] = $var->token;

        echo 1;

      }else{
        echo "Ocorreu um erro no servidor!";
        //var_dump($var);
      }
      
  
   }
   catch(Exception $e){
      echo $e->getmessage();
   }


?>