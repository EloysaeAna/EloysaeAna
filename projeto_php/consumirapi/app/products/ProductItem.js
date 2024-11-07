// ProductItem.js
import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const ProductItem = ({ product }) => {
    return (
        <View style={styles.container}>
            <Text style={styles.title}>{product.nome}</Text>
            <Text>{product.descricao}</Text>
            <Text>Preço: R${product.preco}</Text>
        </View>
    );
};

const styles = StyleSheet.create({
    container: {
        marginBottom: 15,
        padding: 10,
        borderWidth: 1,
        borderColor: '#ccc',
        borderRadius: 5,
    },
    title: {
        fontSize: 18,
        fontWeight: 'bold',
    },
});

export default ProductItem;
