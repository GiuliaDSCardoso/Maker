CREATE DATABASE Cadastro;
USE Cadastro;

CREATE TABLE Cadastrar(
    id int auto_increment not null primary key,
    nome varchar(50) not null,
    email varchar(50) not null,
    senha varchar(255) not null
);