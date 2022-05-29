<?php
    session_start();
    $_SESSION['adm2'] = false;
    $_SESSION['$nome2'] = false;
    include("conexao.php");
    //SELECIONA CONTEUDO DO BANCO DE DADOS PARA EFETUAR LOGIN
    $apertou2 = filter_input(INPUT_POST, 'envia2', FILTER_SANITIZE_STRING);
    if($apertou2){
        if(!empty($_POST['nome2']) && !empty($_POST['senha2'])) {    
        $nome = filter_input(INPUT_POST, 'nome2', FILTER_SANITIZE_STRING);
        $senha2 = filter_input(INPUT_POST, 'senha2', FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM validaadm WHERE nome = '{$_POST['nome2']}' and senha = '{$_POST['senha2']}'";
        $result2 = mysqli_query($msqli, $sql);
        $row = mysqli_num_rows($result2);
            if($row == 1){
                $_SESSION['adm2'] = true;
                $url = "cadprod.php";
                echo '<script>window.location = "'.$url.'";</script>';
            }
        }
    }
    //SELECIONA CONTEUDO DO BANCO DE DADOS PARA EFETUAR LOGIN
    $apertou1 = filter_input(INPUT_POST, 'envia1', FILTER_SANITIZE_STRING);
    if($apertou1){
        if(!empty($_POST['nome1']) && !empty($_POST['senha1'])) {    
            $nome = filter_input(INPUT_POST, 'nome1', FILTER_SANITIZE_STRING);
            $senha2 = filter_input(INPUT_POST, 'senha1', FILTER_SANITIZE_STRING);
            $sql = "SELECT * FROM validafunc WHERE nome = '{$_POST['nome1']}' and senha = '{$_POST['senha1']}'";
            $result2 = mysqli_query($msqli, $sql);
            $row = mysqli_num_rows($result2);
            if($row == 1){
                $_SESSION['$nome2'] = true;
                $url = "caixa.php";
                echo '<script>window.location = "'.$url.'";</script>';
            }
        }    
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Açougue do Fiel</title>
    <link rel="stylesheet" href="/projects/acouguedofiel/css/login.css">
</head>
<body>
    <section>
        <h1>AÇOUGUE DO FIEL</h1>
        <div class="flexbox">
            <div class="formulario">
                <br> <h2>Funcionário</h2>
                <div class="ajuste-form">
                    <form action="" method="POST">
                        <input type="text" name="nome1" placeholder="Nome" value = "funcionario" autocomplete = "off"> <br>
                        <input type="password" name="senha1" placeholder ="Senha" value = "1234" autocomplete = "off"> <br>
                        <div class='flexbox'>
                            <input type="submit" class="envia" name="envia1">
                        </div>
                        <?php
                            if($apertou1){
                                if(empty($_POST['nome1']) && empty($_POST['senha1'])){
                                    echo '<p class="aviso">*Preencha os campos necessários</p>';
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
            <div class="formulario">
                <br> <h2>Administrador</h2>
                <div class="ajuste-form">
                    <form action="" method="POST">
                        <input type="text" name="nome2" placeholder="Nome" value="adm" autocomplete = "off"> <br>
                        <input type="password" name="senha2" placeholder ="Senha" value = "1234" autocomplete = "off"> <br>
                        <div class='flexbox'>
                            <input type="submit" class="envia" name="envia2">
                        </div>
                        <?php
                            if($apertou2){
                                if(empty($_POST['nome2']) && empty($_POST['senha2'])){
                                    echo '<p class="aviso">*Preencha os campos necessários</p>';
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>