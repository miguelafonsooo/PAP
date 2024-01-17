<?php
// Conexão com o banco de dados (use suas credenciais)
$dbHost = "s";
$dbUser = "seu_usuario";
$dbPass = "sua_senha";
$dbName = "sua_base_de_dados";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta o banco de dados para obter informações sobre o usuário atual
$query = "SELECT * FROM users WHERE CardUID = '123456789'";  // Substitua pelo UID real lido do cartão RFID
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Retorna as informações do usuário como JSON
    echo json_encode($row);
} else {
    // Retorna uma resposta indicando que o cartão não está associado a nenhum usuário
    echo json_encode(["error" => "Cartão não registrado"]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
