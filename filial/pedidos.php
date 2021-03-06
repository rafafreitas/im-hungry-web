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
        <li class="breadcrumb-item">Pedidos</li>
        <li class="breadcrumb-item active">Listagem</li>

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
              <div class="card">
                <div class="card-header">
                  <strong>Visualização de Pedidos</strong>
                </div>

                <div class="card-body">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#table-ativas" role="tab" aria-controls="home">Em Andamento</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#table-concluidas" role="tab" aria-controls="home">Concluídos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#table-inativas" role="tab" aria-controls="profile">Entregues</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane active" id="table-ativas" role="tabpanel">
                      <table id="datatable-ped-pending" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Código</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                            <th>Status</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>

                    <div class="tab-pane" id="table-concluidas" role="tabpanel">
                      <table id="datatable-ped-completed" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Código</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                            <th>Status</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>

                    <div class="tab-pane" id="table-inativas" role="tabpanel">
                      <table id="datatable-ped-delivered" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Código</th>
                            <th>Valor</th>
                            <th>Data/Hora</th>
                            <th>Status</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        
                      </table>
                    </div>
                  </div>

                </div>

                <div class="card-footer">
                  <p>Antes de fazer alterações confirme os itens escolhidos.</p>
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

  <script type="text/javascript" src="assets_adm/inc/js/manterPedidos.js"></script>
  
</body>
</html>