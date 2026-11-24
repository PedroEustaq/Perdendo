<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="page.newUserTitle">Novo usuário | Perdendo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user-new.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton+SC&family=Inter:opsz@14..32&family=Karla&family=Roboto:ital,wght@0,100..900;1,100..900&family=VT323&display=swap');
    </style>
</head>

<body>
    <?php

    require_once "includes/banco.php";
    require_once "includes/login.php";
    require_once "includes/funcoes.php";


    if (!admin()) {

    header("Location: index.php");

    exit();

}
?>
    <div id="corpo">
        <?php
        if (!admin()) {
            echo msg_erro("<span data-i18n='auth.adminOnly'>Você nao é ADM!</span>");
        } else {
            if (!isset($_POST['usuario'])) {
                require "user-new-form.php";
            } else {
                $usuario = $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $tipo = $_POST['tipo'] ?? null;

                if ($senha1 === $senha2) {
                    if (empty($usuario) || empty($nome) || empty($senha1) || empty($senha2)) {
                        echo "<span data-i18n='auth.requiredFields'>todos os dados sao obrigatorios</span>";
                    } else {

                        echo msg_sucesso("<span data-i18n='auth.readyToSave'>tudo certo para gravar</span>");
                        $senhaH = gerarHash($senha1);
                        $q = "INSERT INTO usuario (usuario,nome,senha,tipo) VALUES ('$usuario','$nome','$senhaH','$tipo')";
                        if (pg_query($conn, $q)) {
                            echo msg_sucesso("Usuario $nome cadastrado com sucesso");
                        } else {
                            echo msg_erro("Não foi possível criar o usuario $nome");
                        }
                    }
                } else {
                    echo msg_erro("<span data-i18n='auth.passwordsWrong'>senhas estão erradas!</span>");
                }
            }
        }


        ?>
    </div>
<script src="i18n.js" defer></script>
</body>

</html>