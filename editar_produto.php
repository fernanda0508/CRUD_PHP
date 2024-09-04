<?php
include('header.php');

$error_message = '';

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
    $imagem = $produto['imagem'];

    if (!is_numeric($quantidade) || !is_numeric($preco)) {
        $error_message = "Quantidade e preço devem ser números";
    } else {
        // Processar o upload da nova imagem (se houver)
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        if (!empty($_FILES['imagem']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['imagem']['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowed_types = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $allowed_types)) {
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file)) {
                    $imagem = $target_file;
                } else {
                    $error_message = "Erro ao fazer upload da imagem.";
                }
            } else {
                $error_message = "Apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
            }
        }

        if (empty($error_message)) {
            $precoNumero = floatval($preco);
            $sql = "UPDATE produtos SET nome='$nome', quantidade='$quantidade', preco='$precoNumero', imagem='$imagem' WHERE product_id=$product_id";
            $conn->query($sql);

            header('Location: produtos.php');
            exit();
        }
    }
}
?>

<div class="container">
    <h2>Editar Produto</h2>

    <!-- Mensagem de erro -->
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $produto['product_id']; ?>">
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>
        <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required>
        <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required>
        <img src="<?php echo $produto['imagem']; ?>" width="100">
        <input type="file" name="imagem">
        <button type="submit" name="update_product">Salvar Alterações</button>
        <a href="produtos.php" id="cancel">Cancelar Alterações</a>
    </form>
</div>

<?php include('footer.php'); ?>
