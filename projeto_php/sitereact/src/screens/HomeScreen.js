import React from 'react';
import { Link } from 'react-router-dom'; // Para navegação web
import './HomeScreen.css'; // Arquivo CSS para estilização

const HomeScreen = () => {
    return (
        <div className="container">
            <h1 className="title">Bem-vindo ao App</h1>
            <Link to="/produtos">
                <button className="button green">Produtos</button>
            </Link>
            <button className="button blue" onClick={() => alert('Funcionalidade em desenvolvimento!')}>
                Clientes
            </button>
        </div>
    );
};

export default HomeScreen;
