<?php
include('header.php');

if (isset($_POST['comprar'])) {
    $user_id = $_POST['user_id'];
    $total = 0;
    foreach ($_POST['produtos'] as $product_id => $quantidade) {
        $result = $conn->query("SELECT quantidade, preco FROM produtos WHERE id=$product_id");
        $produto = $result->fetch_assoc();

        if ($produto['quantidade'] >= $quantidade) {
            $preco_total = floatval($produto['preco']) * intval($quantidade);
            $total += $preco_total;
            $nova_quantidade = intval($produto['quantidade']) - intval($quantidade);
        
            $conn->query("UPDATE produtos SET quantidade=$nova_quantidade WHERE id=$product_id");
        } else {
            echo "Quantidade insuficiente para o produto ID: $product_id";
        }
    }

    $result = $conn->query("SELECT saldo FROM usuarios WHERE id=$user_id");
    $usuario = $result->fetch_assoc();
    if ($usuario['saldo'] >= $total) {
        $novo_saldo = $usuario['saldo'] - $total;
        $conn->query("UPDATE usuarios SET saldo=$novo_saldo WHERE id=$user_id");
        echo "Compra realizada com sucesso! Saldo restante: R$ $novo_saldo";
    } else {
        echo "Saldo insuficiente!";
    }
}
?>

<div class="container">
    <h2>Comprar Produtos</h2>

    <form method="post">
        <label for="user_id">Selecione o Usuário:</label>
        <select name="user_id" required>
            <?php
            $result = $conn->query("SELECT * FROM usuarios");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nome']} (Saldo: R$ {$row['saldo']})</option>";
            }
            ?>
        </select>

        <h3>Selecione os Produtos:</h3>
        <?php
        $result = $conn->query("SELECT * FROM produtos");
        while ($row = $result->fetch_assoc()) {
            echo "<div>
                    <label>{$row['nome']} (Disponível: {$row['quantidade']}, Preço: R$ {$row['preco']}): </label>
                    <input type='number' name='produtos[{$row['id']}]' min='0' max='{$row['quantidade']}' placeholder='Quantidade'>
                  </div>";
        }
        ?>
        <button type="submit" name="comprar">Comprar</button>
    </form>
</div>

<?php include('footer.php'); ?>
