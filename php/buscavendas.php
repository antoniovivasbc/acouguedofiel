<?php
    $envia_data = filter_input(INPUT_POST, 'envia-data', FILTER_SANITIZE_STRING);
    if($envia_data){
        $data = $_POST['datavenda'];
        $pesquisa = "SELECT * FROM cadastro_produto WHERE datta = '$data'";
        $resultado = mysqli_query($msqli, $pesquisa);
        while ($dados2 = mysqli_fetch_array($resultado)){
            $codigo2 = $dados2['codigo'];
            $descricao2 = $dados2['descricao'];
            $preco_venda2 = $dados2['preco'];
            $qtd2 = $dados2['quantidade'];
            $preco_total2 = $dados2['valor_total'];
            $id2 = $dados2['id'];
            $data = $dados2['datta'];
            $hora = $dados2['hora'];
            echo
                "<tr>
                    <th>$codigo2</th>
                    <th>$descricao2</th>
                    <th>$qtd2</th>
                    <th>$preco_venda2</th>
                    <th>$preco_total2</th>
                    <th>$data</th>
                    <th>$hora</th>
                </tr>";
        }
    }
    
?>