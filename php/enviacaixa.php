<?php
    include("conexao/conexao.php");
    require_once "classes/usuario.php";
    header('Content-Type: application/json');
    date_default_timezone_set("America/Bahia");
    $codigo = $_POST['codigo'];
    $p= new Produto($codigo, '', '', '', '', '');
    $u = new Usuario($p);
    if(!empty($codigo)){
        $select = "SELECT * FROM cadastro_produto WHERE codigo = '$codigo'";
        $result = mysqli_query($msqli, $select);
        $row = mysqli_num_rows($result);
        if($row > 0){
            /* VERIFICAÇÃO BALANÇA
            $rest = substr("$codigo", 0, -12);
            if($rest == 2){
            $preco = substr("$codigo", 7, -1);
            $preco = $preco/100;
            $preco = number_format($preco, 2);
            $codigo = substr("$codigo", 2, -8);
            }
            */
            $p = $u->pesquisarProd($msqli, $codigo);
            $preco_total = $p->getValorVenda();
            $qtd = $preco_total/$p->getValorVenda();
            $insert = "INSERT INTO caixa (codigo, descricao, preco, quantidade) VALUES('$codigo', '$p->descricao' , '$preco_total', '$qtd')";
            $result = mysqli_query($msqli, $insert);
            json_encode("");
        }else{
            json_encode("invalid");
        }
    }else{
        json_encode("invalid");
    }
?>