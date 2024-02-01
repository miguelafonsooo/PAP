<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Saldo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.html">Máquina de Vendas</a></h1>
        <nav>
            <a href="homepage.php">Voltar Atrás</a>
        </nav>
    </header>
    <main>
        <div class="caixa">
            <div class="box form-box">
                <?php
                if (isset($_POST['submit'])) {
                    $saldo = $_POST['Saldo'];

                    $id = $_SESSION['id'];

                    $edit_query = mysqli_query($con, "UPDATE users SET Saldo='$saldo' WHERE Id=$id") or die("Error Ocurred");

                    if ($edit_query) {
                        echo "<div class='message'>
                        <p>Saldo Atualizado!</p>
                    </div> <br>";
                        echo "<a href='homepage.php' class='btn'>Voltar Atrás</a>";
                    }
                } else {

                    $id = $_SESSION['id'];
                    $query = mysqli_query($con, "SELECT * FROM users WHERE ID=$id");

                    while ($result = mysqli_fetch_assoc($query)) {
                        $res_Saldo = $result['Saldo'];
                    }
                    ?>

                    <div class="header">Alterar Saldo</div>
                    <form action="" method="post">
                        <div class="field input">
                            <label for="username">Saldo</label>
                            <input type="text" name="Saldo" id="Saldo" value="<?php echo $res_Saldo; ?>" autocomplete="off">
                        </div>
                        <div class="field">
                            <input type="submit" class="btn" name="submit" value="Atualizar">
                        </div>
                    </form>
            </div>
        </div>
        <?php } ?>
    </main>
    <script>
        // Adicione a validação para aceitar números decimais no lado do cliente (JavaScript)
        document.getElementById('Saldo').addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9.]/g, ''); // Remove caracteres não numéricos, exceto ponto
        });
    </script>
</body>
</html>
