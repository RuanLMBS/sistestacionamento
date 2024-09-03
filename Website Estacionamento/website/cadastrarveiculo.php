<?php
require("./model/Veiculo.php");
include("./header.html");


?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cdveiculo.css">
    <title>Cadastrar Veículo</title>
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post" class="form" style="text-align:center;position:relative;top:40vh;">
            <label>Placa: </label><br>
            <input type="text" name="placa" style="padding:3px;"><br><br>
            <labeL>Modelo: </labeL><br>
            <input type="text" name="modelo" style="padding:3px;"><br><br>
            <labeL>Categoria: </labeL><br>
            <select name="categoria" style="padding:3px;">
                    <?php
                    include("./db/database.php");
                    $sql = "SELECT nome FROM categoria";
                    $resultado = mysqli_query($connection,$sql);

                    if($resultado->num_rows > 0){
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="'.$row["nome"].'">'.$row["nome"].'</option>';
                        }
                    } else {
                        echo '<option value="">Nenhuma categoria encontrada</option>';
                    }
                ?>
            </select></br></br>
            <input type="submit" name="enviar" value="Enviar" style="padding:5px;border-radius:10%;background-color:#001C48;color:#FC7728;cursor:pointer"><br>
            <?php

            include("./db/database.php");
            if(isset($_POST["enviar"])) {
                $placa = filter_input(INPUT_POST, "placa",
                                     FILTER_SANITIZE_SPECIAL_CHARS);
                $modelo = filter_input(INPUT_POST, "modelo",
                                     FILTER_SANITIZE_SPECIAL_CHARS);
                $categoria = $_POST["categoria"];
                
                if($placa!="" && $modelo!="") {
                    $pega_categoria = "SELECT * FROM categoria WHERE nome='$categoria'";
                    $result_categ = mysqli_query($connection, $pega_categoria);
                    if($result_categ->num_rows > 0) {
                        $row_categoria = mysqli_fetch_assoc($result_categ);
                        $categoria_fk=$row_categoria["id"];
                        $inserirVeiculo = "INSERT INTO veiculo (placa,modelo,categoria_id) VALUES
                                                        ('$placa','$modelo',$categoria_fk) ";
                        try {
                            if (mysqli_query($connection, $inserirVeiculo)) {
                                echo "Veículo inserido com sucesso !";
                            } else {
                            echo "Erro ao inserir o veículo: " . mysqli_error($connection);
                            }
                         } catch (mysqli_sql_exception) {
                            echo"Placa já cadastrada!";
                         }
                        
                    } else {
                        echo"Não há nenhuma categoria cadastrada!";
                    }
                } else {
                    echo"Não foi possível cadastrar o veículo!";
                }
            }
            mysqli_close($connection);
            ?>
    </form>
</body>
</html>
