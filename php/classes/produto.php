<?php
    class Produto{
        //Atributos
        protected $id;
        public $codigo;
        public $descricao;
        public $valor_custo;
        public $valor_venda;
        public $qtd_estoque;
        public $qtd_minima;
        public $qtd_venda;
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
        function setValorCusto($vc){
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
        function getQtdVenda(){
            return $this->qtd_venda;
        }
        function setQtdVenda($qtd){
            $this->qtd_venda = $qtd;
        }
        //Functions
    }
?>