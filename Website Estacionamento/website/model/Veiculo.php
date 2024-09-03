<?php 
    include ("./db/database.php");
    class Veiculo {
        private $id;
        private $placa;
        private $modelo;
        private $categoria;
        private $connection;
        private $entrada;
        private $saida;

        public function __construct($id, $placa,$modelo, $categoria,$connection) {
            $this->id = $id;
            $this->placa = $placa;
            $this->modelo = $modelo;
            $this->categoria = $categoria;
            $this->connection = $connection;
            $this->entrada;
            $this->saida;
        }

        public function setId($id) {
           $this->id = $id;
        }
        public function getId() {
            return $this->id;
        }

        public function getPlaca() {
            return $this->placa;
        }

        public function getModelo() {
            return $this->modelo;
        }

        public function getTaxaCategoria() {
            $sql = "SELECT tarifa FROM categoria WHERE id={$this->categoria}";
            $result = mysqli_query($this->connection, $sql);
            while($row=mysqli_fetch_assoc($result)) {
                return $row["tarifa"];
            }
        }

        public function getCategoriaId() {
            return $this->categoria;
        }

        public function getStatus() {
            return $this->estacionado;
        }

        function statusDb() {
            global $connection;
            $sql = "SELECT estacionado FROM veiculo WHERE placa = '{$this->placa}'";
            $result = mysqli_query($connection, $sql);
            while($row=mysqli_fetch_assoc($result)) {
                return $row["estacionado"];
            }
        }
        
        public function entrar() {
            if($this->statusDb()==0) {
                $sql = "UPDATE veiculo SET estacionado = 1 WHERE placa = '{$this->placa}'";
                $result = mysqli_query($this->connection, $sql);
                if($result) {
                    $this->entrada = date('Y-m-d H:i:s');
                    $sql_entrada = "INSERT INTO historico (f_id, entrada) VALUES (".$this->getId().",'$this->entrada')";
                    $sqlentr_result = mysqli_query($this->connection, $sql_entrada);
                    echo"Veículo estacionado com sucesso!";
                } else {
                    echo"Não foi possível estacionar o veículo!";
                }
            } else {
                echo"O veículo já está estacionado!";
            }
        }   

        public function getEntrada() {
            $sql = "SELECT * FROM historico WHERE f_id='{$this->id}' ORDER BY ID DESC LIMIT 1";
            $result = mysqli_query($this->connection,$sql);
            while($row=mysqli_fetch_assoc($result)) {
                return $row;
            }
        }

        public function sair() {
            if($this->statusDb()!=0) {
                $sql = "UPDATE veiculo SET estacionado = 0 WHERE placa = '{$this->placa}'";
                $result = mysqli_query($this->connection, $sql);
                if($result) {
                    $this->saida = date('Y-m-d H:i:s');
                    $toComplete = $this->getEntrada();
                    $idHistorico = $toComplete["id"];
                    $entrada = $toComplete["entrada"];
                    $timestamp1 = strtotime($entrada);
                    $timestamp2 = strtotime($this->saida);
                    $tempo = $timestamp2 - $timestamp1;
                    $tarifa = $this->getTaxaCategoria();
                    $valor = ($tempo * $tarifa);
                    $sql="UPDATE historico SET saida='{$this->saida}',tempo='{$tempo}',valor='{$valor}' WHERE ID='{$idHistorico}'";
                    $result_upd = mysqli_query($this->connection, $sql);
                    if($result_upd) {
                        echo"Veículo retirado com sucesso!";
                    }     
                }
            } else {
                echo" O veículo não está estacionado! ";
            }
        }

        public function mostrarHistorico() {
            $sql = "SELECT * FROM historico WHERE f_id='{$this->id}'";
            $result = mysqli_query($this->connection, $sql);
            if($result->num_rows>0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo"<p style='font-weight:bold;'>Dados do veículo de placa '{$this->placa}':</p><br>";
                    echo"Entrada: {$row['entrada']}  |  Saída: {$row['saida']}</br>";
                    echo"Tempo de Permanência: {$row['tempo']}s  |  Valor: {$row['valor']}</br>";
                    echo"-==============================================-</br>";
                }
            } else {
                echo"<br>Este veículo ainda não possui histórico!";
            }
        }}

?>