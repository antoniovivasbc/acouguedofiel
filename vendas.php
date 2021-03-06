<?php
    session_start();
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Açougue do Fiel</title>
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/tabela.css">
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
                    <br><h2>RELATÓRIO DE VENDAS</h2><br><br>
                </div>
                <button class='imprime' onclick="imprime()">Imprimir</button>
                <div class="ajuste-form">
                    <table id="tabela">
                        <tbody class="printable" id="printable">
                            <tr class="fonte-grande">
                                <th>codigo</th>
                                <th>descricao</th>
                                <th>preco_venda</th>
                                <th>data</th>
                                <th>hora</th>
                            </tr>
                            <?php include ("php/buscavendas.php");?>
                        </tbody>
                    </table>
                    <form class="ajuste-data" action="" method="POST">
                        <input type="date" placeholder="dd/mm/aaaa" name="datavenda" required autofocus>
                        <input type="submit" class='envia' name = "envia-data"> <br> <br>
                        <?php $total = number_format($total, 2, ',', '.'); echo"<h3> TOTAL: R$ $total </h3>";?>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/main.js"></script>
<script src="js/imprime.js"></script>