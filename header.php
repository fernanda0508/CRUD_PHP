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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>

<header>
    
    <nav>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Início</a></li>
            <li><a href="usuarios.php"><i class="fas fa-users"></i> Gerenciar Usuários</a></li>
            <li><a href="produtos.php"><i class="fas fa-box"></i> Gerenciar Produtos</a></li>
            <li><a href="comprar.php"><i class="fas fa-shopping-cart"></i> Comprar Produtos</a></li>
        </ul>
    </nav>
</header>

