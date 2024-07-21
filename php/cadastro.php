<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/login_config.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>Cadastro de Usuário</h2>
        <h3>Digite suas credenciais</h3>

        <form class="login-form" id="loginForm" method="GET" action="cadastro.php">
            <input type="text" id="nome" name="nome" placeholder="Nome" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <a href="login.php" id="forgotPassword">Já é usuário? Faça seu login aqui.</a>
            <button type="submit" name="acao" value="cadastrar">CADASTRAR</button>
        </form>
    </div>

</body>

</html>
<?php

// Verifica se o GET existe antes de inserir um novo usuário
if (isset($_GET["acao"]) && $_GET["acao"] == "cadastrar") {
    cadastrarUsuario();
}

function abrirBanco()
{
    $conexao = new mysqli("localhost", "root", "", "agenda");
    if ($conexao->connect_error) {
        die("Connection failed: " . $conexao->connect_error);
    }
    return $conexao;
}

function cadastrarUsuario()
{
    $banco = abrirBanco();

    // Proteção contra SQL Injection
    $nome = $banco->real_escape_string($_GET["nome"]);
    $email = $banco->real_escape_string($_GET["email"]);
    $senha = $_GET["senha"]; // Não criptografamos a senha

    // Insere o usuário no banco de dados
    $sql = "INSERT INTO usuarios(nome, email, senha)
            VALUES ('$nome', '$email', '$senha')";

    if ($banco->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erro ao cadastrar usuário: ' . $banco->error . '</div>';
    }

    $banco->close();
}
?>