<?php
require_once '../config/conexao.php';
require_once '../models/usuario.php';

$database = new BD();
$db = $database->conexao();
$usuarios = [];


$user = new Usuario(db: $db);

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $user->password = $_POST["password"];
    $user->login = $_POST["login"];
    $id = $user->buscarUsuario();
}

$stmt = $db->prepare("SELECT COUNT(*) FROM tab_usuario WHERE usu_login_acesso = :login");
$stmt->bindParam(':login', $user->login);
$stmt->execute();

$count = $stmt->fetchColumn();

if ($count < 0) {
    echo 'Usuário não existe! Favor realizar o cadastro.';
    header('app.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        button {
            background-color: #4e4caf;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #7572ff;
        }
    </style>
</head>

<body>
    <h2>Bem-vindo!</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id'] ?>">Alterar</a> |
                        <a href="deletar.php?id=<?= $usuario['id'] ?>">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="cadastro.html">Cadastrar Novo Usuário</a>
</body>

</html>