<?php
include('header.php');

$error_message = '';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $result = $conn->query("SELECT * FROM usuarios WHERE user_id=$user_id");
    $usuario = $result->fetch_assoc();
}

if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $nome = $_POST['nome'];
    $saldo = $_POST['saldo'];
    if (!is_numeric($saldo)) {
        $error_message = "Saldo deve ser um número";
    }
    else {
        $saldoNumero = floatval($saldo);
        $sql = "UPDATE usuarios SET nome='$nome', saldo='$saldoNumero' WHERE user_id=$user_id";
        $conn->query($sql);

        header('Location: usuarios.php');
        exit();
    }
}
?>

<div class="container">
    <h2>Editar Usuário</h2>

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
        <input type="hidden" name="user_id" value="<?php echo $usuario['user_id']; ?>">
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
        <input type="text" name="saldo" value="<?php echo $usuario['saldo']; ?>" required>
        <button type="submit" name="update_user">Salvar Alterações</button>
    </form>
</div>

<?php include('footer.php'); ?>
