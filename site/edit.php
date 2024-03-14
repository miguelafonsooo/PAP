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
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="homeadmin.php">Voltar Atrás</a>
        </nav>
    </header>
    <main>
        <div class="caixa">
            <div class="box form-box">
                <?php
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $age = $_POST['age'];

                    
                    if (!empty($_POST['password'])) {
                        $password = $_POST['password'];
                        $password_cripto = password_hash($password, PASSWORD_DEFAULT);
                        $password_update = ", Password='$password_cripto'";
                    } else {
                        $password_update = ""; 
                    }

                    $id = $_SESSION['id'];

                    $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age'".$password_update." WHERE Id=$id") or die("Error Ocurred");

                    if($edit_query){
                        echo "<div class='message'>
                        <p>Perfil Atualizado!</p>
                    </div> <br>";
                    echo "<a href='homeadmin.php' class='btn'>Voltar Atrás</a>";
                    }
                }else{

                    $id = $_SESSION['id'];
                    $query = mysqli_query($con,"SELECT * FROM users WHERE ID=$id");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_Uname = $result['Username'];
                        $res_Email = $result['Email'];
                        $res_Age = $result['Age'];
                        
                    }
                ?>

                <div class="header">Editar Perfil</div>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Nome (máximo 10 caracteres)</label>
                        <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" maxlength="10">
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="age">Idade</label>
                        <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off">
                    </div>
                    <div class="field input">
                        <label for="age">Nova Palavra-Passe</label>
                        <input type="password" name="password" id="password" autocomplete="off">
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Atualizar">
                    </div>
                </form>
            </div>
            
        </div>
        <?php } ?>
    </main>
</body>
</html>
