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
            header("Location: adm/dashboard");
            break;
        case 2:
            header("Location: filial/pedidos");
            break;
        case 3:
            header("Location: register");
            break;
	}
    

}

?>