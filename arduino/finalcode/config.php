<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pap-maquina-de-vendas";

// Cria a ligação à base de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a ligação
if ($conn->connect_error) {
    die("Erro na ligação à base de dados: " . $conn->connect_error);
}

// Aguarda os dados enviados pelo Arduino via porta serial
while ($data = fgets(STDIN)) {
    // Lê dados da porta serial
    $data = trim($data);

    // Executa operações com base nos dados lidos
    if ($data) {
        echo "UID Recebido: $data\n";

        // Verifica se o UID existe na base de dados
        $check_query = "SELECT * FROM sua_tabela WHERE uid = '$data'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // O UID existe na base de dados, lê o saldo
            $row = $result->fetch_assoc();
            $saldo = $row['saldo'];

            // Envia o saldo para o Arduino via porta serial
            echo "Saldo:$saldo\n";
        } else {
            echo "UID não encontrado na base de dados.\n";
        }
    }
}

// Fecha a ligação à base de dados
$conn->close();
?>
