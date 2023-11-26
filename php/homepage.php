<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");


    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="login.html">Login</a>
            <a href="#">Criar Conta</a>
            <a href="sobrenos.html">Sobre Nós</a>
        </nav>
    </header>
    <main>
        <h1>bem Vindo</h1>

        <?php

        id = $_SESSION['valid'];
        $query = mysqli_query($con,"SELECT*FROM useres WHERE Id=$id");

        while($result = mysqli_fetch_assoc(query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Uname = $result['Age'];
            $res_Uname = $result['Id'];
        }

        echo "<a href=edit.php?Id=$res_id'>Change Profile</a>";
        ?>

        <a href="logout.php"> <buttom class="btn">Sair<button> </a>
    </main>
</body>
</html>