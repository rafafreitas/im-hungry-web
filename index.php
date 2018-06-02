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
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <form id="form-login">
                <h1>Login</h1>
                <p class="text-muted">Acesse com sua conta</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-user"></i></span>
                  </div>
                  <input type="text" id="in-email" class="form-control" placeholder="E-Mail">
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-lock"></i></span>
                  </div>
                  <input type="password" id="in-senha" class="form-control" placeholder="Senha">
                </div>
                <p id="erroLogin"></p>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" id="btn-login" class="btn btn-primary px-4">Login</button>
                  </div>
                  <div class="col-6 text-right">
                    <button type="button" class="btn btn-link btn-link-login px-0">Esqueceu a senha?</button>
                  </div>
                </div>
                <p/>
                <div class="row">
                  <div class="col-6">
                    <a style="width: 120px;" href="<?php echo $loginUrl; ?>" class="btn btn-block btn-facebook" type="button">
                      <span>Facebook</span>
                    </a>
                  </div>
                  <div class="col-6">
                    <div class="g-signin2" data-onsuccess="onSignIn">Click here to sign in with google</div> 
                    <form action="getdata.php" method="post" id="dateForm" target="_blank" onsubmit="self.close();"> 
                        <div class="data"> 
                            <input type="submit" value="Login"/> 
                        </div> 
                    </form>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card text-white bg-primary bg-login py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Inscreva-se</h2>
                <p>Ainda não possui cadastro? Faça como milhões de estabelecimentos e impulsione suas vendas com o poder de alcance do I`m Hungry. <br>É grátis!</p>
                <a href="register">
                  <button id="register-but" type="button" class="btn btn-primary active mt-3">Registrar Agora!</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <? include "assets/inc/js.php"; ?>
  <script>
        $(document).ready(function(){
          $('#erroLogin').hide();
          $('#form-login').submit(function() {
            $('#erroLogin').hide();
            var login=$('#in-email').val();
            var senha=$('#in-senha').val();
            $.ajax({
              url:"manter.php",                    
              type:"post", 
              data: {
                acao : "login",
                tipoAcao : "",
                login : login,
                senha : senha
              },
              success: function (result){
                if(result==1){             
                  location.href='red.php'
                }if (result !=1){
                  $('#erroLogin').addClass('animated shake');
                  $('#erroLogin').show();
                  $("#erroLogin").html("<p class='text-center'>"+result+"</p>");
                }  
              }
            });
            return false;
          });
        });
    </script>

    <script src="https://apis.google.com/js/platform.js" async defer></script> 
        <meta name="google-signin-client_id" content="your_client_id"> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <!--<script src="scrpt.js"></script>--> 
        <script> function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        $(".g-signin2").css("display", "none");
        $(".data").css("display", "block");
        $("#pic").attr('src', profile.getImageUrl());
    }</script> 
    <style> .g-signin2{ margin-top:0px;} .data{ display:none;} </style>

</body>
</html>