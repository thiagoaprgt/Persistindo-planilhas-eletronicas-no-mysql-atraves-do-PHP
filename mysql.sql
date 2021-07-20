create database exemplo_produto;

use exemplo_produto;

create table produtos (

    `id` int(5) primary key not null auto_increment,
    `nome` varchar(15) not null unique,
    `preco_venda` int(15) not null,
    `preco_custo` int(15) not null,
    `estoque` int(5) not null


);
