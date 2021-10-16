<?php
    require_once "classes/usuario.php";
    $p = new Produto('', '', '', '', '', '');
    $u = new Usuario($p);
    $edita = filter_input (INPUT_POST, 'editar', FILTER_SANITIZE_STRING);
    $pesquisa = filter_input (INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
    if($edita){
        $p = new Produto($_POST['codigo'], $_POST['desc'], $_POST['preco-custo'], $_POST['preco-venda'], $_POST['qtd-estoque'], $_POST['qtd-min']);
        $u->editarProd($msqli);
        echo '<p class="aviso">*Produto atualizado com sucesso</p>';
    }
    if($pesquisa){
        if(!empty($_POST['codigo'])){
            $u->pesquisarProd($msqli, $_POST['codigo']);
        }else{
            echo '<p class="aviso">*Preencha o campo codigo</p>';
        }
    } 
?>