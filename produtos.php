<?php
include('header.php');

$error_message = '';
$success_message = '';

// Processar exclusão de produto
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM produtos WHERE product_id=$product_id";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Produto excluído com sucesso!";
    } else {
        $error_message = "Erro ao excluir produto: " . $conn->error;
    }
}

// Processar adição de produto
if (isset($_POST['add_product'])) {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $imagem = '';

    if (!is_numeric($preco)) {
        $error_message = "O preço deve ser um número!";
    } else {
        // Processar o upload da imagem
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
            $sql = "INSERT INTO produtos (nome, quantidade, preco, imagem) VALUES ('$nome', '$quantidade', '$precoNumero', '$imagem')";
            if ($conn->query($sql) === TRUE) {
                $success_message = "Produto adicionado com sucesso!";
            } else {
                $error_message = "Erro ao adicionar produto: " . $conn->error;
            }
        }
    }
}
?>

<div class="container">
    <h2>Gerenciar Produtos</h2>

    <!-- Mensagem de sucesso -->
    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <!-- Mensagem de erro -->
    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Adicionar Produto -->
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <input type="number" name="quantidade" placeholder="Quantidade" required>
        <input type="text" name="preco" placeholder="Preço (R$)" required>
        <input type="file" name="imagem">
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
            <th>Imagem</th>
            <th>Ação</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM produtos");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['quantidade']}</td>
                    <td>R$ {$row['preco']}</td>
                    <td><img src='{$row['imagem']}' width='50'></td>
                    <td>
                        <a class='botao' href='editar_produto.php?product_id={$row['product_id']}'>Editar</a>
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='product_id' value='{$row['product_id']}'>
                            <button type='submit' name='delete_product'>Excluir</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>
