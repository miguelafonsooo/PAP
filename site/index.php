<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadados -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem Vindo</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Ícone da página -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <!-- Título e link para a página inicial -->
        <h1><a href="index.php">Máquina de Vendas</a></h1>
        <!-- Navegação -->
        <nav>
            <!-- Verifica se o usuário está logado -->
            <?php
                session_start();
                if(isset($_SESSION['valid'])) {
                    // Se estiver logado, exibe o link para a homepage
                    echo '<a href="homepage.php">Homepage</a>';
                } else {
                    // Se não estiver logado, exibe os links para Login e Registro
                    echo '<a href="login.php">Login</a>';
                    echo '<a href="registro.php">Criar Conta</a>';
                }
            ?>
            <!-- Link para Sobre Nós -->
            <a href="sobrenos.php">Sobre Nós</a>
        </nav>
    </header>
    <!-- Conteúdo principal -->
    <main>
        <!-- Título de boas-vindas -->
        <h1>Bem vindo!</h1>
        
        <!-- Descrição da página -->
        <div class="h2index">
            <h2>à recarga fácil para a tua máquina de vendas! Aqui, é simples e rápido.</h2>
        </div>

        <!-- Conteúdo principal -->
        <div class="conteudo" id="margin">
            <p>
                 Recarrega o saldo em poucos cliques, sem complicações. Mantém o teu negócio a bombar a qualquer hora. Descobre a conveniência agora!
            </p>

            <!-- Imagem ilustrativa -->
            <img src="https://newebcdn-necta.evocagroup.com/sites/necta/files/styles/default/public/images/family/melodia_Hero.png?itok=ljHSsIzu" alt="">       
        </div>
    
        <!-- Caixa final com opções -->
        <div id="finalbox" class="conteudo">
            <!-- Imagem ilustrativa -->
            <img src="https://cdn.shopify.com/s/files/1/0939/8032/products/cold_drink_1.png?v=1438074549" alt="">  
            <!-- Opções -->
            <p> Clica em baixo se queres <br>
                    <a href="registro.php">Criar Conta</a>
                <br> ou <br>
                    <a href="login.php">Fazer Login</a>
                <br> ou <br>
                    <a href="sobrenos.php">Sobre Nós</a>
            </p>
        </div>
    </main>
</body>
</html>
