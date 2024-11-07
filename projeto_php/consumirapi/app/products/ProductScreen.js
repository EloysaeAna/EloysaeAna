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
        // Logando os dados antes de enviar
        console.log("Dados para adicionar:", { nome, descricao, preco, qtd, marca, validade });
    
        if (!nome || !descricao || !preco || !qtd || !marca || !validade) {
            alert('Erro', 'Por favor, preencha todos os campos.');
            return;
        }
    
        const url = 'http://localhost/projeto_php/atvd_lojaprod/controller/produto.php';
        const body = JSON.stringify({ nome, descricao, preco, qtd, marca, validade });
    
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
    
            console.log("Produto adicionado com sucesso.");
            fetchProdutos();
            resetForm();
        } catch (error) {
            console.error(error);
            alert('Erro', error.message);
        }
    };
    

    const handleEditProduct = async () => {
        console.log("Dados para editar:", { nome, descricao, preco, qtd, marca, validade, editingProductId });
    
        if (!nome || !descricao || !preco || !qtd || !marca || !validade || editingProductId === null) {
            alert('Erro', 'Por favor, preencha todos os campos e selecione um produto para editar.');
            return;
        }
    
        // A URL deve incluir o ID do produto a ser editado
        const url = `http://localhost/projeto_php/atvd_lojaprod/controller/produto.php?id=${editingProductId}`;
        const body = JSON.stringify({ nome, descricao, preco, qtd, marca, validade });
    
        try {
            const response = await fetch(url, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body,
            });
    
            const data = await response.json(); // Log da resposta
            console.log("Resposta do servidor:", data);
    
            if (!response.ok) {
                throw new Error(`Erro ao atualizar produto: ${data.message}`);
            }
    
            console.log("Produto atualizado com sucesso.");
            fetchProdutos();
            resetForm();
        } catch (error) {
            console.error(error);
            alert(error.message);
        }
    };
    
    
    

    const handleDeleteProduct = async (id) => {
        if (window.confirm('Tem certeza que deseja excluir este produto?')) {
            try {
                const response = await fetch('http://localhost/projeto_php/atvd_lojaprod/controller/produto.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id }),
                });
    
                const data = await response.json(); // Log da resposta
                console.log(data); // Mostre a resposta do servidor no console
                
                if (!response.ok) {
                    throw new Error(`Erro ao excluir produto: ${data.message}`);
                }
                fetchProdutos();
            } catch (error) {
                console.error(error);
                alert(error.message);
            }
        }
    };
    

    const handleStartEdit = (product) => {
        setNome(product.nome);
        setDescricao(product.descricao);
        setPreco(product.preco);
        setQtd(product.qtd);
        setMarca(product.marca);
        setValidade(product.validade);
        setEditingProductId(product.id);
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
