<?php
    include("conexao/conexao.php");
    header('Content-Type: application/json');
    $produto = "SELECT * FROM caixa";
    $result = mysqli_query($msqli, $produto);
    $data = mysqli_fetch_all($result);
    json_encode($data);
?>