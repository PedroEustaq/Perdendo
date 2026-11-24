<?php 


$host = "aws-0-sa-east-1.pooler.supabase.com";
$port = "5432";
$dbname = "postgres";
$user = "postgres.jbyaibzsiccvlwlpdtsa";
$password = "8Ozg1O05KHrnht92";

$conn = pg_connect("
    host=$host
    port=$port
    dbname=$dbname
    user=$user
    password=$password
    connect_timeout=10
");

if (!$conn) {
    if (PHP_SAPI === "cli") {
        fwrite(STDERR, "Falha ao conectar ao banco de dados.\n");
        exit(1);
    }

    http_response_code(500);
    die("Erro na conexão.");
}



function thumb($arq)
{
    $caminho = "fotos/$arq";

    if (is_null($arq) || !file_exists($caminho)) {
        return "fotos/indisponivel.png";
    }

    return $caminho;
}
