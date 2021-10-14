<?php 
    include("../conexao.php");
    header('Content-Type: application/json');
    date_default_timezone_set("America/Bahia");
    $seleciona_caixa = "SELECT * FROM caixa";
    $result = mysqli_query($msqli, $seleciona_caixa);
    while($dados = mysqli_fetch_array($result)){
        $codigo = $dados['codigo'];
        $descricao = $dados['descricao'];
        $preco_venda = $dados['preco'];
        $data = date('Y-m-d');
        $hora = date("h:i");
        $preco_total = $preco_venda;
        $quantidade = 1;
        $envia_venda = "INSERT INTO vendas (codigo, descricao, preco, quantidade, valor_total, datta, hora) VALUES ('$codigo', '$descricao', '$preco_venda', '$quantidade', '$preco_total', '$data', '$hora')";
        $result2 = mysqli_query($msqli, $envia_venda);
        $ajusta_estoque = "UPDATE cadastro_produto SET qtd_estoque = qtd_estoque-1 WHERE codigo = '$codigo'";
        $result2 = mysqli_query($msqli, $ajusta_estoque);
    }
    $finaliza_caixa = "DELETE FROM caixa";
    $resultado_finaliza = mysqli_query($msqli, $finaliza_caixa);
    echo json_encode('');
?>
