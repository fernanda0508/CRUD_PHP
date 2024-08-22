<?php
// Conexão com o banco de dados MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="usuarios.php">Gerenciar Usuários</a></li>
            <li><a href="produtos.php">Gerenciar Produtos</a></li>
            <li><a href="comprar.php">Comprar Produtos</a></li>
        </ul>
    </nav>
</header>
