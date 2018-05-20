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
  
  <?php include "assets_adm/inc/menus/header.php" ?>

  <div class="app-body">
  
    <?php include "assets_adm/inc/menus/menu_left.php" ?>
    <?
      if (!isset($_SESSION)){session_cache_expire(30);session_start();}
      $_SESSION['filial_id'] = $_GET['id'];
    ?>

    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Filiais</li>
        <li class="breadcrumb-item active">Funcionário</li>

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

        <!--Modal para atualizaçao-->
          <div class="modal fade" id="myModalAtualizar" role="dialog">
            <div class="modal-dialog" style="max-width: 950px!important;">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="text-center"><span class="glyphicon glyphicon-pencil"></span> Atualizar Funcionário</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding:30px 40px;">

                  <form class="form-horizontal" id="formAtualizar" enctype="multipart/form-data" >

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-nome-at">Nome</label>
                        <input type="text" class="form-control" name="funcionario-nome-at" id="funcionario-nome-at" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-cpf-at">CPF</label>
                        <input type="text" class="form-control" name="funcionario-cpf-at" id="funcionario-cpf-at" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" data-inputmask="'mask': '999.999.999-99'" title="999.999.999-99" required>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-telefone-at">Telefone</label>
                        <input type="text" class="form-control" name="funcionario-telefone-at" id="funcionario-telefone-at" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$" data-inputmask="'mask': '(99)99999-9999'" title="(00)00000-0000 ou (00)000000-0000" required>
                      </div>                    
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-email-at">Email</label>
                        <input type="text" class="form-control" name="funcionario-email-at" id="funcionario-email-at" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-senha-at">Senha</label>
                        <input type="password" class="form-control" name="funcionario-senha-at" id="funcionario-senha-at" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-1 col-lg-2 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-cep-at">CEP <img  id="loadCep" src="../assets/img/gif/load.gif" style="max-width: 20px; z-index: 1; margin-top: -9px; display: none;"></label>
                        <input type="text" class="form-control" name="funcionario-cep-at" id="funcionario-cep-at" pattern="\d{5}-\d{3}" data-inputmask="'mask': '99999-999'" title="00000-000" required>
                      </div>
                      <div class="col-md-4 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-rua-at">Rua</label>
                        <input type="text" class="form-control" name="funcionario-rua-at" id="funcionario-rua-at" disabled>
                      </div>
                      <div class="col-md-2 col-lg-1 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-numero-at">Número</label>
                        <input type="number" class="form-control" name="funcionario-numero-at" id="funcionario-numero-at" required>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-bairro-at">Bairro</label>
                        <input type="text" class="form-control" name="funcionario-bairro-at" id="funcionario-bairro-at" disabled>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-cidade-uf-at">Cidade - UF</label>
                        <input type="text" class="form-control" name="funcionario-cidade-uf-at" id="funcionario-cidade-uf-at" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12 col-lg-11 col-xs-12">
                          <input id="upFilesFotos-at" name="upFilesFotos-at[]" type="file" multiple class="file-loading">
                      </div>
                    </div>

                    <div class="form-group"> 
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" id="btnAtualizar">Atualizar</button>
                        <img  id="submitGif" src="../assets/img/gif/load.gif" style="max-width: 50px;">
                        <p id="retornoAt" class="text-center"></p>
                      </div>
                    </div>

                  </form>
                </div> <!--modal-body (Atualizar)-->
              </div><!--modal-content (Atualizar)-->
            </div><!--modal-dialog (Atualizar)-->
          </div> 
        <!--modal fade (Atualizar)-->

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-sm-12">
              <form id="form-filial-add" class="form-horizontal" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  <strong>Cadastrar Funcionário</strong>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-nome">Nome</label>
                        <input type="text" class="form-control" name="funcionario-nome" id="funcionario-nome" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-cpf">CPF</label>
                        <input type="text" class="form-control" name="funcionario-cpf" id="funcionario-cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" data-inputmask="'mask': '999.999.999-99'" title="999.999.999-99" required>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-telefone">Telefone</label>
                        <input type="text" class="form-control" name="funcionario-telefone" id="funcionario-telefone" pattern="\([0-9]{2}\)[0-9]{4,5}-[0-9]{4}$" data-inputmask="'mask': '(99)99999-9999'" title="(00)00000-0000 ou (00)000000-0000" required>
                      </div>                    
                    </div>

                    <div class="form-group row">
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-email">Email</label>
                        <input type="text" class="form-control" name="funcionario-email" id="funcionario-email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                      </div>
                      <div class="col-md-4 col-lg-4 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-senha">Senha</label>
                        <input type="password" class="form-control" name="funcionario-senha" id="funcionario-senha" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-1 col-lg-2 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-cep">CEP <img  id="loadCep" src="../assets/img/gif/load.gif" style="max-width: 20px; z-index: 1; margin-top: -9px; display: none;"></label>
                        <input type="text" class="form-control" name="funcionario-cep" id="funcionario-cep" pattern="\d{5}-\d{3}" data-inputmask="'mask': '99999-999'" title="00000-000" required>
                      </div>
                      <div class="col-md-4 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-rua">Rua</label>
                        <input type="text" class="form-control" name="funcionario-rua" id="funcionario-rua" disabled>
                      </div>
                      <div class="col-md-2 col-lg-1 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-numero">Número</label>
                        <input type="number" class="form-control" name="funcionario-numero" id="funcionario-numero" required>
                      </div>
                      <div class="col-md-3 col-lg-2 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-bairro">Bairro</label>
                        <input type="text" class="form-control" name="funcionario-bairro" id="funcionario-bairro" disabled>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="funcionario-cidade-uf">Cidade - UF</label>
                        <input type="text" class="form-control" name="funcionario-cidade-uf" id="funcionario-cidade-uf" disabled>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12 col-lg-11 col-xs-12">
                          <input id="upFilesFotos" name="upFilesFotos[]" type="file" multiple class="file-loading">
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
                  <strong>Funcionários Cadastrados</strong>
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
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>
                    <div class="tab-pane" id="table-inativas" role="tabpanel">
                      <table id="datatable-responsive-in" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
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
  <script type="text/javascript" src="assets_adm/inc/js/manterFuncionario.js"></script>
  
</body>
</html>