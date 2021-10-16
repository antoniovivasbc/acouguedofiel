<?php
    require_once "produto.php";
    class Usuario{
        private $nome;
        private $senha;
        private $produto;
        function __construct($produto)
        {
            $this->produto = $produto;
        }
        function getNome(){
            return $this->nome;
        }
        function setNome($n){
            $this->nome = $n;
        }
        function getSenha(){
            return $this->senha;
        }
        function setSenha($s){
            $this->senha = $s;
        }
        function getProd(){
            return $this->produto;
        }
        function setProd($p){
            $this->produto = $p;
        }
        function venderProd($msqli){
            $select = "SELECT * FROM caixa";
            $result = mysqli_query($msqli, $select);
            while($dados = mysqli_fetch_array($result)){
                $this->produto->setCodigo($dados['codigo']);
                $this->produto->setDescricao($dados['descricao']);
                $this->produto->setValorVenda($dados['preco']);
                $p = $this->produto;
                $data = date('Y-m-d');
                $hora = date("h:i");
                $valor_total = $this->produto->getValorVenda();
                $qtd = $valor_total/$this->produto->getValorVenda();
                $insert = "INSERT INTO vendas (codigo, descricao, preco, quantidade, valor_total, datta, hora) VALUES ('$p->codigo', '$p->descricao', '$p->valor_venda', '$qtd', '$valor_total', '$data', '$hora')";
                mysqli_query($msqli, $insert);
                $update = "UPDATE cadastro_produto SET qtd_estoque = qtd_estoque-1 WHERE codigo = '$p->codigo'";
                mysqli_query($msqli, $update);
            }   
            $finaliza_caixa = "DELETE FROM caixa";
            mysqli_query($msqli, $finaliza_caixa);
            echo json_encode('');
        }
        function cadastrarProd($msqli){
            $p = $this->produto;
            $select = "SELECT * FROM cadastro_produto WHERE codigo = '$p->codigo'";
            $result = mysqli_query($msqli, $select);
            $row = mysqli_num_rows($result);
            if($row>0){
                echo '<p class="aviso">*Produto já cadastrado</p>';
            }else{
                $insert = "INSERT INTO cadastro_produto (codigo, descricao, preco_custo, preco_venda, qtd_estoque, qtd_minima) VALUES($p->codigo, $p->descricao, $p->valor_custo, $p->valor_venda, $p->qtd_estoque, $p->qtd_minima)";
                mysqli_query($msqli, $insert); 
            }
        }
        function pesquisarProd($msqli, $codigo){
            $select = "SELECT * FROM cadastro_produto WHERE codigo = '$codigo'";
            $result = mysqli_query($msqli, $select);
            $row = mysqli_num_rows($result);
            if($row < 1){
                echo'<p class="aviso"> *Produto não encontrado </p>';
                echo json_encode('');
            }else{
                $dados = mysqli_fetch_array($result);
                echo json_encode($dados);
                $this->produto->setDescricao($dados['descricao']);
                $this->produto->setValorCusto($dados['preco_custo']);
                $this->produto->setValorVenda($dados['preco_venda']);
                $this->produto->setQtdEstoque($dados['qtd_estoque']);
                $this->produto->setQtdMin($dados['qtd_minima']);
                return $this->produto;
            }
        }
        function editarProd($msqli){
            $p = $this->produto;
            $update = "UPDATE cadastro_produto
            SET descricao = '$p->descricao', preco_custo = '$p->valor_custo', preco_venda = '$p->valor_venda', qtd_estoque = '$p->qtd_estoque', qtd_minima = '$p->qtd_minima'
            WHERE codigo = '$p->codigo'";
            mysqli_query($msqli, $update);
        }
        function buscaEstoque($msqli){
            $select = "SELECT * FROM cadastro_produto";
            $resultado = mysqli_query($msqli, $select);
            while ($dados = mysqli_fetch_array($resultado)){
                $this->produto->codigo = $dados['codigo'];
                $this->produto->descricao = $dados['descricao'];
                $this->produto->valor_custo = $dados['preco_custo'];
                $this->produto->qtd_estoque = $dados['qtd_estoque'];
                $this->produto->qtd_minima = $dados['qtd_minima'];
                if($this->produto->qtd_estoque <= $this->produto->qtd_minima){
                    echo
                    "<tr>
                        <th>".$this->produto->codigo."</th>
                        <th>".$this->produto->descricao."</th>
                        <th>".$this->produto->valor_custo."</th>
                        <th>".$this->produto->qtd_estoque."</th>
                    </tr>";
                }
            }
        }
        function buscavendas($msqli, $data, $total){
            $pesquisa = "SELECT * FROM vendas WHERE datta = '$data'";
            $resultado = mysqli_query($msqli, $pesquisa);
            while ($dados = mysqli_fetch_array($resultado)){
                $this->produto->codigo = $dados['codigo'];
                $this->produto->descricao = $dados['descricao'];
                $this->produto->valor_venda = $dados['preco'];
                $preco_total = $dados['valor_total'];
                $data = $dados['datta'];
                $hora = $dados['hora'];
                $total = $total + $preco_total;
                echo
                    "<tr>
                        <th>".$this->produto->codigo."</th>
                        <th>".$this->produto->descricao."</th>
                        <th>".$this->produto->valor_venda."</th>
                        <th>".$data."</th>
                        <th>".$hora."</th>
                    </tr>";
            }
            return $total;
        }
    }
?>