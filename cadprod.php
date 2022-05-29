<?php
  include("conexao.php");
  if($_SESSION['$nome2'] == true){
    header("location: caixa.php");
}else if($_SESSION[ 'adm2' ] == false){
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
<html lang="pt-br">
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
            <a href="pesquisa.php">Pesquisa de produtos</a>
            <a href="vendas.php">Relatorio de vendas</a>
            <a href="estoque.php">Planilha de estoque</a>
            <a href="?deslogar">Logout</a>
        </div>
        <!--CONTEUDO-->
        <div class='flexbox'>
            <div class="conteudo">
                <div class="title2">
                    <br><h2>CADASTRO DE PRODUTOS</h2><br><br>
                </div>
                <div class="ajuste-form">
                    <form action="php/enviaCad.php" method="POST">
                        <div class="descricao">
                            <input type="text" placeholder="Descrição" name="desc" autofocus autocomplete = "off">
                        </div><br>
                        <div class="input-duplo">
                            <input type="text" placeholder="Preço de custo" name="preco-custo" autocomplete = "off">
                            <input type="text" placeholder="Preço de venda" name="preco-venda" autocomplete = "off">
                        </div><br>
                        <div class="input-duplo">
                            <input type="text" placeholder="QTD em estoque" name="qtd-estoque" autocomplete = "off">
                            <input type="text" placeholder="QTD mínima" name="qtd-min" autocomplete = "off">
                        </div><br>
                        <div class="codigo">
                            <input type="text" placeholder="Codigo" name="codigo" autocomplete = "off">
                        </div><br>
                        <div class="input-envia">
                            <input type="submit" value="Enviar" name="enviar">
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