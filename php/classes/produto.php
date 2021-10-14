<?php
    class Produto{
        //Atributos
        protected $id;
        protected $codigo;
        protected $descricao;
        protected $valor_custo;
        protected $valor_venda;
        protected $qtd_estoque;
        protected $qtd_minima;
        //Construct
        function __construct($codigo, $descricao, $valor_custo, $valor_venda, $qtd_estoque, $qtd_minima)
        {
            $this->codigo = $codigo;
            $this->descricao = $descricao;
            $this->valor = $valor_custo;
            $this->valor_venda = $valor_venda;
            $this->qtd_estoque = $qtd_estoque;
            $this->qtd_minima = $qtd_minima;
        }
        //Getters e Setters
        function getId(){
            return $this->id;
        }
        function setId($id){
            $this->id = $id;
        }
        function getCodigo(){
            return $this->codigo;
        }
        function setCodigo($c){
            $this->codigo = $c;
        }
        function getDescricao(){
            return $this->descricao;
        }
        function setDescricao($d){
            $this->descricao = $d;
        }
        function getValorCusto(){
            return $this->valor_custo;
        }
        function setValor($vc){
            $this->valor_custo = $vc;
        }
        function getValorVenda(){
            return $this->valor_venda;
        }
        function setValorVenda($vv){
            $this->valor_venda = $vv;
        }
        function getQtdEstoque(){
            return $this->qtd_estoque;
        }
        function setQtdEstoque($qtd){
            $this->qtd_estoque = $qtd;
        }
        function getQtdMin(){
            return $this->qtd_minima;
        }
        function setQtdMin($qtd){
            $this->qtd_minima = $qtd;
        }
        //Functions
        function editaProd($msqli){
            $update = "UPDATE cadastro_produto
            SET descricao = '$this->descricao', preco_custo = '$this->valor_custo', preco_venda = '$this->valor_venda', qtd_estoque = '$this->qtd_estoque', qtd_minima = '$this->qtd_minima'
            WHERE codigo = '$this->codigo'";
            $result = mysqli_query($msqli, $update);
        }
        function pesquisaProd($msqli, $codigo){
            $this->codigo = $codigo;
            $select = "SELECT * FROM cadastro_produto WHERE codigo = '$codigo'";
            $result = mysqli_query($msqli, $select);
            $row = mysqli_num_rows($result);
            if($row < 1){
                echo'<p class="aviso"> *Produto não encontrado </p>';
            }else{
                $dados = mysqli_fetch_array($result);
                $this->descricao = $dados['descricao'];
                $this->valor_custo = $dados['preco_custo'];
                $this->valor_venda = $dados['preco_venda'];
                $this->qtd_estoque = $dados['qtd_estoque'];
                $this->qtd_minima = $dados['qtd_minima'];
            }            
        }
        function cadastrarProd($msqli){
            $select = "SELECT * FROM cadastro_produto WHERE codigo = '$this->codigo'";
            $result = mysqli_query($msqli, $select);
            $row = mysqli_num_rows($result);
            if($row>0){
                echo '<p class="aviso">*Produto já cadastrado</p>';
            }else{
                $resultado = "INSERT INTO cadastro_produto (codigo, descricao, preco_custo, preco_venda, qtd_estoque, qtd_minima) VALUES('$this->codigo', '$this->descricao', '$this->valor_custo', '$this->valor_venda', '$this->qtd_estoque', '$this->qtd_minima')";
                $result = mysqli_query($msqli, $resultado); 
            }
        }
    }
?>