<?php
session_start(); // Inicia a sessão
session_destroy(); // Destrói a sessão limpando todos os valores salvos
header("Location: ../login"); exit; // Redireciona o visitante para página inicial
?>