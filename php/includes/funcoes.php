<?php

function msg_aviso($m)
{
    $resp = "<div class='aviso'><i class='material-icons'>info</i>$m</div>";
    return $resp;
}

function msg_sucesso($m)
{
    $resp = "<div class='sucesso'><i class='material-icons'>check_circle</i>$m</div>";
    return $resp;
}

function msg_erro($m)
{
    $resp = "<div class='erro'><i class='material-icons'>error</i>$m</div>";
    return $resp;
}

function testarHash($senha, $hash)
{
    return password_verify($senha, $hash);
}

function gerarHash($senha)
{
    return password_hash($senha, PASSWORD_DEFAULT);
}

/**
 * Resolve image files from the project root and returns a public site URL.
 */
function localizarImagem($pasta, $nomeArquivo)
{
    $extensoes = ["png", "jpg", "jpeg", "webp", "avif", "gif"];

    $pastaRelativa = trim(str_replace("\\", "/", $pasta), "/");

    if ($pastaRelativa === "" || strpos($pastaRelativa, "..") !== false) {
        return null;
    }

    // funcoes.php is in php/includes/, so go up two levels to the project root.
    $raizProjeto = dirname(__DIR__, 2);
    $pastaFisica = $raizProjeto
        . DIRECTORY_SEPARATOR
        . str_replace("/", DIRECTORY_SEPARATOR, $pastaRelativa);

    foreach ($extensoes as $ext) {
        $nomeCompleto = $nomeArquivo . "." . $ext;
        $arquivoFisico = $pastaFisica . DIRECTORY_SEPARATOR . $nomeCompleto;

        if (is_file($arquivoFisico)) {
            $caminhoUrl = $pastaRelativa . "/" . $nomeCompleto;
            $segmentosUrl = array_map("rawurlencode", explode("/", $caminhoUrl));

            return "/" . implode("/", $segmentosUrl);
        }
    }

    return null;
}