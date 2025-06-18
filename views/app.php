<?php
require_once '../config/conexao.php';
require_once '../models/Usuario.php';

$database = new BD();
$db = $database->conexao();
$id = 0;

$user = new Usuario(db: $db);
if (isset($_POST["login"]) && isset($_POST["password"])) {
    $user->name = $_POST["name"];
    $user->password = $_POST["password"];
    $user->login = $_POST["login"];
    $id = $user->buscarUsuario();

    if ($id == null || $id == "") {
        $user->criarUsuario($db);
    } else {
        header('Location: index.html');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #000;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #000;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4e4caf;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 13px;
            cursor: pointer;
        }

        button:hover {
            background-color: #7572ff;
        }

        p {
            margin-top: 10px;
            font-size: 14px;
        }

        a {
            color: #2867aa;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" placeholder="Digite seu usuário" required>
            </div>
            <div class="input-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Entrar</button>
            <p><a href="cadastro.html">Não possui login? Faça aqui sua conta.</a></p>
        </form>
    </div>
</body>

</html>