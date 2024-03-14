<?php
    session_start();
    include("php/config.php");

    // Verificar se o usuário está autenticado como administrador
    if(!isset($_SESSION['valid']) || $_SESSION['valid'] !== 'admin'){
        // Redirecionar para a página de login se não estiver autenticado
        header("Location: homepage.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
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
<body>
    <header>
        <h1><a href="index.php">Máquina de Vendas</a></h1>
        <nav>
            <a href="edit.php">Editar Perfil</a>
            <a href="php/logout.php">Sair da Conta</a>
        </nav>
    </header>
    <div class="homepage">
        <main>
            <h1>Administração</h1>
            <p><b>Bem Vindo <?php echo $res_Uname?>!</b></p>
            <a href="produtos.php" class="links">Altera os Produtos Aqui</a>

            <a href="saldo.php" class="links">Alterar Saldo</a>

            <a href="registrocartao.php" class="links">Alterar Cartão</a>
        </main>
    </div>
</body>
</html>
