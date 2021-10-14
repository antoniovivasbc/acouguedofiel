<?php
    require_once "classes/produto.php";
    $p = new Produto('', '', '', '', '', '');
    $edita = filter_input (INPUT_POST, 'editar', FILTER_SANITIZE_STRING);
    $pesquisa = filter_input (INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
    if($edita){
        $p = new Produto($_POST['codigo'], $_POST['desc'], $_POST['preco-custo'], $_POST['preco-venda'], $_POST['qtd-estoque'], $_POST['qtd-min']);
        $p->editaProd($msqli);
        echo '<p class="aviso">*Produto atualizado com sucesso</p>';
    }
    if($pesquisa){
        if(!empty($_POST['codigo'])){
            $p->pesquisaProd($msqli, $_POST['codigo']);
        }else{
            echo '<p class="aviso">*Preencha o campo codigo</p>';
        }
    } 
    
?>