<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

// Verifica se os campos foram definidos
if (!isset($_SESSION['UsuarioID']) || !isset($_SESSION['UsuarioNome']) || !isset($_SESSION['UsuarioLogin']) ) {
  session_destroy(); //Destroi a seção por segurança
  header("Location: ../../index.php"); //Redireciona o visitante para o login
  exit; 
}

$array['token'] = $_SESSION['Token'];
$array['url'] = $_SESSION['API'];

echo json_encode($array);

?>
