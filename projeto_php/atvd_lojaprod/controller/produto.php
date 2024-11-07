<?php

header("Access-Control-Allow-Origin: *"); // Permite todas as origens
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeçalhos permitidos

require_once '../DAO/Conexao.php';
require_once '../DAO/ProdutoDAO/ProdutoGet.php';
require_once '../DAO/ProdutoDAO/ProdutoPost.php';
require_once '../DAO/ProdutoDAO/ProdutoPut.php';
require_once '../DAO/ProdutoDAO/ProdutoPatch.php';
require '../DAO/ProdutoDAO/ProdutoDelete.php';
require '../Model/ProdutoModel/Produto.php';
require '../Model/ProdutoModel/RespostaProduto.php';
require './produtoUtils.php';

$req = $_SERVER;
$conexao = conectar();

switch ($req["REQUEST_METHOD"]) {
    case 'GET':
        $produtos = json_encode(pegar_produtos($conexao));
        echo $produtos;
        break;

    case 'POST':
        $u = receberDados();
        $resp = incluir_produto($conexao, $u);
        $in = new Resposta('', '');
        if ($resp) {
            $in = criarResposta('200', 'Incluso com sucesso');
        } else {
            $in = criarResposta('400', 'Não incluso');
        }
        echo json_encode($in);
        break;

        case 'PUT':
            // Recebe os dados enviados (JSON)
            $dados = json_decode(file_get_contents('php://input'));
    
            // Verifica se o ID foi fornecido
            if (isset($dados->id)) {
                $id = $dados->id;
    
                // Cria um objeto $u com os dados do produto
                $u = new stdClass();
                $u->nome = $dados->nome;
                $u->descricao = $dados->descricao;
                $u->preco = $dados->preco;
                $u->qtd = $dados->qtd;
                $u->marca = $dados->marca;
                $u->validade = $dados->validade;
    
                // Chama a função editar_produto do arquivo produtodao.php
                $resp = editar_produto($conexao, $u, $id);
    
                // Se a edição for bem-sucedida
                if ($resp) {
                    echo json_encode(["status" => "204", "message" => "Produto atualizado com sucesso"]);
                } else {
                    // Se a edição falhar
                    echo json_encode(["status" => "400", "message" => "Produto não atualizado"]);
                }
            } else {
                // Se o ID não for fornecido
                echo json_encode(["status" => "400", "message" => "ID do produto não fornecido"]);
            }
            break;
    
        
        

    case 'PATCH':
        // Se você não está usando o PATCH, você pode remover ou implementar
        $resp = editar_produto_parcialmente($conexao);
        $resposta = new Resposta('', '');
        if ($resp) {
            $resposta = criarResposta('204', 'Atualizado com sucesso');
        } else {
            $resposta = criarResposta('400', 'Não atualizado');
        }
        echo json_encode($resposta);
        break;

    case 'DELETE':
        $dados = json_decode(file_get_contents('php://input'));
        if (isset($dados->id)) {
            $id = $dados->id;
            $resp = deletar_produto($conexao, $id);
            $resposta = new Resposta('', '');
            if ($resp) {
                $resposta = criarResposta('204', 'Excluído com sucesso');
            } else {
                $resposta = criarResposta('400', 'Não excluído');
            }
            echo json_encode($resposta);
        } else {
            echo json_encode(criarResposta('400', 'ID do produto não fornecido'));
        }
        break;

    default:
        echo json_encode(criarResposta('405', 'Método não permitido'));
        break;
}
