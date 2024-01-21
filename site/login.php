<?php
    session_start();
    include("php/config.php");

    // Redirecionar se já estiver logado
    if(isset($_SESSION['valid'])){
        header("Location: homepage.php");
        exit();
    }

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);

        // Use instrução preparada para evitar injeção SQL
        $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE Email=?");
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if($row && password_verify($_POST['password'], $row['Password'])){
            // A senha está correta
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['age'] = $row['Age'];
            $_SESSION['id'] = $row['Id'];
            header("Location: homepage.php");
            exit();
        } else {
            
            $error_message = "Email ou senha incorretos";
        }

        mysqli_stmt_close($stmt);
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
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
        <div class="caixa">
            <div class="box form-box">
                <div class="header">Login</div>
                <?php 
                    
                    if(isset($error_message)){
                        echo "<div class='message'>
                              <p>{$error_message}</p>
                              </div>";
                    }
                ?>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="password">Palavra-Passe</label>
                        <input type="password" name="password" id="password" autocomplete="off">
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </div>
                </form>
                
                <div class="links">
                    Não tens conta? <a href="registro.php">Clica aqui</a>
                </div>
            </div> 
        </div>
    </main>
</body>
</html>
