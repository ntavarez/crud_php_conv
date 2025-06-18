<?php
include '../config/conexao.php';

$database = new BD();
$db = $database->conexao();
$stmt = $db->query("SELECT per_codigo, per_descricao FROM tab_perfil");

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label, select {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="login"],
        select, option {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4e4caf;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #7572ff;
        }

        .form-footer {
            text-align: center;
            margin-top: 10px;
        }

        .form-footer a {
            color: #2867aa;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form action="login.php" method="POST">
        <h2>Cadastro de Usuário</h2>

        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required placeholder="Nome">

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required placeholder="Senha">

        <label for="login">Login:</label>
        <input type="login" id="login" name="login" required placeholder="Login">

        <label for="profile">Selecione um perfil:</label>
        <select name="profile_id" id="profile">
            <option value="">--Opções--</option>
            <?php foreach ($usuarios as $usuario): ?>
            <option value="<?= $usuario['per_codigo']?>">
                <?= htmlspecialchars( $usuario['per_descricao'])?>
            </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Cadastrar">

        <div class="form-footer">
            <p>Já possui uma conta? <a href="login.html">Entrar</a></p>
        </div>
    </form>
</body>

</html>