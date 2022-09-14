<?php 

session_start();
if(!isset($_SESSION['idUsuario']))
{
    header("Location:index.php");
    die();
}
?>
<a href="sair.php">Sair</a>

Chegou aqui!