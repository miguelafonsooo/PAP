<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Cartão</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
<header>
        <h1>
            <a href="index.html">Máquina de Vendas</a>
        </h1>
        <nav>
            <a href="sobrenos.html">Sobre Nós</a>
            <a href="homepage.php">Voltar Atrás</a>
        </nav>
</header>
<main>
    <h1>Registrar</h1>
    
</main>
</body>
</html>