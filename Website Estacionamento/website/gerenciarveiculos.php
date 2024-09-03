<?php
    include("./header.html");
?> 

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/gerenciar.css">
    <title>Gerenciar Veículos</title>
</head>
<body>
        <h1>GERENCIAMENTO DE VEÍCULOS CADASTRADOS</h1>
        <div id="div">
        <?php
            require("./db/database.php");
            require("./model/Veiculo.php");

            function pegaVeiculos() {
                global $connection;
                $sql = "SELECT * FROM veiculo";
                $veiculos = array();
                $res = mysqli_query($connection , $sql);
                if($res->num_rows>0) {
                    while($row = mysqli_fetch_assoc($res)) {
                       $veiculos[] = array(
                            "id"=>$row["id"],
                            "placa"=>$row["placa"],
                            "modelo"=>$row["modelo"],
                            "categoria_id"=>$row["categoria_id"],
                       );             
                    }
                } 
                return $veiculos;
            }
            $veiculos = pegaVeiculos();
            foreach ($veiculos as $veiculo) {
            $veiculoObj = new Veiculo ($veiculo["id"],$veiculo["placa"],$veiculo["modelo"],$veiculo["categoria_id"],$connection);
                echo'<form action='.$_SERVER["PHP_SELF"].' method="post" class="form">';
                    echo'<div class="cars">';
                    echo '<br>Placa: ' . $veiculoObj->getPlaca() . '    <br>';
                    echo '<input type="submit" name="entrada_'.$veiculoObj->getId().'" value="Entrada" style="padding:5px;border-radius:10%;background-color:#001C48;color:#FC7728;cursor:pointer"/>';
                    echo '<input type="submit" name="saida_'.$veiculoObj->getId().'" value="Saida" style="padding:5px;border-radius:10%;background-color:#001C48;color:#FC7728;cursor:pointer"/>';
                    echo '<input class="btn" type="submit" name="historico_'.$veiculoObj->getId().'" value="Historico" style="padding:5px;border-radius:10%;background-color:#001C48;color:#FC7728;cursor:pointer"/>';
                    echo "</div><br>";
                    if(isset($_POST["entrada_".$veiculoObj->getId()])) {
                        $veiculoObj->entrar();
                    }
                    if(isset($_POST["saida_".$veiculoObj->getId()])) {
                        $veiculoObj->sair();
                    }
                    if(isset($_POST["historico_".$veiculoObj->getId()])) {
                        $veiculoObj->mostrarHistorico();
                    }
            }
            mysqli_close($connection);
        ?>
    </div>
</body>
</html>