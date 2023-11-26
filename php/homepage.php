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
            <a href="sobrenos.html">Sobre Nós</a>
        </nav>
    </header>
    <main>
        <h1>bem Vindo</h1>

        <?php

        $id = $_SESSION['id'];
        $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id");

        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
        }

        echo "<a href=edit.php?Id=$res_id'>Mudar Perfil</a>";
        ?>

        <p>Olá <b><?php echo $res_Uname
        ?></b> tudo bem?</p>
        <p>Tens <b><?php echo $res_Age?></b> anos.</p>
        <p>O teu email é <b><?php echo $res_Email ?></b>.</p>
        

        <a href="php/logout.php"> <buttom class="btn">Sair<button> </a>
    </main>
</body>
</html>