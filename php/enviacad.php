<?php
    $apertou = filter_input (INPUT_POST, 'enviar', FILTER_SANITIZE_STRING);
    if($apertou){
        if(!empty($_POST['codigo']) && !empty($_POST['desc']) && !empty($_POST['preco-custo']) && !empty($_POST['preco-venda']) && !empty($_POST['qtd-estoque']) && !empty($_POST['qtd-min'])) {
            $sql = "SELECT * FROM cadastro_produto WHERE codigo = '{$_POST['codigo']}'";
            $result2 = mysqli_query($msqli, $sql);
            $row = mysqli_num_rows($result2);
            if($row>0){
                echo '<p class="aviso">*Produto já cadastrado</p>';
            }else{
                $codigo = $_POST['codigo'];
                $descricao = $_POST['desc'];
                $preco_custo = $_POST['preco-custo'];
                $preco_venda = $_POST['preco-venda'];
                $qtd_estoque = $_POST['qtd-estoque'];
                $qtd_minima = $_POST['qtd-min'];
                $resultado = "INSERT INTO cadastro_produto (codigo, descricao, preco_custo, preco_venda, qtd_estoque, qtd_minima) VALUES('$codigo', '$descricao', '$preco_custo', '$preco_venda', '$qtd_estoque', '$qtd_minima')";
                $result = mysqli_query($msqli, $resultado); 
            }
        }
        else{
            echo '<p class="aviso">*Preencha os campos necessários</p>';
        }   
    } 
?>