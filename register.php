<?php include_once 'loginface.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Metas Tags -->
  <? include "assets/inc/metas.php"; ?>

  <!-- Title -->
  <? include "assets/inc/title_adm.php"; ?>

  <!-- Style -->
  <? include "assets/inc/styles.php"; ?>

</head>

<body class="app flex-row align-items-center">
  <div class="img-full-login">
    <div id="back-div"></div>
   <img src="assets/img/back.png">
  </div><!-- /.video-full -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mx-4">
          <div class="card-body p-4">
          <form class="form-horizontal" id="formRegister" enctype="multipart/form-data" >
            <h1>Cadastre-se</h1>
            <p class="text-muted">Crie sua conta</p>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="icon-user"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Nome" name="register-nome" id="register-nome" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" placeholder="E-mail" name="register-email" id="register-email" required>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="icon-lock"></i></span>
              </div>
              <input type="password" class="form-control" placeholder="Senha" name="register-senha-1" id="register-senha-1" required>
            </div>

            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="icon-lock"></i></span>
              </div>
              <input type="password" class="form-control" placeholder="Repetir Senha" name="register-senha-2" id="register-senha-2" required>
            </div>

            <button type="submit" class="btn btn-block btn-success" id="btnRegister" >Registrar Conta!</button>
            <button type="button" class="btn btn-block btn-warning" id="btnBackLogin" >Login!</button>

          </form>
          </div>
          <div class="card-footer p-4">
            <div align="center" class="row">
              <div class="col-6">
                  <a style="width: 120px;" href="<?php echo $loginUrl; ?>" class="btn btn-block btn-facebook" type="button">
                    <span>Facebook</span>
                  </a>
                </div>
                <div class="col-6">
                  <div class="g-signin2" data-onsuccess="onSignIn">Click here to sign in with google</div> 
                  <form action="google-callback.php" method="post" id="dateForm" target="_blank" onsubmit="self.close();"> 
                      <div class="data"> 
                          <input type="submit" value="Login"/> 
                      </div> 
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <? include "assets/inc/js.php"; ?>
  <script type="text/javascript" src="assets/inc/js/manterRegister.js"></script>

  <script src="https://apis.google.com/js/platform.js" async defer></script> 
    <meta name="google-signin-client_id" content="430825112141-2pbgqftnet7smu9k87vnqoibsh8mugn9.apps.googleusercontent.com"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <!--<script src="scrpt.js"></script>--> 
    <script>
    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      var nome = profile.getName();
      var email = profile.getEmail();
      var senha = profile.getId();
      var img = ('src', profile.getImageUrl());
      $.ajax({
        url:"google-callback.php",                    
        type:"post", 
        data: {
          nome : nome,
          email : email,
          senha : senha,
          img : img
        },
        success: function (result){
          if(result==1){
            window.location.href = 'red.php';
          }if (result !=1){
            $('#erroLogin').addClass('animated shake');
            $('#erroLogin').show();
            $("#erroLogin").html("<p class='text-center'>"+result+"</p>");
          }  
        }
      });
      return false;
    }
    </script> 
    <style> .g-signin2{ margin-top:0px;} .data{ display:none;} </style>

</body>
</html>