import React, { useState, useEffect } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import './AddEditProdutoScreen.css'; // CSS para estilização

const AddEditProdutoScreen = () => {
    const navigate = useNavigate();
    const location = useLocation();
    const [nome, setNome] = useState('');

    useEffect(() => {
        if (location.state?.produto) {
            setNome(location.state.produto.nome);
        }
    }, [location.state]);

    const handleSave = () => {
        if (location.state?.produto) {
            console.log('Produto atualizado:', { nome });
        } else {
            console.log('Novo produto adicionado:', { nome });
        }
        navigate(-1); // Volta para a tela anterior
    };

    return (
        <div className="container">
            <h1>{location.state?.produto ? 'Editar Produto' : 'Adicionar Produto'}</h1>
            <input
                className="input"
                type="text"
                placeholder="Nome do produto"
                value={nome}
                onChange={(e) => setNome(e.target.value)}
            />
            <button onClick={handleSave}>Salvar</button>
        </div>
    );
};

export default AddEditProdutoScreen;
