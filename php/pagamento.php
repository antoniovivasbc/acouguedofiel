<?php 
    include("../conexao.php");
    require_once "classes/usuario.php";
    header('Content-Type: application/json');
    date_default_timezone_set("America/Bahia");
    $p = new Produto('', '', '', '', '', '');
    $u = new Usuario($p);
    $u->venderProd($msqli);
?>
