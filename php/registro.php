<?php
    session_start();
    include("php/config.php");
    if(isset($_SESSION['valid'])){
        header("Location: homepage.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="registro.php">Criar Conta</a>
            <a href="sobrenos.html">Sobre Nós</a>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="box form-box">

            
    <?php

include("php/config.php");
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    //verificando o email unico

$verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

if(mysqli_num_rows($verify_query) !=0) {
    echo "<div class='message'>
                <p>Este email está a ser usado, Tenta outro por favor</p>
            </div> <br>";
    echo "<a href='javascript:self.history.back()'><button class='btn'>Voltar Atrás</buttom>";

}
else {
    mysqli_query($con, "INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die ("Error Ocurred");
    
    echo "<div class='message'>
                <p>Registro Completo!</p>
            </div> <br>";
    echo "<a href='login.php'><button class='btn'>Logar Agora</buttom>";
}

}else{

?>


                <div class="header">Registro</div>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Nome</label>
                        <input type="text" name="username" id="username" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="age">Idade</label>
                        <input type="number" name="age" id="age" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="password">Palavra-Passe</label>
                        <input type="password" name="password" id="password" autocomplete="off">
                    </div>
                    <div class="field">
                        
                        <input type="submit" class="
                        btn" name="submit" value="Registro">
                    </div>
                </form>
                <div class="links">
                    Já és membro? <a href="login.html">Clica aqui</a>
                </div>
            </div>
        </div>
    </main>

    <?php } ?>

</body>
</html>