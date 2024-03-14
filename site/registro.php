<?php
// Inicia a sessão para manter os dados do usuário durante a navegação
session_start();

// Inclui o arquivo de configuração, que contém configurações importantes, como conexão com o banco de dados
include("php/config.php");

// Verifica se o usuário já está logado, redireciona para a página inicial se estiver
if (isset($_SESSION['valid'])) {
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
        <!-- Cabeçalho da página com o título do site e links de navegação -->
        <h1><a href="index.php">Máquina de Vendas</a></h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="registro.php">Criar Conta</a>
            <a href="sobrenos.php">Sobre Nós</a>
        </nav>
    </header>
    <main>
        <!-- Conteúdo principal da página -->
        <div class="caixa">
            <!-- Caixa de conteúdo -->
            <div class="box form-box">
                <!-- Caixa de formulário -->

                <?php
                // Processa o formulário de registro
                include("php/config.php");
                if (isset($_POST['submit'])) {
                    // Obtém os dados do formulário
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $age = $_POST['age'];
                    $password = $_POST['password'];
                    $password_cripto = password_hash($password, PASSWORD_DEFAULT);
                    $cardUID = $_POST['cardUID'];

                    // Verifica se o email já está em uso
                    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");
                    if (mysqli_num_rows($verify_query) != 0) {
                        // Exibe uma mensagem de erro se o email já estiver em uso
                        echo "<div class='message'>
                                <p>Este email está a ser usado. Tenta outro por favor.</p>
                            </div> <br>";
                        echo "<a href='javascript:self.history.back()' class='btn'>Voltar Atrás</a>";
                    } else {
                        // Insere os dados do usuário no banco de dados se o email estiver disponível
                        mysqli_query($con, "INSERT INTO users (Username, Email, Age, Password) VALUES ('$username', '$email', '$age', '$password_cripto')") or die("Error Ocurred");
                        echo "<div class='message'>
                                <p>Registro Completo!</p>
                            </div> <br>";
                        echo "<a href='login.php' class='btn'>Logar Agora</a>";
                    }
                } else {
                ?>

                    <!-- Formulário de registro -->
                    <div class="header">Registro</div>
                    <form action="" method="post">
                        <div class="field input">
                            <label for="username">Nome (máximo de 10 caracteres)</label>
                            <input type="text" name="username" id="username" autocomplete="off" maxlength="10" required>
                        </div>
                        <div class="field input">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" autocomplete="off" required>
                        </div>
                        <div class="field input">
                            <label for="age">Idade</label>
                            <input type="number" name="age" id="age" autocomplete="off" required>
                        </div>
                        <div class="field input">
                            <label for="password">Palavra-Passe</label>
                            <input type="password" name="password" id="password" autocomplete="off" required>
                        </div>
                        <div class="field">
                            <!-- Botão de envio do formulário -->
                            <input type="submit" class="btn" name="submit" value="Registro">
                        </div>
                    </form>
                    <div class="links">
                        <!-- Link para a página de login -->
                        Já és membro? <a href="login.php">Clica aqui</a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </main>

</body>

</html>
