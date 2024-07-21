<?php
session_start(); // Sempre inicie a sessão no início do script

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
    $email = $banco->real_escape_string($_POST["email"]); // Utilizamos POST para obter o email
    $senha = $_POST["senha"]; // Utilizamos POST para obter a senha

    // Aqui seria ideal utilizar hashing para a senha no banco de dados, mas por simplicidade vamos manter como está
    $sql = "SELECT * FROM admins WHERE email='$email' AND senha='$senha'";
    $resultado = $banco->query($sql);

    if ($resultado->num_rows > 0) {
        // Login bem-sucedido
        $_SESSION['usuario'] = $email; // Salva o email do usuário na sessão

        // Redireciona para a página desejada após login
        header("Location: ../crud/index.php");
        // Garante que o script não continue após o redirecionamento
        exit();
    } else {
        // Login falhou
        echo '<div class="alert alert-danger" role="alert">Email ou senha incorretos!</div>';
    }

    $banco->close();
}

// Verifica se o POST existe antes de autenticar o usuário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && $_POST["acao"] == "login") {
    autenticarUsuario();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOB-TOP Painel</title>
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
        <h2>Acesso ao Painel</h2>
        <form class="login-form" id="loginForm" action="login_painel.php" method="post">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <input type="hidden" name="acao" value="login"> <!-- Campo oculto para identificar ação de login -->
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>

</html>