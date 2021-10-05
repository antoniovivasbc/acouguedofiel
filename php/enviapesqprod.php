<?php
    $codigo = ''; 
    $descricao = '';
    $preco_custo = '';
    $preco_venda = '';
    $qtd_estoque = '';
    $qtd_minima = '';
    
    $edita = filter_input (INPUT_POST, 'editar', FILTER_SANITIZE_STRING);
    $pesquisa = filter_input (INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
    if($edita){
            $codigo = $_POST['codigo']; 
            $descricao = $_POST['desc']; 
            $preco_custo = $_POST['preco-custo']; 
            $preco_venda = $_POST['preco-venda']; 
            $qtd_estoque = $_POST['qtd-estoque']; 
            $qtd_minima = $_POST['qtd-min']; 
            $deleta = "DELETE FROM cadastro_produto WHERE codigo = '{$_POST['codigo']}'";
            $result = mysqli_query($msqli, $deleta);
            $edita2 = "INSERT INTO cadastro_produto (codigo, descricao, preco_custo, preco_venda, qtd_estoque, qtd_minima) VALUES('$codigo', '$descricao', '$preco_custo', '$preco_venda', '$qtd_estoque', '$qtd_minima')";
            $result2 = mysqli_query($msqli, $edita2);
            echo '<p class="aviso">*Produto atualizado com sucesso</p>';
    }
    if($pesquisa){
        if(!empty($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $pesquisa = "SELECT * FROM cadastro_produto WHERE codigo = '$codigo'";
            $result = mysqli_query($msqli, $pesquisa);
            $dados = mysqli_fetch_array($result);
            if($dados != null){
                $codigo = $dados['codigo'];
                $descricao = $dados['descricao'];
                $preco_custo = $dados['preco_custo'];
                $preco_venda = $dados['preco_venda'];
                $qtd_estoque = $dados['qtd_estoque'];
                $qtd_minima = $dados['qtd_minima'];
            }else{
                echo '<p class="aviso">*Produto não encontrado</p>';
            }
            
        }
    } 
    
?>