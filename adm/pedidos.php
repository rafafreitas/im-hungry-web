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
  
  <?php include "assets_adm/inc/menus/header.php" ?>


  <div class="app-body">
  
    <?php include "assets_adm/inc/menus/menu_left.php" ?>
    

    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Pedidos</li>
        <li class="breadcrumb-item active">Companies</li>

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
                  <strong>Visualização de Empresas</strong>
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-sm-6 col-lg-3">
                      <div class="card text-white bg-primary">
                        <div class="card-body pb-0">
                          <div class="btn-group float-right">
                            <button type="button" class="btn btn-transparent dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Detalhes</a>
                              <a class="dropdown-item" href="#">Visualizar pedidos</a>
                            </div>
                          </div>
                          <h2>Pizza Hut</h2>
                          <h4 class="mb-0">1.137</h4>
                          <p>Pedidos entregues</p>
                        </div>
                        <div class="chart-wrapper px-3" style="height:70px;">
                          <canvas id="card-chart1" class="chart chart-line" height="70"></canvas>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                      <div class="card text-white bg-success">
                        <div class="card-body pb-0">
                          <div class="btn-group float-right">
                            <button type="button" class="btn btn-transparent dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Detalhes</a>
                              <a class="dropdown-item" href="#">Visualizar pedidos</a>
                            </div>
                          </div>
                          <h2>Bobs</h2>
                          <h4 class="mb-0">937</h4>
                          <p>Pedidos entregues</p>
                        </div>
                        <div class="chart-wrapper px-3" style="height:70px;">
                          <canvas id="card-chart2" class="chart chart-line" height="70"></canvas>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                      <div class="card text-white bg-warning">
                        <div class="card-body pb-0">
                          <div class="btn-group float-right">
                            <button type="button" class="btn btn-transparent dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#">Detalhes</a>
                              <a class="dropdown-item" href="#">Visualizar pedidos</a>
                            </div>
                          </div>
                          <h2>Burguer King</h2>
                          <h4 class="mb-0">787</h4>
                          <p>Pedidos entregues</p>
                        </div>
                        <div class="chart-wrapper px-3" style="height:70px;">
                          <canvas id="card-chart3" class="chart chart-line" height="70"></canvas>
                        </div>
                      </div>
                    </div>

                  </div> <!-- div.row -->

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

  <script type="text/javascript" src="assets_adm/inc/js/manterPedidos.js"></script>
  
</body>
</html>