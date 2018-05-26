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
              <input type="password" class="form-control" placeholder="Repitir Senha" name="register-senha-2" id="register-senha-2" required>
            </div>

            <button type="submit" class="btn btn-block btn-success" id="btnRegister" >Registrar Conta!</button>
            <button type="button" class="btn btn-block btn-warning" id="btnBackLogin" >Login!</button>

          </form>
          </div>
          <div class="card-footer p-4">
            <div class="row">
              <div class="col-6">
                <button class="btn btn-block btn-facebook" type="button">
                  <span>Facebook</span>
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-block btn-google" type="button">
                  <span>Google</span>
                </button>
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

</body>
</html>