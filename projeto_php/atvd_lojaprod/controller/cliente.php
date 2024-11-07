<?php
    require_once '../DAO/Conexao.php';
    require_once '../DAO/ClienteDAO/ClienteGet.php';
    require_once '../DAO/ClienteDAO/ClientePost.php';
    require_once '../DAO/ClienteDAO/ClientePut.php';
    require_once '../DAO/ClienteDAO/ClientePatch.php';
    require '../DAO/ClienteDAO/ClienteDelete.php';
    require '../Model/ClienteModel/Cliente.php';
    require '../Model/ClienteModel/RespostaCliente.php';
    require './clienteUtils.php';
    $req = $_SERVER;
    $conexao = conectar();
    
    //echo $req["REQUEST_METHOD"];
     switch ($req["REQUEST_METHOD"]) {
         case 'GET':
            $clientes = json_encode(pegar_clientes($conexao));
            echo $clientes;
             break;
         case 'POST':
             
             $u = receberDados();
             
             $resp = incluir_cliente($conexao, $u);
             
             $in = new Resposta('', '');
                if($resp){
                   $in = criarResposta('200', 'Incluso com sucesso');
                } else {
                  $in = criarResposta('400', 'não incluso');
                }
             
             echo json_encode($in);
          
             break;
         case 'PUT':
            $dados = json_decode(file_get_contents('php://input'));
            $id = $dados->id;

            $u = receberDados();

            $resp = editar_cliente($conexao, $u, $id);

            $in = new Resposta('', '');
                if($resp){
                   $in = criarResposta('204', 'Atualizado com sucesso');
                } else {
                  $in = criarResposta('400', 'Não atualizado');
                }

            echo json_encode($in);
             break;
         case 'PATCH':

            $resp = editar_cliente_parcialmente($conexao);
            $resposta = new Resposta('','');
            if($resp){
                $resposta = criarResposta('204', 'Atualizado com sucesso');
            } else{
               $resposta = criarResposta('400', 'Não atualizado');
            }
            echo 'Atualizado com Sucesso';
             break;
       
             case 'DELETE':
                $dados = json_decode(file_get_contents('php://input'));
                
                // Verifica se o ID foi passado
                if (isset($dados->id)) {
                    $id = $dados->id;
            
                    // Chama a função para deletar o cliente
                    $resp = deletar_cliente($conexao, $id);
                    $resposta = new Resposta('', '');
            
                    if ($resp) {
                        $resposta = criarResposta('204', 'Excluido com sucesso');
                    } else {
                        $resposta = criarResposta('400', 'Não foi possível excluir');
                    }
                } else {
                    // Resposta de erro se o ID não foi fornecido
                    $resposta = criarResposta('400', 'ID do cliente não fornecido');
                }
            
                echo json_encode($resposta);
                break;
            ;          
         default:
             # code...
             break;
     }





?>