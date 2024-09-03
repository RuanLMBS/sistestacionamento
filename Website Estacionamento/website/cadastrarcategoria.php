<?php
    include("./header.html");
    
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cdcategoria.css">
    <title>Cadastrar Categoria</title>
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="post" class="form">
        <label>Nome da Categoria: </label><br>
        <input type="text" name="nome" class="input" style="padding:3px;"><br><br>

        <labeL>Tarifa / hora: </labeL><br>
        <input type="number" name="tarifa" style="padding:4px;"><br><br>
        <input type="submit" name="enviar" value="Enviar" style="padding:5px;border-radius:10%;background-color:#001C48;color:#FC7728;cursor:pointer"><br>
        <?php
            include("./db/database.php");

            if(isset($_POST["enviar"])) {
                $nome = filter_input(INPUT_POST, "nome",
                                     FILTER_SANITIZE_SPECIAL_CHARS);
                $tarifa = filter_input(INPUT_POST, "tarifa",
                                     FILTER_SANITIZE_NUMBER_INT);
             
                if($nome!='' && $tarifa!='') {
                    $sql = "INSERT INTO categoria (nome, tarifa)
                            VALUES ('$nome',$tarifa)";  
                    try {
                        mysqli_query($connection,$sql);
                        echo"Categoria cadastrada com sucesso!";
                    } catch (mysqli_sql_exception) {
                        echo"<br>Não foi possível cadastrar o veículo!";
                    }
                } else {
                    echo "<br>Um dos campos está vazio!";
                }
            }
            mysqli_close($connection);
        ?>
    </form>
    
</body>
</html>

