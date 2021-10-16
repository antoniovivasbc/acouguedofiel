<?php
    include("../conexao.php");
    require_once "classes/usuario.php";
    header('Content-Type: application/json');
    date_default_timezone_set("America/Bahia");
    $codigo = $_POST['codigo'];
    if(!empty($codigo)){
        /* VERIFICAÇÃO BALANÇA
        $rest = substr("$codigo", 0, -12);
        if($rest == 2){
            $preco = substr("$codigo", 7, -1);
            $preco = $preco/100;
            $preco = number_format($preco, 2);
            $codigo = substr("$codigo", 2, -8);
        }
        */
        $p= new Produto($codigo, '', '', '', '', '');
        $u = new Usuario($p);
        $p = $u->pesquisarProd($msqli, $codigo);
        $preco_total = $p->getValorVenda();
        $qtd = $preco_total/$p->getValorVenda();
        $insert = "INSERT INTO caixa (codigo, descricao, preco, quantidade) VALUES('$codigo', '$p->descricao' , '$preco_total', '$qtd')";
        $result = mysqli_query($msqli, $insert);
    }
?>