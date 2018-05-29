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

  <!-- Datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  
  <?php include "assets_adm/inc/menus/header.php"; ?>

  <div class="app-body">
  
    <?php include "assets_adm/inc/menus/menu_left.php"; ?>

    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Meu Perfil</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="#"><i class="icon-speech"></i></a>
            <a class="btn" href="dashboard"><i class="icon-graph"></i> &nbsp;Dashboard</a>
            <a class="btn" href="#"><i class="icon-settings"></i> &nbsp;Configurações</a>
          </div>
        </li>
      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-sm-12">
              <form id="form-perfil-add" class="form-horizontal" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  <strong>Atualizar minhas informações</strong>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                      <div class="col-md-12 col-lg-12 col-xs-12">
                        <div id="div-foto-logo">
                          <label class="form-col-form-label" for="perfil-foto">Logo</label>
                          <input id="perfil-foto" name="perfil-foto" type="file" accept="image/*">
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="perfil-nome">Nome</label>
                        <input type="text" class="form-control" name="perfil-nome" id="perfil-nome" required>
                        <input type="hidden" name="acao" value="manterPerfil">
                        <input type="hidden" name="tipoAcao" value="update">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="perfil-telefone">Telefone</label>
                        <input type="text" class="form-control" name="perfil-telefone" id="perfil-telefone" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$" data-inputmask="'mask': '(99)99999-9999'" title="(00)00000-0000 ou (00)000000-0000" required>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="perfil-cpf">CPF</label>
                        <input type="text" class="form-control" name="perfil-cpf" id="perfil-cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" data-inputmask="'mask': '999.999.999-99'" title="999.999.999-99" required>
                      </div>
                      
                      <div class="col-md-2 col-lg-2 col-xs-12">
                        <label class="form-col-form-label" for="perfil-data">Data Nascimento</label>
                        <input type="date" class="form-control" name="perfil-data" id="perfil-data" required>
                      </div>
                    </div>

                    <div class="form-group row">

                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="perfil-email">Email</label>
                        <input type="text" class="form-control" name="perfil-email" id="perfil-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                      </div>
                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="perfil-cep">CEP <img  id="loadCep" src="../assets/img/gif/load.gif" style="max-width: 20px; z-index: 1; margin-top: -9px; display: none;"></label>

                        <input type="text" class="form-control" name="perfil-cep" id="perfil-cep" pattern="\d{5}-\d{3}" data-inputmask="'mask': '99999-999'" title="00000-000" required>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="perfil-rua">Rua</label>
                        <input type="text" class="form-control" name="perfil-rua" id="perfil-rua" disabled>
                      </div>

                      <div class="col-md-2 col-lg-2 col-xs-12">
                        <label class="form-col-form-label" for="perfil-numero">Número</label>
                        <input type="number" class="form-control" name="perfil-numero" id="perfil-numero" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="perfil-bairro">Bairro</label>
                        <input type="text" class="form-control" name="perfil-bairro" id="perfil-bairro" disabled>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="perfil-cidade-uf">Cidade - UF</label>
                        <input type="text" class="form-control" name="perfil-cidade-uf" id="perfil-cidade-uf" disabled>
                      </div>
                      
                      <div class="col-md-6 col-lg-6 col-xs-12">
                        <label class="form-col-form-label" for="perfil-numero">Complemento</label>
                        <textarea class="form-control" name="perfil-complemento" id="perfil-complemento" rows="4" required></textarea>
                      </div>
                      
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-dot-circle-o"></i> Salvar informações</button>
                </div>
              </div>
              </form>
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
  <script type="text/javascript" src="assets_adm/inc/js/manterPerfil.js"></script>
  
</body>
</html>