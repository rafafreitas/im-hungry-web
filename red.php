<?php

session_cache_expire(30);
session_start();
if (!isset($_SESSION['UsuarioID']) || 
    !isset($_SESSION['UsuarioNome']) || 
    !isset($_SESSION['UsuarioLogin']) || 
    !isset($_SESSION['Token']) ) {
    session_destroy();
    header("Location: index.php"); exit;
}else {
    
    header("Location: adm/index.php");

    /*
	switch ($_SESSION['UsuarioNivel']) {
    case 1:
        header("Location: system/adm/index.php");
        break;
    case 2:
        header("Location: system/ong/index.php");
        break;
    case 3:
        header("Location: system/doa/index.php");
        break;
	}
    */

}

?>