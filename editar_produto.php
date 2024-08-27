<?php
include('header.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $result = $conn->query("SELECT * FROM produtos WHERE product_id=$product_id");
    $produto = $result->fetch_assoc();
}

if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $sql = "UPDATE produtos SET nome='$nome', quantidade='$quantidade', preco='$preco' WHERE product_id=$product_id";
    $conn->query($sql);

    header('Location: produtos.php');
    exit();
}
?>

<div class="container">
    <h2>Editar Produto</h2>
    <form method="post">
        <input type="hidden" name="product_id" value="<?php echo $produto['product_id']; ?>">
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>
        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required>
        <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required>
        <button type="submit" name="update_product">Salvar Alterações</button>
    </form>
</div>

<?php include('footer.php'); ?>
