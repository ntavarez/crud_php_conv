<?php
require_once '../config/conexao.php';
require_once '../models/usuario.php';

$database = new BD();
$db = $database->conexao();
$user = new Usuario($db);
//$user->name = $_POST["name"];
$usuarios = [];

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $user->password = $_POST["password"];
    $user->login = $_POST["login"];

    $id = $user->buscarUsuario($user->login);
    $name = $user->validarNomePorId($id);
    $user->name = $name;

    if ($id == null || $id == "") {
        echo "<script>alert('Usuário não encontrado, favor realizar o cadastro!');</script>";
        header('Location: cadastro.php');

        //$user->criarUsuario();
    } else {
        $stmt = $db->prepare("SELECT * FROM tab_usuario WHERE usu_login_acesso = :login AND usu_senha = :password");
        $stmt->bindParam(':login', $user->login);
        $stmt->bindParam(':password', $user->password);
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$usuarios) {
            header('Location: login.php');
            echo "<script>alert('Usuário ou senha incorretos, favor tentar novamente!');</script>";
        }
    }
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
    <h2>Bem-vindo, <?= $user->name?>!</h2>
    <h3>Pesquise um usuário e selecione qual operação deseja realizar.</h3>
    <!--
    <a href="editar.php?id=<?= $usuario['id'] ?>">Alterar um usuário</a>
    <a href="deletar.php?id=<?= $usuario['id'] ?>">Deletar um usuário</a>-->

    <!--<table border="1">
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
                    <td><?= htmlspecialchars($usuario['usu_codigo']) ?></td>
                    <td><?= htmlspecialchars($usuario['usu_nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['usu_login_acesso']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id'] ?>">Alterar</a> |
                        <a href="deletar.php?id=<?= $usuario['id'] ?>">Deletar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="cadastro.html">Cadastrar Novo Usuário</a>-->
</body>

</html>