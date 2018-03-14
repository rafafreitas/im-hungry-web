<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Metas Tags -->
  <?php //include "includes/verifica.php"; ?>

  <!-- Metas Tags -->
  <?php include "assets_adm/inc/metas.php"; ?>

  <!-- Title -->
  <?php include "assets_adm/inc/title_adm.php"; ?>

  <!-- Head -->
  <?php include "assets_adm/inc/styles.php"; ?>

  
  
  

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'          - Fixed Header

// Brand options
1. '.brand-minimized'       - Minimized brand (Only symbol)

// Sidebar options
1. '.sidebar-fixed'         - Fixed Sidebar
2. '.sidebar-hidden'        - Hidden Sidebar
3. '.sidebar-off-canvas'    - Off Canvas Sidebar
4. '.sidebar-minimized'     - Minimized Sidebar (Only icons)
5. '.sidebar-compact'       - Compact Sidebar

// Aside options
1. '.aside-menu-fixed'      - Fixed Aside Menu
2. '.aside-menu-hidden'     - Hidden Aside Menu
3. '.aside-menu-off-canvas' - Off Canvas Aside Menu

// Breadcrumb options
1. '.breadcrumb-fixed'      - Fixed Breadcrumb

// Footer options
1. '.footer-fixed'          - Fixed footer

-->

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