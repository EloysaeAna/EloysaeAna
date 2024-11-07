import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom'; // Usando o hook de navegação para web
import './ProductsScreen.css'; // Certifique-se de ter um arquivo CSS para os estilos

const ProductsScreen = () => {
    const [produtos, setProdutos] = useState([]);
    const [loading, setLoading] = useState(true);
    const [nome, setNome] = useState('');
    const [descricao, setDescricao] = useState('');
    const [preco, setPreco] = useState('');
    const [qtd, setQtd] = useState('');
    const [marca, setMarca] = useState('');
    const [validade, setValidade] = useState('');
    const [editingProductId, setEditingProductId] = useState(null);
    const tableHead = ['Nome', 'Descrição', 'Marca', 'Preço', 'Quantidade', 'Validade', 'Ações'];
    const navigate = useNavigate(); // Usando o hook useNavigate

    useEffect(() => {
        fetchProdutos();
    }, []);

    const fetchProdutos = async () => {
        try {
            const response = await fetch('http://localhost/projeto_php/atvd_lojaprod/controller/produto.php');
            if (!response.ok) {
                throw new Error('Erro ao buscar produtos');
            }
            const data = await response.json();
            setProdutos(data);
        } catch (error) {
            console.error(error);
        } finally {
            setLoading(false);
        }
    };

    const handleAddProduct = async () => {
        if (!nome || !descricao || !preco || !qtd || !marca || !validade) {
            alert('Erro', 'Por favor, preencha todos os campos.');
            return;
        }
    
        // Verificar se a data está no formato correto (AAAA-MM-DD)
        const validadeFormatada = validade.match(/^\d{4}-\d{2}-\d{2}$/) ? validade : '';
    
        if (!validadeFormatada) {
            alert('Erro', 'A data de validade deve estar no formato AAAA-MM-DD.');
            return;
        }
    
        const url = 'http://localhost/projeto_php/atvd_lojaprod/controller/produto.php';
        const body = JSON.stringify({ nome, descricao, preco, qtd, marca, validade: validadeFormatada });
    
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body,
            });
            if (!response.ok) {
                const errorResponse = await response.text();
                throw new Error(`Erro ao adicionar produto: ${errorResponse}`);
            }
            fetchProdutos();
            resetForm();
        } catch (error) {
            console.error(error);
            alert('Erro', error.message);
        }
    };
    

    const handleEditProduct = async () => {
        if (!nome || !descricao || !preco || !qtd || !marca || !validade || editingProductId === null) {
            alert('Erro', 'Por favor, preencha todos os campos e selecione um produto para editar.');
            return;
        }

        const url = `http://localhost/projeto_php/atvd_lojaprod/controller/produto.php`;
        const body = JSON.stringify({
            id: editingProductId,
            nome,
            descricao,
            preco,
            qtd,
            marca,
            validade
        });

        try {
            const response = await fetch(url, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body,
            });

            const result = await response.json();
            console.log(result); // Logar a resposta para depuração

            if (!response.ok) {
                alert('Erro ao atualizar produto: ' + result.message);
                return;
            }

            // Atualiza a lista de produtos após a edição
            fetchProdutos();

            // Resetar o formulário após editar
            resetForm();
        } catch (error) {
            console.error('Erro:', error);
            alert('Erro ao atualizar o produto: ' + error.message);
        }
    };

    const handleDeleteProduct = async (id) => {
        try {
            const response = await fetch('http://localhost/projeto_php/atvd_lojaprod/controller/produto.php', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id }),
            });
            if (!response.ok) {
                const errorResponse = await response.text();
                throw new Error(`Erro ao excluir produto: ${errorResponse}`);
            }
            fetchProdutos();
        } catch (error) {
            console.error(error);
            alert('Erro', error.message);
        }
    };

    const handleStartEdit = (product) => {
        setNome(product.nome);
        setDescricao(product.descricao);
        setPreco(product.preco);
        setQtd(product.qtd);
        setMarca(product.marca);
        setValidade(product.validade);
        setEditingProductId(product.id); // Definir o ID do produto para editar
    };

    const resetForm = () => {
        setNome('');
        setDescricao('');
        setPreco('');
        setQtd('');
        setMarca('');
        setValidade('');
        setEditingProductId(null);
    };

    if (loading) {
        return <div className="loading">Carregando...</div>;
    }

    return (
        <div className="container">
            <h1>Gerenciar Produtos</h1>
            <div className="form-container">
                <input
                    placeholder="Nome"
                    value={nome}
                    onChange={(e) => setNome(e.target.value)}
                    className="input"
                />
                <input
                    placeholder="Descrição"
                    value={descricao}
                    onChange={(e) => setDescricao(e.target.value)}
                    className="input"
                />
                <input
                    placeholder="Marca"
                    value={marca}
                    onChange={(e) => setMarca(e.target.value)}
                    className="input"
                />
                <input
                    placeholder="Preço"
                    value={preco}
                    onChange={(e) => setPreco(e.target.value)}
                    type="number"
                    className="input"
                />
                <input
                    placeholder="Quantidade"
                    value={qtd}
                    onChange={(e) => setQtd(e.target.value)}
                    type="number"
                    className="input"
                />
                <input
                    placeholder="Validade (AAAA-MM-DD)"
                    value={validade}
                    onChange={(e) => setValidade(e.target.value)}
                    className="input"
                />
                {editingProductId ? (
                    <button onClick={handleEditProduct} className="button green">
                        Atualizar Produto
                    </button>
                ) : (
                    <button onClick={handleAddProduct} className="button blue">
                        Adicionar Produto
                    </button>
                )}
                {editingProductId && (
                    <button onClick={resetForm} className="button red">
                        Cancelar
                    </button>
                )}
            </div>

            <table className="table">
                <thead>
                    <tr>
                        {tableHead.map((header, index) => (
                            <th key={index}>{header}</th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {produtos.map((item) => (
                        <tr key={item.id}>
                            <td>{item.nome}</td>
                            <td>{item.descricao}</td>
                            <td>{item.marca}</td>
                            <td>{item.preco ? `R$ ${item.preco}` : '---'}</td>
                            <td>{item.qtd ? item.qtd : '---'}</td>
                            <td>{item.validade}</td>
                            <td>
                                <button
                                    className="button blue"
                                    onClick={() => handleStartEdit(item)}
                                >
                                    Editar
                                </button>
                                <button
                                    className="button red"
                                    onClick={() => handleDeleteProduct(item.id)}
                                >
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default ProductsScreen;
