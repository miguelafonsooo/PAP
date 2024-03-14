<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.php">Máquina de Vendas</a></h1>
        <nav>
        <?php
                session_start();
                if(isset($_SESSION['valid'])) {
                    // Se estiver logado, exibe o link para a homepage
                    echo '<a href="homeadmin.php">Homepage</a>';
                } else {
                    // Se não estiver logado, exibe os links para Login e Registro
                    echo '<a href="login.php">Login</a>';
                    echo '<a href="registro.php">Criar Conta</a>';
                }
            ?>
        </nav>
    </header>
    <main>
        
        <div id="boxsobre">
            <h1>Sobre Nós</h1>
            <p>
                Olá! Somos a equipa por detrás da magia da tua máquina de vendas! Aqui, a recarga de saldo é facílima. Em vez de te perderes em procedimentos complicados, tornamos tudo simples.
            </p>
            <div class="h2index">
                <h2>Como Funciona?</h2>
            </div>
            <p>
                Imagina clicar, e pronto! O saldo do teu cartão está renovado. Nada de complicações, só facilidade. Estamos disponíveis 24/7 para garantir que nunca fiques na mão.
            </p>
            <div class="h2index">
                <h2>O Nosso Compromisso</h2>
            </div>
            <p>
                Dedicamos tempo para simplificar a tua vida. A recarga é rápida, direta e sem stress. A eficiência é o nosso lema.
            </p>

            <div class="h2index">
                <h2>Vem Conferir!</h2>
            </div>
            <p>
                Se estás à procura de algo fácil e rápido, <a href="registro.php">Junta-te a nós!</a> Descobre como a recarga de saldo pode ser uma coisa simples!
            </p>
        </div>
    </main>
</body>
</html>