

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1><a href="index.php">Máquina de Vendas</a></h1>
        <nav>
            <a href="homeadmin.php">Voltar Atrás</a>
        </nav>
    </header>
    <main>
        <div class="caixa">
            <div class="box form-box">
            <?php
                    session_start();
                    include("php/config.php");

                    if(!isset($_SESSION['valid'])){
                        header("Location: login.php");
                        exit();
                    }

                    if(isset($_POST['submit'])){
                        // Obter os dados dos produtos do formulário
                        $product_name1 = mysqli_real_escape_string($con, $_POST['product_name1']);
                        $product_value1 = floatval($_POST['product_value1']);
                        $product_name2 = mysqli_real_escape_string($con, $_POST['product_name2']);
                        $product_value2 = floatval($_POST['product_value2']);
                        $product_name3 = mysqli_real_escape_string($con, $_POST['product_name3']);
                        $product_value3 = floatval($_POST['product_value3']);
                        $product_name4 = mysqli_real_escape_string($con, $_POST['product_name4']);
                        $product_value4 = floatval($_POST['product_value4']);
                        
                        // Atualizar os produtos na base de dados
                        $edit_query1 = mysqli_query($con, "UPDATE Produtos SET Product_Name='$product_name1', Product_Value='$product_value1' WHERE Product_Id=1") or die(mysqli_error($con));
                        $edit_query2 = mysqli_query($con, "UPDATE Produtos SET Product_Name='$product_name2', Product_Value='$product_value2' WHERE Product_Id=2") or die(mysqli_error($con));
                        $edit_query3 = mysqli_query($con, "UPDATE Produtos SET Product_Name='$product_name3', Product_Value='$product_value3' WHERE Product_Id=3") or die(mysqli_error($con));
                        $edit_query4 = mysqli_query($con, "UPDATE Produtos SET Product_Name='$product_name4', Product_Value='$product_value4' WHERE Product_Id=4") or die(mysqli_error($con));

                        if($edit_query1 && $edit_query2 && $edit_query3 && $edit_query4){
                            echo "<div class='message'>
                                <p>Produtos Atualizados!</p>
                            </div> <br>";
                            echo "<a href='homeadmin.php' class='btn'>Voltar Atrás</a>";
                        } else {
                            echo "Erro ao atualizar os produtos.";
                        }
                    } else {
                        // Recuperar os dados dos produtos da base de dados
                        $query = mysqli_query($con, "SELECT Product_Name, Product_Value FROM Produtos");
                        $products = array();
                        while ($row = mysqli_fetch_assoc($query)) {
                            $products[] = $row;
                        }
                        $res_ProductName1 = $products[0]['Product_Name'];
                        $res_ProductValue1 = $products[0]['Product_Value'];
                        $res_ProductName2 = $products[1]['Product_Name'];
                        $res_ProductValue2 = $products[1]['Product_Value'];
                        $res_ProductName3 = $products[2]['Product_Name'];
                        $res_ProductValue3 = $products[2]['Product_Value'];
                        $res_ProductName4 = $products[3]['Product_Name'];
                        $res_ProductValue4 = $products[3]['Product_Value'];
                ?>
                <div class="header">Alterar nome e valor dos produtos</div>
                <form action="" method="post">
                    <!-- Produto 1 -->
                    <div class="field input">
                        <label for="product_name1" style="color: green; font-weight: bold;">Botão Verde</label>
                        <input type="text" name="product_name1" id="product_name1" value="<?php echo $res_ProductName1; ?>" autocomplete="off">
                        <label for="product_value1">Valor do Produto</label>
                        <input type="text" name="product_value1" id="product_value1" value="<?php echo number_format($res_ProductValue1, 2, ',', '.'); ?>" autocomplete="off">
                    </div>
                    <!-- Produto 2 -->
                    <div class="field input">
                        <label for="product_name2" style="color: red; font-weight: bold;">Botão Vermelho</label>
                        <input type="text" name="product_name2" id="product_name2" value="<?php echo $res_ProductName2; ?>" autocomplete="off">
                        <label for="product_value2">Valor do Produto</label>
                        <input type="text" name="product_value2" id="product_value2" value="<?php echo number_format($res_ProductValue2, 2, ',', '.'); ?>" autocomplete="off">
                    </div>
                    <!-- Produto 3 -->
                    <div class="field input">
                        <label for="product_name3" style="color: black; font-weight: bold;">Botão Preto</label>
                        <input type="text" name="product_name3" id="product_name3" value="<?php echo $res_ProductName3; ?>" autocomplete="off">
                        <label for="product_value3">Valor do Produto</label>
                        <input type="text" name="product_value3" id="product_value3" value="<?php echo number_format($res_ProductValue3, 2, ',', '.'); ?>" autocomplete="off">
                    </div>
                    <!-- Produto 4 -->
                    <div class="field input">
                        <label for="product_name4" style="color: blue; font-weight: bold;">Botão Azul</label>
                        <input type="text" name="product_name4" id="product_name4" value="<?php echo $res_ProductName4; ?>" autocomplete="off">
                        <label for="product_value4">Valor do Produto</label>
                        <input type="text" name="product_value4" id="product_value4" value="<?php echo number_format($res_ProductValue4, 2, ',', '.'); ?>" autocomplete="off">
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Atualizar">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

<?php } ?>
