<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar aqui</title>
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
                </div> <br>;
        echo <a href='javascript:self.history.back()'><button class='btn'>Go Back</buttom>";

    }
    else {

        mysqli_query($con, "INSERT INTO users(Uername,Email,Age,Password) VALUES('$username''$email''$age''$password',)") or die ("Erro");
        
        echo "<div class='message'>
                    <p>registro Completo!</p>
                </div> <br>;
        echo <a href='index.php'><button class='btn'>Login Now</buttom>";
    }

    }else{

    ?>

    <main>
        <div class="container" class="form-container">
            <h2>Registro</h2>
            <form action="#">
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="age" required>
                    <label>Age</label>
                </div>
                <div class="input-box">
                    <span class="icon"></span>
                    <input type="password" required>
                    <label>Password</label>
                </div>
                <input type="submit" value="Register">
            </form>
        </div>
    </main>
    <?php } ?>
</body>
</html>