<?php

session_cache_expire(30);
session_start();
if (!isset($_SESSION['UsuarioID']) || 
    !isset($_SESSION['UsuarioNome']) || 
    !isset($_SESSION['UsuarioLogin']) || 
    !isset($_SESSION['UsuarioNivel']) || 
    !isset($_SESSION['Token']) ) {
    session_destroy();
    header("Location: index.php"); exit;
}else {
    
	switch ($_SESSION['UsuarioNivel']) {
        case 1:
            header("Location: adm/index.php");
            break;
        case 2:
            header("Location: filial/index.php");
            break;
        case 3:
            header("Location: register.php");
            break;
	}
    

}

?>