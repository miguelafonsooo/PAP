<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="#">Login</a>
            <a href="#">Criar Conta</a>
            <a href="sobrenos.html">Sobre Nós</a>
            <a href="#"></a>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="box form-box">
                <?php
                
                include("php/config.php");
                if(isset($_POST['submit'])){
                    $email = mysqli_real_escape_string($con,$_POST['email']);
                    $password = mysqli_real_escape_string($con,$_POST['password']);

                    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Select Error");
                    $row = mysqli_fetch_assoc($result);

                    if(is_array($row) && !empty($row)){
                        $_SESSION['valid'] = $row['Email'];
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['age'] = $row['Age'];
                        $_SESSION['id'] = $row['Id'];

                    }else{
                        echo "<div class='message'>
                        <p>Password ou Email errado</p>
                    </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Voltar Atrás</buttom>";
                    }
                    if(isset($_SESSION['valid'])){
                        header("Location: homepage.php");
                    }
                }else{

                ?>
                <div class="header">Login</div>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off">
                    </div>
                    <div class="field">
                        
                        <input type="submit" class="
                        btn" name="submit" value="Login">
                    </div>
                </form>
                <div class="links">
                    Não tens conta? <a href="registro.php">Clica aqui</a>
                </div>
            </div> 
        </div>
        <?php } ?>
    </main>
</body>
</html>