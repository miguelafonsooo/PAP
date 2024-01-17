<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.html");
    

    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="sobrenos.html">Sobre Nós</a>
            <a href="php/logout.php">Sair da Conta</a>
        </nav>
    </header>
    <main>
    <?php

        $id = $_SESSION['id'];
        $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id");

        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
            $res_UID = $result['CardUID'];
        }
        
        
    ?>
<div class="homepage">
    
        <h1>Bem Vindo <?php echo $res_Uname?></h1>
        <p>Olá <b><?php echo $res_Uname
        ?></b> tudo bem?</p>
        <p>Tens <b><?php echo $res_Age?></b> anos.</p>
        <p>O teu email é <b><?php echo $res_Email ?></b>.</p>
        <p>O teu ID de cartão é <b><?php echo $res_UID?></b></p>

        <h2>Coloca saldo aqui!</h2>

        <?php echo "<a href='saldo.php'?Id='$res_id' class='links'>Colocar Saldo</a>"; ?>

        <h2>Queres editar o teu perfil? Clica aqui em baixo!</h2>

        <?php echo "<a href='edit.php'?Id='$res_id' class='links'>Editar Perfil</a>"; ?>
        
        <h2>Queres alterar o cartão? Pede ajuda a um administrador e clica aqui!</h2>

        <?php echo"<a href='registrocartao.php'?Id='$res_id' class='links'> Alterar Cartão</a>" ?>
    </main>
</div>
</body>
</html>