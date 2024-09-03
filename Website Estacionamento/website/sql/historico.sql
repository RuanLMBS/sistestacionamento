CREATE TABLE historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    f_id INT,
    entrada VARCHAR(255),
    saida VARCHAR(255),
    tempo INT,
    valor DOUBLE
    FOREIGN KEY (f_id) REFERENCES veiculo(id)
);