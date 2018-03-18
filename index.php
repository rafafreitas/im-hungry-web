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
   <img src="assets/img/back.jpg">
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
                    <button type="button" class="btn btn-link px-0">Esqueceu a senha?</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card text-white bg-primary bg-login py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Inscreva-se</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="register.php">
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
              url:"validacao.php",
              type:"post",
              data: "login="+login+"&senha="+senha, 
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

</body>
</html>