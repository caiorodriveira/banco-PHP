<?php 
    define('HOST', 'localhost');
    define('DBNAME', 'db_financias');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", USERNAME, PASSWORD);

    $conn->query("CREATE TABLE IF NOT EXISTS pessoa(
        id_pessoa INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        nome varchar(100) NOT NULL,
        cpf varchar(11) NOT NULL unique,
        email varchar(50) NOT NULL);
        
        create TABLE IF NOT EXISTS conta(
        id_conta INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        numero INT NOT NULL,
        saldo INT,
        id_pessoa INT NOT NULL,
        CONSTRAINT fk_pessoa FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa));
        
        INSERT INTO pessoa VALUES(DEFAULT, 'Caio Rodrigo' , 52377178880, 'caio@gmail.com');
        
        create TABLE IF NOT EXISTS extrato(
        id_extrato INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        tipo_operacao char(1) NOT NULL,
        valor INT NOT NULL);");
?>