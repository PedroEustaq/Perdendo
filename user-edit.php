<?php
require_once "includes/login.php";
require_once "includes/funcoes.php";

// Toda a lógica de sessão e atualização acontece antes de qualquer HTML.
if (!logado()) {
    header("Location: user-login.php");
    exit;
}

$mensagem = "";
$usuarioAtual = (string)$_SESSION["user"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuarioPost = $_POST["usuario"] ?? "";
    $nomePost = $_POST["nome"] ?? "";
    $senha1Post = $_POST["senha1"] ?? "";
    $senha2Post = $_POST["senha2"] ?? "";

    $usuarioNovo = is_string($usuarioPost) ? trim($usuarioPost) : "";
    $nomeNovo = is_string($nomePost) ? trim($nomePost) : "";
    $senha1 = is_string($senha1Post) ? $senha1Post : "";
    $senha2 = is_string($senha2Post) ? $senha2Post : "";

    // Senha vazia ou composta apenas por espaços nunca pode ser salva.
    if ($senha1 === "" || trim($senha1) === "" || $senha2 === "" || trim($senha2) === "") {
        $mensagem = msg_erro("A senha não pode ficar vazia. Informe e confirme uma nova senha.");
    } elseif ($senha1 !== $senha2) {
        $mensagem = msg_erro("<span data-i18n='auth.passwordMismatch'>As senhas não coincidem.</span>");
    } elseif (strlen($senha1) > 72) {
        // PASSWORD_DEFAULT usa bcrypt nesta versão do PHP; ele considera até 72 bytes.
        $mensagem = msg_erro("A senha deve ter no máximo 72 bytes.");
    } elseif ($usuarioNovo === "" || $nomeNovo === "") {
        $mensagem = msg_erro("<span data-i18n='auth.requiredFields'>Usuário e nome são obrigatórios.</span>");
    } elseif (preg_match_all("/./us", $usuarioNovo) > 30) {
        $mensagem = msg_erro("O usuário deve ter no máximo 30 caracteres.");
    } elseif (preg_match_all("/./us", $nomeNovo) > 60) {
        $mensagem = msg_erro("O nome deve ter no máximo 60 caracteres.");
    } else {
        $hashSenha = password_hash($senha1, PASSWORD_DEFAULT);

        if ($hashSenha === false) {
            $mensagem = msg_erro("Não foi possível proteger a nova senha. Tente novamente.");
        } else {
            $sql = "UPDATE usuario
                    SET usuario = $1,
                        nome = $2,
                        senha = $3
                    WHERE usuario = $4";

            $resultado = pg_query_params(
                $conn,
                $sql,
                [$usuarioNovo, $nomeNovo, $hashSenha, $usuarioAtual]
            );

            if ($resultado && pg_affected_rows($resultado) === 1) {
                // Mantém a sessão válida após atualizar os dados da própria conta.
                session_regenerate_id(true);
                $_SESSION["user"] = $usuarioNovo;
                $_SESSION["usuario"] = $usuarioNovo;
                $_SESSION["nome"] = $nomeNovo;
                $usuarioAtual = $usuarioNovo;

                $mensagem = msg_sucesso("Seus dados foram atualizados com sucesso.");
            } else {
                error_log("Falha ao atualizar dados do usuário: " . pg_last_error($conn));
                $mensagem = msg_erro("Não foi possível salvar. Verifique se o nome de usuário já está em uso.");
            }
        }
    }
}

$sqlUsuario = "SELECT usuario, nome, tipo
               FROM usuario
               WHERE usuario = $1
               LIMIT 1";
$resultadoUsuario = pg_query_params($conn, $sqlUsuario, [$usuarioAtual]);
$reg = $resultadoUsuario ? pg_fetch_assoc($resultadoUsuario) : false;

if (!$reg) {
    logout();
    header("Location: user-login.php");
    exit;
}
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
    <main id="corpo">
        <?php
        echo $mensagem;
        require "user-edit-form.php";
        ?>
    </main>
    <script src="i18n.js" defer></script>
</body>
</html>
