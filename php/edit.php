<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
        exit(); // Certifique-se de sair após redirecionar
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
            <a href="sobrenos.html">Sobre Nós</a>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="box form-box">
                <?php
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $age = $_POST['age'];

                    // Verificar se uma nova senha foi fornecida
                    if (!empty($_POST['password'])) {
                        $password = $_POST['password'];
                        $password_cripto = password_hash($password, PASSWORD_DEFAULT);
                        $password_update = ", Password='$password_cripto'";
                    } else {
                        $password_update = ""; // Não atualizar a senha se não houver uma nova senha
                    }

                    $id = $_SESSION['id'];

                    $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age'".$password_update." WHERE Id=$id") or die("Error Ocurred");

                    if($edit_query){
                        echo "<div class='message'>
                        <p>Perfil Atualizado!</p>
                    </div> <br>";
                        echo "<a href='homepage.php'><button class='btn'>Voltar Atrás</button></a>";
                    }
                }else{

                    $id = $_SESSION['id'];
                    $query = mysqli_query($con,"SELECT * FROM users WHERE ID=$id");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_Uname = $result['Username'];
                        $res_Email = $result['Email'];
                        $res_Age = $result['Age'];
                        // Não inclua a senha no formulário de edição
                    }
                ?>

                <div class="header">Editar Perfil</div>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Nome</label>
                        <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off">
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
