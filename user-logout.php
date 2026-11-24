<?php
require_once "includes/banco.php";
require_once "includes/login.php";
require_once "includes/funcoes.php";

// Encerra a sessão antes de qualquer conteúdo HTML ser enviado.
logout();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="user.logout">Sair</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="corpo">
        <?php
        echo msg_sucesso("<span data-i18n='auth.logoutSuccess'>Logout bem sucedido</span>");
        ?>
    </div>

    <script src="i18n.js" defer></script>
</body>
</html>
