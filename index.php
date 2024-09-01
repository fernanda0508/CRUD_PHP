<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminUP - Página Inicial</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('header.php'); ?>
<div class="container">
    <div class="carousel">

    <div class="carousel-item active">
            <div class="icon-container">
                <i class="fas fa-handshake"></i>
            </div>
            <h1>Bem-vindos ao AdminUP</h1>
            <h4>Sistema de gerenciamento de produtos e usuários em PHP</h4>
            <p>O sistema AdminUP é uma solução desenvolvida em PHP para facilitar o gerenciamento de produtos e usuários dentro de uma plataforma integrada e eficiente. Com um foco especial em usabilidade e flexibilidade, o AdminUP oferece três funcionalidades principais:</p>
        </div>
        <div class="carousel-item">
            <div class="icon-container">
                <i class="fas fa-user-cog"></i>
            </div>
            <h3>Gerenciamento de Usuários</h3>
            <p>Esta funcionalidade permite que você administre de forma abrangente os usuários do sistema. Com ela, é possível adicionar novos usuários, atualizar informações detalhadas, e até remover contas, garantindo que apenas as pessoas autorizadas tenham acesso. O gerenciamento eficaz de usuários é essencial para manter a segurança e a organização do sistema.</p>
        </div>
        <div class="carousel-item">
            <div class="icon-container">
                <i class="fas fa-cubes"></i>
            </div>
            <h3>Gerenciamento de Produtos</h3>
            <p>O sistema oferece um controle completo sobre o catálogo de produtos, permitindo que você adicione novos itens, edite suas descrições, preços, e outras informações relevantes. Além disso, o gerenciamento de inventário é simplificado, permitindo que você acompanhe e organize os produtos de forma eficiente, mantendo tudo sempre atualizado e pronto para uso.</p>
        </div>
        <div class="carousel-item">
            <div class="icon-container">
                <i class="fas fa-credit-card"></i>
            </div>
            <h3>Realização de Compras</h3>
            <p>Com esta funcionalidade, o sistema facilita todo o processo de compra, desde a seleção de produtos até a conclusão do pedido. Seja para compras reais ou simulações, essa função garante uma experiência de usuário intuitiva e segura, permitindo também a gestão de pedidos de forma eficaz, com total controle sobre as transações realizadas.</p>
        </div>
    </div>

    <div class="carousel-controls">
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>
</div>

<?php?>

<script src="carousel.js"></script>
