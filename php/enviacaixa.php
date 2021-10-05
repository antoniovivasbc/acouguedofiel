<?php
    include("../conexao.php");
    header('Content-Type: application/json');
    date_default_timezone_set("America/Bahia");
    $codigo = $_POST['codigo'];
    if(!empty($codigo)){
        $rest = substr("$codigo", 0, -12);
        if($rest == 2){
            $preco = substr("$codigo", 7, -1);
            $preco = $preco/100;
            $preco = number_format($preco, 2);
            $codigo = substr("$codigo", 2, -8);
        }
        $produto = "SELECT * FROM cadastro_produto WHERE codigo = '{$codigo}'";
        $result = mysqli_query($msqli, $produto);
        $row = mysqli_num_rows($result); 
        if($row == 1){
            $dados = mysqli_fetch_array($result);
            echo json_encode($dados);
            $codigo = $dados['codigo'];
            $descricao = $dados['descricao'];
            $preco_custo = $dados['preco_custo'];
            $preco_venda = $dados['preco_venda'];
            $data = date('Y-m-d');
            $hora = date("h:i");
            $preco_total = $preco_venda;
            $qtd = $preco_total/$preco_venda;
            $envia_produto = "INSERT INTO caixa (codigo, descricao, preco, quantidade) VALUES('$codigo', '$descricao' , '$preco_total', '$qtd')";
            $result = mysqli_query($msqli, $envia_produto);
        }else{
            echo json_encode('');
        }
    }
?>