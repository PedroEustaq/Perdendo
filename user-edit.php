<?php
require_once "includes/banco.php";
require_once "includes/login.php";
require_once "includes/funcoes.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="page.editUserTitle">Meus dados | Perdendo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user-edit.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton+SC&family=Inter:opsz@14..32&family=Karla&family=Roboto:ital,wght@0,100..900;1,100..900&family=VT323&display=swap');
    </style>
</head>
<body>
<div id="corpo">
        <?php 
        
        $u = $_POST['usuario'] ?? null;
        $n = $_POST['nome'] ?? null;
        $t = $_POST['tipo'] ?? null;
        $s1 = $_POST['senha1'] ?? null;
        $s2 = $_POST['senha2'] ?? null;

      if (!logado()) {
            echo msg_erro("<span data-i18n='auth.restricted'>Eita! essa area é restrita</span>");
        } else {
            if (!isset($_POST['usuario'])) {
                include 'user-edit-form.php';
            } else {
                if ($_POST['senha1'] == $_POST['senha2']) {
                    echo msg_aviso("Usuario $n cadastrado com sucesso! Por segurança efetue o login novamente");
                    $GH = gerarHash($s1);
                   $q = "UPDATE usuario SET 
    usuario = $1,
    nome = $2,
    senha = $3
    WHERE usuario = $4";

$busca = pg_query_params(
    $conn,
    $q,
    [
        $u,
        $n,
        $GH,
        $_SESSION["user"]
    ]
);
               
                    $_SESSION["user"] = $u;
                    logout();
                } else {
                    echo msg_erro("<span data-i18n='auth.passwordMismatch'>As senhas não coincidem</span>");
                }
        }
    }
        
        ?>    


</div>
<script src="i18n.js" defer></script>
</body>
</html>