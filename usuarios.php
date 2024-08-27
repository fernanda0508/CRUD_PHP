<?php
include('header.php');

$error_message = '';
$success_message = '';

if (isset($_POST['add_user'])) {
    $nome = $_POST['nome'];
    $saldo = $_POST['saldo'];
    if (!is_numeric($saldo)) {
        $error_message = "O saldo deve ser um número!";
    } else {
        $saldoNumero = floatval($saldo);
        $sql = "INSERT INTO usuarios (nome, saldo) VALUES ('$nome', '$saldoNumero')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Usuário adicionado com sucesso!";
        } else {
            $error_message = "Erro ao adicionar usuário: " . $conn->error;
        }
    }
}

if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM usuarios WHERE user_id=$user_id";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Usuário excluído com sucesso!";
    } else {
        $error_message = "Erro ao excluir usuário: " . $conn->error;
    }
}
?>

<div class="container">
    <h2>Gerenciar Usuários</h2>

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

    <!-- Adicionar Usuário -->
    <form method="post">
        <input type="text" name="nome" placeholder="Nome do Usuário" required>
        <input type="text" name="saldo" placeholder="Saldo Inicial" required>
        <button type="submit" name="add_user">Adicionar Usuário</button>
    </form>

    <!-- Listagem de Usuários -->
    <h3>Usuários</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Saldo</th>
            <th>Ação</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM usuarios");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['nome']}</td>
                    <td>R$ {$row['saldo']}</td>
                    <td>
                        <a href='editar_usuario.php?user_id={$row['user_id']}'>Editar</a>
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='user_id' value='{$row['user_id']}'>
                            <button type='submit' name='delete_user'>Excluir</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>
