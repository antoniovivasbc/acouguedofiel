<?php
    include("../conexao.php");
    header('Content-Type: application/json');
    $id = $_POST['id'];
    $result_usuario = "DELETE FROM caixa WHERE id = '$id'";
    $resultado_usuario = mysqli_query($msqli, $result_usuario);
    echo json_encode($result_usuario);
?>