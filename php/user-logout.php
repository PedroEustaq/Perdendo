<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>???</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<?php 
    require_once __DIR__ . "/includes/banco.php";
    require_once __DIR__ . "/includes/login.php";
    require_once __DIR__ . "/includes/funcoes.php";
    ?>
    <div id="corpo">
        <?php 
        
        
        logout();
        echo msg_sucesso("Logout bem sucedido");
        ?>
</body>
</html>