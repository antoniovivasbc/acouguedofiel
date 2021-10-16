<?php
    session_start();
    include("conexao.php");
    if(!isset($_SESSION[ 'adm2' ]) &&  !isset($_SESSION['$nome2'])){
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
    <link rel="stylesheet" href="css/caixa.css">
    <link rel="stylesheet" href="css/modal.css">
</head>
<body>
    <div id = 'printable'>
        <h1 class='titulo-nota'>Mercadinho do Fiel</h1>
        <ul class='dados-nota'>
            <li>CNPJ: 29.886.050/0001-08</li>
            <li>Endereço: Rua Basílio de Magalhães Nº19 A</li>
            <li>PIX: (71) 98776-8091</li>
        </ul>
        <hr>
        <h2 class= titulo2-nota>Recibo</h2>
        <hr>
        <table id='tabela-nota'>
            <tr>
                <th>Quant.</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Valor total</th>
            </tr>
        </table>
        <h3 class='total-nota' id='total_nota'>Total: R$</h3>
        <h3 class='total-nota' id='valor_pago_nota'>Valor Pago: R$</h3>
        <h3 class='total-nota' id='troco_nota'>Troco: R$</h3>
    </div>
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
                    <h2>CAIXA LIVRE</h2>
                </div>
                <div class="ajuste-caixa">
                    <div class="itens-caixa">
                        <table id='tabela'>
                            <tr class="fonte-grande">
                                <th>Codigo</th>
                                <th>Descrição</th>
                                <th>QTD</th>
                                <th>Valor</th>
                                <!--<th>Valor Total</th> -->
                                <th>Apagar</th>
                            </tr>
                        </table>
                    </div>
                    <div class="dados-caixa">
                        <div>
                            <div id='total' class="total">
                                Total: R$ 0.00
                            </div>
                            <br>
                            <div id='itens' class="total">
                                Itens: 0
                            </div>
                            <br>
                            <div id='troco' class="total">
                                Troco: R$ 0.00
                            </div>
                        </div>
                        <br>    
                        <form id='form' method="POST">
                            <input type="text" autocomplete = "off" placeholder="Código do produto" id='codigo' name="codigo" required autofocus>
                            <br>
                            <input type="submit" value = "Enviar" class="envia" name="envia_prod">
                            <br>
                            <div class="input-envia pagamento">
                                <input onclick = " mostramodal1() " type="button" value="Pagamento" name="pagamento">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="ajuste-modal" id="modal-dinheiro">
            <div class="modal">
                <form action="php/pagamento.php" id='form_pagamento'>
                    <a onclick = " tiramodal() "><img src="img/delete2.png" alt=""></a>
                    <input autocomplete = "off" type="text" placeholder="Digite o valor" name="pagamento" id="valor">
                    <input type="submit" id='envia_pagamento' value="Enviar" name="envia-pagamento">
                </form>
            </div>
        </div>
        <div class="ajuste-modal" id="modal-deleta">
            <div class="modal">
                <form id='form_deleta'>
                    <a onclick = " tiramodal2() "><img src="img/delete2.png" alt=""></a>
                    <input autocomplete = "off" type="password" placeholder="Digite a senha" name="pagamento" id="senha">
                    <input type="submit" id='' value="Enviar" name="envia-pagamento">
                </form>
            </div>
        </div>
    </section>
</body>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/main.js"></script>
<script src='js/caixa.js'></script>