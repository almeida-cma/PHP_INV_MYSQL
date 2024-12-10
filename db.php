<?php
function conectar_db() {
    $host = 'localhost';
    $port = 7306; // Porta personalizada
    $dbname = 'meu_projeto';
    $username = 'root'; // Altere para seu usuário do MySQL
    $password = ''; // Altere para sua senha do MySQL

    try {
        // Conectar ao MySQL sem especificar o banco de dados
        $db = new PDO("mysql:host=$host;port=$port;charset=utf8", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        // Criar o banco de dados se não existir
        $db->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        
        // Conectar ao banco de dados específico
        $db->exec("USE $dbname");

        // Criação da tabela de usuários
        $db->exec("CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) UNIQUE,
            senha VARCHAR(255)
        )");

        // Criação da tabela de produtos
        $db->exec("CREATE TABLE IF NOT EXISTS produtos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255),
            quantidade INT,
            preco DECIMAL(10, 2)
        )");

    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
        exit();
    }

    return $db;
}
?>