<?php
    include("../conexao.php");
    header('Content-Type: application/json');
    $id = $_POST['id'];
    $delete = "DELETE FROM caixa WHERE id = '$id'";
    mysqli_query($msqli, $delete);
    echo json_encode($delete);
?>