<?php
    $con = mysqli_connect("localhost", "root", "", "pap-maquina-de-vendas");

    if (!$con) {
        die("Erro na ligação: " . mysqli_connect_error());
    }
?>
