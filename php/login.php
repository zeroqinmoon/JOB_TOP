<?php

// Função para abrir conexão com o banco de dados
function abrirBanco()
{
    $conexao = new mysqli("localhost", "root", "", "agenda");
    if ($conexao->connect_error) {
        die("Connection failed: " . $conexao->connect_error);
    }
    return $conexao;
}

// Função para autenticar o usuário
function autenticarUsuario()
{
    $banco = abrirBanco();

    // Proteção contra SQL Injection
    $email = $banco->real_escape_string($_GET["email"]); // Utilizamos GET para obter o email
    $senha = $_GET["senha"]; // Utilizamos GET para obter a senha

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $resultado = $banco->query($sql);

    if ($resultado->num_rows > 0) {
        // Login bem-sucedido
        session_start(); // Inicia a sessão
        $_SESSION['usuario'] = $email; // Salva o email do usuário na sessão

        // Redireciona para index.html
        header("Location: ../user/index.html");
        exit(); // Garante que o script não continue após o redirecionamento
    } else {
        echo '<div class="alert alert-danger" role="alert">Email ou senha incorretos!</div>';
    }

    $banco->close();
}

// Verifica se o GET existe antes de autenticar o usuário
if (isset($_GET["acao"]) && $_GET["acao"] == "login") {
    autenticarUsuario();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="../css/login_config.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
        <h2>Login de Usuário</h2>
        <form class="login-form" id="loginForm" action="login.php" method="get">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <a href="../lost_password.html" id="forgotPassword">Esqueça sua senha?</a>
            <a href="cadastro.php" id="forgotPassword">NÃO tem CADASTRO?</a>
            <a href="login_painel.php" id="forgotPassword">Acesso ao Painel</a>
            <button type="submit" name="acao" value="login">LOGIN</button>
        </form>
    </div>
</body>

</html>