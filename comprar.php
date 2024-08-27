<?php
include('header.php');

$error_message = '';
$success_message = '';

if (isset($_POST['comprar'])) {
    $user_id = $_POST['user_id'];
    $total = 0;

    // Iniciar a transação
    $conn->begin_transaction();

    try {
        // Verificar os produtos e calcular o total
        foreach ($_POST['produtos'] as $product_id => $quantidade) {
            $result = $conn->query("SELECT quantidade, preco FROM produtos WHERE product_id=$product_id");
            $produto = $result->fetch_assoc();

            if ($produto['quantidade'] > 0) {
                if ($produto['quantidade'] >= $quantidade) {
                    $preco_total = floatval($produto['preco']) * intval($quantidade);
                    $total += $preco_total;
                    $nova_quantidade = intval($produto['quantidade']) - intval($quantidade);

                    // Atualizar a quantidade dos produtos
                    $conn->query("UPDATE produtos SET quantidade=$nova_quantidade WHERE product_id=$product_id");
                } else {
                    throw new Exception("Quantidade insuficiente para o produto ID: $product_id");
                }
            } else {
                throw new Exception("Produto esgotado!");
            }
        }

        // Verificar o saldo do usuário
        $result = $conn->query("SELECT saldo FROM usuarios WHERE user_id=$user_id");
        $usuario = $result->fetch_assoc();
        if ($usuario['saldo'] >= $total) {
            $novo_saldo = $usuario['saldo'] - $total;
            // Atualizar o saldo do usuário
            $conn->query("UPDATE usuarios SET saldo=$novo_saldo WHERE user_id=$user_id");

            // Confirmar a transação
            $conn->commit();
            $success_message = "Compra realizada com sucesso! Saldo restante: R$ $novo_saldo";
        } else {
            throw new Exception("Saldo insuficiente!");
        }
    } catch (Exception $e) {
        // Reverter as alterações em caso de erro
        $conn->rollback();
        $error_message = $e->getMessage();
    }
}
?>

<div class="container">
    <h2>Comprar Produtos</h2>

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

    <form method="post">
        <label for="user_id">Selecione o Usuário:</label>
        <select name="user_id" required>
            <?php
            $result = $conn->query("SELECT * FROM usuarios");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['user_id']}'>{$row['nome']} (Saldo: R$ {$row['saldo']})</option>";
            }
            ?>
        </select>

        <h3>Selecione os Produtos:</h3>
        <?php
        // Alterar a consulta SQL para filtrar produtos com quantidade maior que zero
        $result = $conn->query("SELECT * FROM produtos WHERE quantidade > 0");
        if ($result->num_rows == 0) {
            echo "<p>Nenhum produto disponível para compra</p>";
        }
        while ($row = $result->fetch_assoc()) {
            echo "<div>
                <label>{$row['nome']} (Disponível: {$row['quantidade']}, Preço: R$ {$row['preco']}): </label>
                <input type='number' name='produtos[{$row['product_id']}]' min='0' max='{$row['quantidade']}' placeholder='Quantidade'>
              </div>";
        }
        ?>
        <button type="submit" name="comprar">Comprar</button>
    </form>
</div>

<?php include('footer.php'); ?>
