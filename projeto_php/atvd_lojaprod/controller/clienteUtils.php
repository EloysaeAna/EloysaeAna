<?php 
         function criarResposta($status, $msg){
            $resp = new Resposta($status, $msg);
     
            return $resp;
         }
    
         function receberDados(){
            $dados = json_decode(file_get_contents('php://input'));
            
            $nome = $dados->nome;
            $endereco = $dados->endereco;
            $cpf = $dados->cpf;
            $telefone = $dados->telefone;
            $email = $dados->email;
            $dataNasc = $dados->dataNasc;
    
            $dadosCliente = new Cliente("",$nome, $endereco, $cpf, $telefone, $email, $dataNasc);
            return $dadosCliente;
        }
?> 