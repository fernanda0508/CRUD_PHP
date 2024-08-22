<?php
include('header.php');

if (isset($_POST['add_product'])) {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $sql = "INSERT INTO produtos (nome, quantidade, preco) VALUES ('$nome', '$quantidade', '$preco')";
    $conn->query($sql);
} elseif (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM produtos WHERE id=$product_id";
    $conn->query($sql);
}
?>

<div class="container">
    <h2>Gerenciar Produtos</h2>

    <!-- Adicionar Produto -->
    <form method="post">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <input type="number" name="quantidade" placeholder="Quantidade" required>
        <input type="number" name="preco" placeholder="Preço (R$)" required>
        <button type="submit" name="add_product">Adicionar Produto</button>
    </form>

    <!-- Listagem de Produtos -->
    <h3>Produtos</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço (R$)</th>
            <th>Ação</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM produtos");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['quantidade']}</td>
                    <td>R$ {$row['preco']}</td>
                    <td>
                        <a href='editar_produto.php?id={$row['id']}'>Editar</a>
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='product_id' value='{$row['id']}'>
                            <button type='submit' name='delete_product'>Excluir</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>
