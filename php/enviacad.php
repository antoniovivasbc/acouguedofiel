<?php
    include("conexao/conexao.php");
    require_once "classes/usuario.php";
    $envia = filter_input (INPUT_POST, 'enviar', FILTER_SANITIZE_STRING);
    if($envia){
        if($_POST['codigo'] != null && $_POST['desc'] != null && $_POST['preco-custo'] != null && $_POST['preco-venda'] != null && $_POST['qtd-estoque'] != null && $_POST['qtd-min']) {
            $p = new Produto($_POST['codigo'], $_POST['desc'], $_POST['preco-custo'], $_POST['preco-venda'], $_POST['qtd-estoque'], $_POST['qtd-min']);
            $u = new Usuario($p);
            $u->cadastrarProd($msqli);
        }else{
            echo '<script>alert("Preencha os campos necessários")</script>';
        }
    }
?>