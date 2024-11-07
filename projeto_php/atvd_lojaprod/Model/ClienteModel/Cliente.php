<?php 

    class Cliente{
        public $id;
        public $nome;
        public $endereco;
        public $cpf;
        public $telefone;
        public $email;
        public $dataNasc;

        function __construct($id_informado, $nome_informado, $endereco_informado, $cpf_informado, $telefone_informado, $email_informado, $dataNasc_informada){
            $this->id = $id_informado;
            $this->nome = $nome_informado;
            $this->endereco = $endereco_informado;
            $this->cpf = $cpf_informado;
            $this->telefone = $telefone_informado;
            $this->email = $email_informado;
            $this->dataNasc = $dataNasc_informada;
        }

        
    }
?>
