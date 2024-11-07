Create DATABASE loja;
 
USE loja;
 
CREATE TABLE Clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(255),
    cpf CHAR(14) NOT NULL UNIQUE, -- Considerando CPF com pontos e hífens, formato 'XXX.XXX.XXX-XX'
    telefone VARCHAR(20), -- Ajuste conforme o formato desejado, por exemplo, '(XX) XXXXX-XXXX'
    email VARCHAR(100),
    dataNasc DATE
);
 
 
DROP TABLE IF EXISTS pedidos_produtos;
DROP TABLE IF EXISTS Pedidos;
DROP TABLE IF EXISTS Produtos;
 
-- Recrie as tabelas na ordem correta
CREATE TABLE Produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    qtd INT NOT NULL,
    marca VARCHAR(50),
    preco DECIMAL(10, 2) NOT NULL,
    validade DATE
);
 
CREATE TABLE Pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    data DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES Clientes(ID)
);
 
CREATE TABLE pedidos_produtos (
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    qtd INT NOT NULL,
    PRIMARY KEY (id_pedido, id_produto),  -- Chave primária composta
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES Produtos(ID)
);
 
 
 
-- Inserindo 10 registros de exemplo na tabela Pessoas
INSERT INTO Clientes (nome, endereco, cpf, telefone, email, dataNasc)
VALUES
    ('João da Silva', 'Rua Exemplo, 123, São Paulo, SP', '123.456.789-00', '(11) 98765-4321', 'joao.silva@example.com', '1980-05-15'),
    ('Maria Oliveira', 'Avenida Teste, 456, Rio de Janeiro, RJ', '987.654.321-00', '(21) 12345-6789', 'maria.oliveira@example.com', '1990-10-20'),
    ('Carlos Souza', 'Rua das Flores, 789, Belo Horizonte, MG', '111.222.333-44', '(31) 23456-7890', 'carlos.souza@example.com', '1985-02-25'),
    ('Ana Costa', 'Praça da Paz, 101, Curitiba, PR', '555.666.777-88', '(41) 34567-8901', 'ana.costa@example.com', '1978-12-10'),
    ('Roberto Almeida', 'Rua do Sol, 202, Recife, PE', '999.888.777-66', '(81) 45678-9012', 'roberto.almeida@example.com', '1992-07-30'),
    ('Fernanda Lima', 'Avenida Central, 303, Salvador, BA', '333.444.555-77', '(71) 56789-0123', 'fernanda.lima@example.com', '1983-03-05'),
    ('Eduardo Martins', 'Rua dos Imortais, 404, Porto Alegre, RS', '444.555.666-88', '(51) 67890-1234', 'eduardo.martins@example.com', '1988-09-12'),
    ('Juliana Pereira', 'Praça das Artes, 505, Fortaleza, CE', '777.888.999-00', '(85) 78901-2345', 'juliana.pereira@example.com', '1995-11-22'),
    ('Paulo Ferreira', 'Rua dos Sonhos, 606, Manaus, AM', '222.333.444-55', '(92) 89012-3456', 'paulo.ferreira@example.com', '1987-04-18'),
    ('Patrícia Santos', 'Avenida do Mar, 707, Brasília, DF', '888.999.000-11', '(61) 90123-4567', 'patricia.santos@example.com', '1991-08-09');
    -- Inserindo alguns registros de exemplo na tabela Produtos
INSERT INTO Produtos (nome, descricao, qtd, marca, preco, validade)
VALUES
    ('Cereal Matinal', 'Cereal matinal de milho e aveia', '109', 'Kellogg\'s', 15.99, '2025-08-31'),
    ('Suco de Laranja', 'Suco de laranja 1 litro', '56', 'Del Valle', 6.49, '2024-06-15'),
    ('Biscoito Recheado', 'Biscoito recheado com creme de chocolate', '33', 'Bauducco', 4.79, '2024-12-31'),
    ('Arroz Tipo 1', 'Arroz branco tipo 1, 5kg', '47', 'Tio João', 20.99, '2026-02-28'),
    ('Leite Integral', 'Leite integral 1 litro', '89', 'Itambé', 3.29, '2024-07-10'),
    ('Macarrão Espaguete', 'Macarrão espaguete 500g', '118', 'Renata', 2.99, '2025-01-20'),
    ('Café em Pó', 'Café em pó 250g', '65', 'Pilão', 8.99, '2024-09-15'),
    ('Óleo de Soja', 'Óleo de soja 900ml', '19', 'Soya', 5.49, '2025-05-10'),
    ('Maionese', 'Maionese 500g', '38', 'Hellmann\'s', 7.49, '2024-11-30'),
    ('Papel Toalha', 'Papel toalha 2 rolos', '99', 'Scott', 12.99, '2025-03-01');
