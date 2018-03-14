<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Metas Tags -->
  <?php include "assets_adm/inc/verifica.php"; ?>

  <!-- Metas Tags -->
  <?php include "assets_adm/inc/metas.php"; ?>

  <!-- Title -->
  <?php include "assets_adm/inc/title_adm.php"; ?>

  <!-- Head -->
  <?php include "assets_adm/inc/styles.php"; ?>

  
  
  

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  
  <?php include "assets_adm/inc/header.php" ?>


  <div class="app-body">
  
    <?php include "assets_adm/inc/menu_left.php" ?>
    

    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Company</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="#"><i class="icon-speech"></i></a>
            <a class="btn" href="index.php"><i class="icon-graph"></i> &nbsp;Dashboard</a>
            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Configurações</a>
          </div>
        </li>
      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <strong>Cadastrar Empresa</strong>
                  Formulário
                </div>
                <div class="card-body">
                  <form id="form-company-add" class="form-horizontal">

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-nome">Nome</label>
                        <input type="text" class="form-control" name="company-nome" id="company-nome" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-telefone">Telefone</label>
                        <input type="text" class="form-control" name="company-telefone" id="company-telefone" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-cnpj">CNPJ</label>
                        <input type="text" class="form-control" name="company-cnpj" id="company-cnpj" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-facebook">Facebook</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
                          </span>
                          <input type="text" class="form-control" name="company-facebook" id="company-facebook" required>
                        </div>
                      </div>

                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-instagram">Instagram</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary"><i class="fa fa-instagram"></i></button>
                          </span>
                          <input type="text" class="form-control" name="company-instagram" id="company-instagram" required>
                        </div>
                      </div>

                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-twitter">Twitter</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i></button>
                          </span>
                          <input type="text" class="form-control" name="company-twitter" id="company-twitter" required>
                        </div>
                      </div>

                    </div>

                    <div class="form-group row">
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-fundacao">Data Fundação</label>
                        <input type="date" class="form-control" name="company-fundacao" id="company-fundacao" required>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-cep">CEP</label>
                        <input type="text" class="form-control" name="company-cep" id="company-cep" required>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-rua">Rua</label>
                        <input type="text" class="form-control" name="company-rua" id="company-rua" disabled>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-numero">Número</label>
                        <input type="number" class="form-control" name="company-numero" id="company-numero" required>
                      </div>
                      
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-rua">Bairro</label>
                        <input type="text" class="form-control" name="company-rua" id="company-rua" disabled>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-rua">Cidade - UF</label>
                        <input type="text" class="form-control" name="company-rua" id="company-rua" disabled>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-lat">Latitude</label>
                        <input type="text" class="form-control" name="company-lat" id="company-lat" disabled>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-long">Longitude</label>
                        <input type="text" class="form-control" name="company-long" id="company-long" disabled>
                      </div>

                    </div>

                    <div class="form-group row">

                      <div class="col-md-6 col-lg-6 col-xs-12">
                        <label class="form-col-form-label" for="company-numero">Complemento</label>
                        <textarea class="form-control" name="company-complemento" id="company-complemento" rows="4" required></textarea>
                      </div>

                    </div>

                  </form>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Salvar</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                </div>
              </div>
            </div>
            <!--/.col-->
           
            <!--/.col-->
          </div>
          
        </div>

      </div>
      <!-- /.conainer-fluid -->
    </main>

    <?php include "assets_adm/inc/menu_right.php" ?>

  </div>

  <?php include "assets_adm/inc/footer.php"; ?>

  <?php include "assets_adm/inc/js.php"; ?>

  
  

</body>
</html>