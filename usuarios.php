<?php
include('header.php');

if (isset($_POST['add_user'])) {
    $nome = $_POST['nome'];
    $saldo = $_POST['saldo'];

    $sql = "INSERT INTO usuarios (nome, saldo) VALUES ('$nome', '$saldo')";
    $conn->query($sql);
} elseif (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM usuarios WHERE id=$user_id";
    $conn->query($sql);
}
?>

<div class="container">
    <h2>Gerenciar Usuários</h2>

    <!-- Adicionar Usuário -->
    <form method="post">
        <input type="text" name="nome" placeholder="Nome do Usuário" required>
        <input type="number" name="saldo" placeholder="Saldo Inicial" required>
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
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>R$ {$row['saldo']}</td>
                    <td>
                        <a href='editar_usuario.php?id={$row['id']}'>Editar</a>
                        <form method='post' style='display:inline;'>
                            <input type='hidden' name='user_id' value='{$row['id']}'>
                            <button type='submit' name='delete_user'>Excluir</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

<?php include('footer.php'); ?>
