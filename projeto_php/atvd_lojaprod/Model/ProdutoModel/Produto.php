<?php 

    class Produto{
        public $id;
        public $nome;
        public $descricao;
        public $qtd;
        public $marca;
        public $preco;
        public $validade;

        function __construct($id_informado, $nome_informado, $descricao_informada, $qtd_informada, $marca_informada, $preco_informado, $validade_informada){
            $this->id = $id_informado;
            $this->nome = $nome_informado;
            $this->descricao = $descricao_informada;
            $this->qtd = $qtd_informada;
            $this->marca = $marca_informada;
            $this->preco = $preco_informado;
            $this->validade = $validade_informada;
        }

        
    }
?>
