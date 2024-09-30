<?php
session_start(); // inicia a sessão
unset($_SESSION['id']);
header("location: ../Projeto TCC/Tela Principal/inicio.php"); // redireciona para a página de login
exit;
?>