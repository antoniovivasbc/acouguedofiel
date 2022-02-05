<?php
session_start();
  include("conexao.php");
  require_once "php/classes/usuario.php";
  $p = new Produto('','','','','','');
  $u = new Usuario($p);
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
    <link rel="stylesheet" href="css/tabela2.css">
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
                    <br><h2>PLANILHA DE ESTOQUE</h2><br><br>
                </div>
                <button class='imprime' onclick="imprime()">Imprimir</button>
                <div class="ajuste-form">
                    <table id="tabela">
                        <tbody id="printable">
                            <tr class="fonte-grande">
                                <th>Codigo</th>
                                <th>Descrição</th>
                                <th>Ultimo preço</th>
                                <th>Qtd atual</th>
                            </tr>
                            <?php
                                $u->buscaEstoque($msqli);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/main.js"></script>
<script src="js/imprime.js"></script>
<script src="js/modal.js"></script>
