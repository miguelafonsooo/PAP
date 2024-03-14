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
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
<?php

$id = $_SESSION['id'];
$query = mysqli_query($con,"SELECT*FROM users WHERE id=$id");

while($result = mysqli_fetch_assoc($query)){
    $res_Uname = explode(' ', $result['Username'])[0];
    $res_Email = $result['Email'];
    $res_Age = $result['Age'];
    $res_id = $result['Id'];
    $res_UID = $result['CardUID'];
    $res_Saldo = $result['Saldo'];
}


?>
    <header>
        <h1><a href="index.php">Máquina de Vendas</a></h1>
        <nav>
            <?php echo "<a href='edit.php'?Id='$res_id' class='links'>Editar Perfil</a>"; ?>
            <a href="php/logout.php">Sair da Conta</a>
        </nav>
    </header>
    <main>

<div class="homepage">
    
        <h1>Bem Vindo <?php echo $res_Uname?></h1>
        <p>Olá <b><?php echo $res_Uname
        ?></b> tudo bem?</p>
        <p>Tens <b><?php echo $res_Age?></b> anos.</p>
        <p>O teu email é <b><?php echo $res_Email ?></b>.</p>
        <p>O teu ID de cartão é <b><?php echo $res_UID?></b></p>
        <p>Tens <b><?php echo $res_Saldo ?></b>$ de saldo.</p>

        <h2>Coloca saldo aqui!</h2>

        <?php echo "<a href='saldo.php'?Id='$res_id' class='links'>Colocar Saldo</a>"; ?>
        
        <h2>Queres alterar o cartão? Passa o cartão na máquina de vendas e copia o código de 8 letras exibido no LCD</h2>

        <?php echo"<a href='registrocartao.php'?Id='$res_id' class='links'> Alterar Cartão</a>" ?>
    </main>
</div>
</body>
</html>