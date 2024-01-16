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
    <title>Registar Cartão</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="sobrenos.html">Sobre Nós</a>
            <a href="homepage.php">Voltar Atrás</a>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="box form-box">
                <?php
                if(isset($_POST['submit'])){
                    $UID = $_POST['CardUID'];



                    $id = $_SESSION['id'];

                    $edit_query = mysqli_query($con, "UPDATE users SET CardUID= '$UID' WHERE Id=$id") or die("Error Ocurred");

                    if($edit_query){
                        echo "<div class='message'>
                        <p>Cartão Atualizado!</p>
                    </div> <br>";
                        echo "<a href='homepage.php'><button class='btn'>Voltar Atrás</button></a>";
                    }
                }else{

                    $id = $_SESSION['id'];
                    $query = mysqli_query($con,"SELECT * FROM users WHERE ID=$id");

                    while($result = mysqli_fetch_assoc($query)){
                        $res_UID = $result['CardUID'];
                        
                    }
                ?>

                <div class="header">Alterar Cartão</div>
                <form action="" method="post">
                    <div class="field input">
                        <label for="CardUID">Id do Cartão</label>
                        <input type="text" name="CardUID" id="CardUID" value="<?php echo $res_UID; ?>" autocomplete="off">
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Atualizar Cartão">
                    </div>
                </form>
            </div>
            
        </div>
        <?php } ?>
    </main>
</body>
</html>
