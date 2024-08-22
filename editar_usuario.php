<?php
include('header.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $result = $conn->query("SELECT * FROM usuarios WHERE id=$user_id");
    $usuario = $result->fetch_assoc();
}

if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $nome = $_POST['nome'];
    $saldo = $_POST['saldo'];

    $sql = "UPDATE usuarios SET nome='$nome', saldo='$saldo' WHERE id=$user_id";
    $conn->query($sql);

    header('Location: usuarios.php');
    exit();
}
?>

<div class="container">
    <h2>Editar Usuário</h2>
    <form method="post">
        <input type="hidden" name="user_id" value="<?php echo $usuario['id']; ?>">
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
        <input type="number" name="saldo" value="<?php echo $usuario['saldo']; ?>" required>
        <button type="submit" name="update_user">Salvar Alterações</button>
    </form>
</div>

<?php include('footer.php'); ?>
