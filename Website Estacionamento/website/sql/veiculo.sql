CREATE TABLE Veiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(20) UNIQUE NOT NULL,
    modelo VARCHAR(50),
    categoria_id INT,
    estacionado TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (categoria_id) REFERENCES Categoria(id)
);