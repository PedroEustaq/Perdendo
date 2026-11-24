<?php
require_once "includes/banco.php";
require_once "includes/login.php";
require_once "includes/funcoes.php";

// A sessão e a autorização precisam ser verificadas antes de qualquer HTML.
if (!admin()) {
    header("Location: index.php");
    exit();
}

$mensagem = "";
$cadastroConcluido = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $nome = trim($_POST["nome"] ?? "");
    $senha1 = $_POST["senha1"] ?? "";
    $senha2 = $_POST["senha2"] ?? "";
    $tipo = $_POST["tipo"] ?? "";

    if ($usuario === "" || $nome === "" || $senha1 === "" || $senha2 === "") {
        $mensagem = msg_erro("<span data-i18n='auth.requiredFields'>Todos os dados são obrigatórios.</span>");
    } elseif ($senha1 !== $senha2) {
        $mensagem = msg_erro("<span data-i18n='auth.passwordsWrong'>As senhas não coincidem.</span>");
    } elseif (!in_array($tipo, ["admin", "editor"], true)) {
        $mensagem = msg_erro("Tipo de usuário inválido.");
    } else {
        $senhaHash = gerarHash($senha1);

        // Parâmetros evitam que os valores do formulário sejam interpretados como SQL.
        $sql = "INSERT INTO usuario (usuario, nome, senha, tipo)
                VALUES ($1, $2, $3, $4)";

        $resultado = pg_query_params(
            $conn,
            $sql,
            [$usuario, $nome, $senhaHash, $tipo]
        );

        if ($resultado) {
            $nomeSeguro = htmlspecialchars($nome, ENT_QUOTES, "UTF-8");
            $mensagem = msg_sucesso("Usuário {$nomeSeguro} cadastrado com sucesso.");
            $cadastroConcluido = true;
        } else {
            error_log("Falha ao cadastrar usuário: " . pg_last_error($conn));
            $mensagem = msg_erro("Não foi possível cadastrar o usuário. Verifique se esse nome de usuário já existe.");
        }
    }
}
?>
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
    <div id="corpo">
        <?php
        echo $mensagem;

        if (!$cadastroConcluido) {
            require "user-new-form.php";
        }
        ?>
    </div>

    <script src="i18n.js" defer></script>
</body>
</html>
