import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import HomeScreen from './screens/HomeScreen';
import AddEditProdutoScreen from './screens/AddEditProdutoScreen';
import ProdutosScreen from './screens/ProductsScreen';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<HomeScreen />} />
        <Route path="/produtos" element={<ProdutosScreen />} />
        <Route path="/add-edit-produto" element={<AddEditProdutoScreen />} />
      </Routes>
    </Router>
  );
}

export default App;
