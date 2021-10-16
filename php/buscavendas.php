<?php
    require_once "classes/usuario.php";
    $total = 0;
    $envia_data = filter_input(INPUT_POST, 'envia-data', FILTER_SANITIZE_STRING);
    if($envia_data){
        $data = $_POST['datavenda'];
        $p = new Produto('','','','','','');
        $u = new Usuario($p);
        $total = $u->buscavendas($msqli, $data, $total);
    }
?>