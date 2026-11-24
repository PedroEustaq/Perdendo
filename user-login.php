<?php

require_once "includes/banco.php";
require_once "includes/login.php";
require_once "includes/funcoes.php";

$loginErro = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($usuario !== "" && $senha !== "" && autenticar($usuario, $senha)) {
        $_SESSION["flash_message"] = "login_success";

        header("Location: index.php");
        exit;
    }

    $loginErro = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="page.loginTitle">Login | Perdendo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton+SC&family=Inter:opsz@14..32&family=Karla&family=Roboto:ital,wght@0,100..900;1,100..900&family=VT323&display=swap');

        div#corpo {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            width: 250px;
        }

        input {
            margin: 5px;
            padding: 5px;
        }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div id="corpo">
        <?php
        if ($loginErro) {
            echo msg_erro("<span data-i18n='auth.loginError'>Opa... confira seu usuário e senha.</span>");
        }

        require_once "user-login-form.php";
        ?>
    </div>

    <div class="login-aviso">
        🎮 <span data-i18n="auth.demoAccess">Acesso Demo</span><br>
        <strong data-i18n="auth.username">Usuário:</strong> admin<br>
        <strong data-i18n="auth.password">Senha:</strong> admin
    </div>

    <script src="i18n.js" defer></script>
</body>

</html>