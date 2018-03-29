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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">


</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  
  <?php include "assets_adm/inc/menus/header.php" ?>


  <div class="app-body">
  
    <?php include "assets_adm/inc/menus/menu_left.php" ?>
    

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
              <form id="form-company-add" class="form-horizontal" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  <strong>Cadastrar Empresa</strong>
                  Formulário
                </div>
                <div class="card-body">

                    <div class="form-group row">
                      <div class="col-md-12 col-lg-12 col-xs-12">
                        <div id="div-foto-logo">
                          <label class="form-col-form-label" for="company-nome">Logo</label>
                          <input id="company-logo" name="company-logo" type="file" accept="image/*" required>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-nome">Nome</label>
                        <input type="text" class="form-control" name="company-nome" id="company-nome" required>
                        <input type="hidden" name="acao" value="manterEmpresa">
                        <input type="hidden" name="tipoAcao" value="insert">
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-telefone">Telefone</label>
                        <input type="text" class="form-control" name="company-telefone" id="company-telefone" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-cnpj">CNPJ</label>
                        <input type="text" class="form-control" name="company-cnpj" id="company-cnpj" pattern="\d{2}\.\d{3}\.\d{3}/\d{4}-\d{2}" data-inputmask="'mask': '99.999.999/9999-99'" title="00.000.000/0000-00" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-facebook">Facebook</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i></button>
                          </span>
                          <input type="text" class="form-control" name="company-facebook" id="company-facebook">
                        </div>
                      </div>

                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-instagram">Instagram</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary"><i class="fa fa-instagram"></i></button>
                          </span>
                          <input type="text" class="form-control" name="company-instagram" id="company-instagram">
                        </div>
                      </div>

                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="company-twitter">Twitter</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i></button>
                          </span>
                          <input type="text" class="form-control" name="company-twitter" id="company-twitter">
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-fundacao">Data Fundação</label>
                        <input type="date" class="form-control" name="company-fundacao" id="company-fundacao" required>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-cep">CEP <img  id="loadCep" src="../assets/img/gif/load.gif" style="max-width: 20px; z-index: 1; margin-top: -9px; display: none;"></label>

                        <input type="text" class="form-control" name="company-cep" id="company-cep" pattern="\d{5}-\d{3}" data-inputmask="'mask': '99999-999'" title="00000-000" required>
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
                        <input type="text" class="form-control" name="company-rua" id="company-bairro" disabled>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="company-rua">Cidade - UF</label>
                        <input type="text" class="form-control" name="company-rua" id="company-cidade-uf" disabled>
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

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Salvar</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                </div>
              </div>
              </form>
            </div>
            <!--/.col-->

            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <strong>Empresas Cadastradas</strong>
                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#table-ativas" role="tab" aria-controls="home">Ativas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#table-inativas" role="tab" aria-controls="profile">Inativas</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane active" id="table-ativas" role="tabpanel">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Empresa</th>
                            <th>CNPJ</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>
                    <div class="tab-pane" id="table-inativas" role="tabpanel">
                      Aqui será listado outra tabela com os dados das Empresas inativas.
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <p>Antes de fazer alterações confirme os valores escolhidos.</p>
                </div>
              </div>
            </div>
           
            <!--/.col-->
          </div>
          
        </div>

      </div>
      <!-- /.conainer-fluid -->
    </main>

    <?php include "assets_adm/inc/menus/menu_right.php" ?>

  </div>

  <?php include "assets_adm/inc/menus/footer.php"; ?>

  <?php include "assets_adm/inc/js.php"; ?>

  <!-- File-Input -->
  <?php include "assets_adm/inc/file_input.php"; ?>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

  <script type="text/javascript" src="assets_adm/inc/js/manterCompany.js"></script>
  
</body>
</html>