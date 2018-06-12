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
        <li class="breadcrumb-item active">Fidelidade</li>

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

        <!--Modal para atualizaçao-->
          <div class="modal fade" id="myModalAtualizar" role="dialog">
            <div class="modal-dialog" style="max-width: 950px!important;">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="text-center"><span class="glyphicon glyphicon-pencil"></span> Atualizar Fidelidade</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding:30px 40px;">

                  <form class="form-horizontal" id="formAtualizar" enctype="multipart/form-data" >

                    <div class="form-group row">
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="nome-at">Nome</label>
                        <input type="text" class="form-control" name="nome-at" id="nome-at" required>
                      </div>

                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="quantidade-at">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade-at" id="quantidade-at" required>
                      
                        <input type="hidden" id="idAt" name="idAt">
                        <input type="hidden" id="statusAt" name="statusAt">
                        <input type="hidden" id="reloadAt" name="reloadAt">
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="valor-at">Valor Mínimo</label>
                        <input type="text" class="form-control" name="valor-at" id="valor-at" required>
                      </div>
                                      
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="validade-at">Termino da Promoção</label>
                        <input type="date" class="form-control" name="validade-at" id="validade-at" required>
                      </div>
                    </div>
                   
                    <div class="form-group row">
                      <div class="col-md-6 col-lg-6 col-xs-12">
                        <label class="form-col-form-label" for="beneficio-at">Benefício</label>
                        <textarea class="form-control" name="beneficio-at" id="beneficio-at" rows="4"></textarea>
                      </div>
                    </div>

                    <div class="form-group"> 
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" id="btnAtualizar">Atualizar</button>
                        <img  id="submitGif" src="/assets/img/gif/load.gif" style="max-width: 50px;">
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
              <form id="form-fidelidade-add" class="form-horizontal" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  <strong>Cadastrar Fidelidade</strong>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" name="quantidade" id="quantidade" required>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="valor">Valor Mínimo</label>
                        <input type="text" class="form-control" name="valor" id="valor" required>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xs-12">
                        <label class="form-col-form-label" for="validade">Término da Promoção</label>
                        <input type="date" class="form-control" name="validade" id="validade" required>
                      </div>                    
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-md-6 col-lg-6 col-xs-12">
                        <label class="form-col-form-label" for="beneficio">Benefício</label>
                        <textarea class="form-control" name="beneficio" id="beneficio" rows="4"></textarea>
                      </div>
                    </div>

                    <p>Obs: Atenção as regras da manuntenção dos cartões de fidelidade</p>
                    <ul>
                      <li>Só pode haver um cartão ativo por vez.</li>
                      <li>Após cadastrá-lo ele ficará como inativo aguardando sua liberação.</li>
                      <li>Após ser ativado não poderá mais ser editado, faça as correções antes de ativá-lo </li>
                      <li>Os cartões serão encerrados automáticamente no dia previsto.</li>
                    </ul>

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
                  <strong>Cartões Fidelidaed Cadastrados</strong>
                </div>
                <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#table-ativas" role="tab" aria-controls="home">Ativos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#table-inativas" role="tab" aria-controls="profile">Inativos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#table-encerradas" role="tab" aria-controls="profile">Encerrados</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane active" id="table-ativas" role="tabpanel">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor Mínimo</th>
                            <th>Término</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>

                    <div class="tab-pane" id="table-inativas" role="tabpanel">
                      <table id="datatable-responsive-in" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor Mínimo</th>
                            <th>Término</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>

                    <div class="tab-pane" id="table-encerradas" role="tabpanel">
                      <table id="datatable-responsive-en" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor Mínimo</th>
                            <th>Término</th>
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
  <script type="text/javascript" src="/adm/assets_adm/inc/js/manterFidelidade.js"></script>
  
</body>
</html>