-- Inserindo registros de exemplo na tabela Pedidos
INSERT INTO Pedidos (id_cliente, data) VALUES
    (1, '2024-08-15'), -- Pedido de João da Silva
    (2, '2024-08-16'), -- Pedido de Maria Oliveira
    (3, '2024-08-17'), -- Pedido de Carlos Souza
    (4, '2024-08-18'), -- Pedido de Ana Costa
    (5, '2024-08-19'), -- Pedido de Roberto Almeida
    (6, '2024-08-20'), -- Pedido de Fernanda Lima
    (7, '2024-08-21'), -- Pedido de Eduardo Martins
    (8, '2024-08-22'), -- Pedido de Juliana Pereira
    (9, '2024-08-23'), -- Pedido de Paulo Ferreira
    (10, '2024-08-24'); -- Pedido de Patrícia Santos
 
 
INSERT INTO pedidos_produtos (id_pedido, id_produto, qtd) VALUES
    -- Pedido de João da Silva
    (1, 1, 2), -- 2 unidades de Cereal Matinal
    (1, 4, 1), -- 1 unidade de Arroz Tipo 1
    (1, 7, 3), -- 3 unidades de Café em Pó
    (1, 6, 4), -- 4 unidades de Macarrão Espaguete
    -- Pedido de Maria Oliveira
    (2, 2, 5), -- 5 unidades de Suco de Laranja
    (2, 5, 4), -- 4 unidades de Leite Integral
    (2, 1, 3), -- 3 unidades de Cereal Matinal
    (2, 3, 2), -- 2 unidades de Biscoito Recheado
    -- Pedido de Carlos Souza
    (3, 3, 6), -- 6 unidades de Biscoito Recheado
    (3, 8, 2), -- 2 unidades de Óleo de Soja
    (3, 5, 2), -- 2 unidades de Leite Integral
    (3, 7, 4), -- 4 unidades de Café em Pó
    -- Pedido de Ana Costa
    (4, 6, 10), -- 10 unidades de Macarrão Espaguete
    (4, 9, 1), -- 1 unidade de Maionese
    (4, 8, 3), -- 3 unidades de Óleo de Soja
    (4, 10, 2), -- 2 unidades de Papel Toalha
    -- Pedido de Roberto Almeida
    (5, 1, 1), -- 1 unidade de Cereal Matinal
    (5, 2, 3), -- 3 unidades de Suco de Laranja
    (5, 4, 2), -- 2 unidades de Arroz Tipo 1
    (5, 8, 1), -- 1 unidade de Óleo de Soja
    (5, 6, 3), -- 3 unidades de Macarrão Espaguete
    (5, 9, 1), -- 1 unidade de Maionese
    -- Pedido de Fernanda Lima
    (6, 5, 2), -- 2 unidades de Leite Integral
    (6, 7, 1), -- 1 unidade de Café em Pó
    (6, 3, 3), -- 3 unidades de Biscoito Recheado
    (6, 4, 2), -- 2 unidades de Arroz Tipo 1
    -- Pedido de Eduardo Martins
    (7, 3, 3), -- 3 unidades de Biscoito Recheado
    (7, 6, 5), -- 5 unidades de Macarrão Espaguete
    (7, 10, 1), -- 1 unidade de Papel Toalha
    (7, 2, 1), -- 1 unidade de Suco de Laranja
    (7, 9, 1), -- 1 unidade de Maionese
    -- Pedido de Juliana Pereira
    (8, 1, 4), -- 4 unidades de Cereal Matinal
    (8, 2, 2), -- 2 unidades de Suco de Laranja
    (8, 5, 1), -- 1 unidade de Leite Integral
    (8, 7, 2), -- 2 unidades de Café em Pó
    (8, 10, 3), -- 3 unidades de Papel Toalha
    -- Pedido de Paulo Ferreira
    (9, 4, 3), -- 3 unidades de Arroz Tipo 1
    (9, 8, 2), -- 2 unidades de Óleo de Soja
    (9, 1, 1), -- 1 unidade de Cereal Matinal
    (9, 6, 2), -- 2 unidades de Macarrão Espaguete
    -- Pedido de Patrícia Santos
    (10, 5, 3), -- 3 unidades de Leite Integral
    (10, 2, 2), -- 2 unidades de Suco de Laranja
    (10, 3, 2), -- 2 unidades de Biscoito Recheado
    (10, 9, 2), -- 2 unidades de Maionese
    (10, 10, 1); -- 1 unidade de Papel Toalha
 
 
-- selecionar tabela 
SELECT * FROM Produtos;
SELECT * FROM Pedidos;
SELECT * FROM  pedidos_produtos;
SELECT * FROM  Clientes;
 
DROP DATABASE loja;