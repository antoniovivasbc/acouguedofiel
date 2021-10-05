<?php
session_start();
  include("conexao.php");
  
  if(isset($_SESSION['$nome2'])){
    header("location: caixa.php");
}else if(!isset($_SESSION[ 'adm2' ])){
  header("location: index.php");
  session_destroy();
}
if(isset($_GET['deslogar'])){
  $_SESSION[ 'adm2' ] = false;
  $_SESSION['$nome2'] = false;
  session_destroy();
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Açougue do Fiel</title>
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <section>
        <nav><div class='toggle'><img onclick='sidebar()' src="img/menu.png" alt=""></div><h1>PAINEL ADMINISTRATIVO</h1></nav>
        <div id="sidebar">
            <a href="caixa.php">Caixa livre</a>
            <a href="cadprod.php">Cadastro de produtos</a>
            <a href="pesquisaprod.php">Pesquisa de produtos</a>
            <a href="vendas.php">Relatorio de vendas</a>
            <a href="estoque.php">Planilha de estoque</a>
            <a href="?deslogar">Logout</a>
        </div>
        <!--CONTEUDO-->
        <div class='flexbox'>
            <div class="conteudo">
                <div class="title2">
                    <br><h2>PESQUISA DE PRODUTOS</h2><br><br>
                </div>
                <div class="ajuste-form">
                    <form action="" method="POST">
                        <?php include("php/enviapesqprod.php") ?>
                        <div class="codigo">
                            <input type="text" placeholder="Codigo" name="codigo" autocomplete="off" autofocus value="<?php echo $codigo; ?>">
                        </div><br>
                        <div class="descricao">
                            <input type="text" placeholder="Descrição" name="desc" autocomplete="off" value="<?php echo $descricao?>">
                        </div><br>
                        <div class="input-duplo">
                            <input type="text" placeholder="Preço de custo" name="preco-custo" autocomplete="off" value="<?php echo $preco_custo?>">
                            <input type="text" placeholder="Preço de venda" name="preco-venda" autocomplete="off" value="<?php echo $preco_venda?>">
                        </div><br>
                        <div class="input-duplo">
                            <input type="text" placeholder="QTD em estoque" name="qtd-estoque" autocomplete="off" value="<?php echo $qtd_estoque?>">
                            <input type="text" placeholder="QTD mínima" name="qtd-min" autocomplete="off" value="<?php echo $qtd_minima?>">
                        </div><br>
                        <div class="input-envia">
                            
                            <input type="submit" value="Pesquisar" name="pesquisar">
                            <input type="submit" value="Editar" name="editar">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/main.js"></script>
<script src="js/imprime.js"></script>
<script src="js/modal.js"></script>