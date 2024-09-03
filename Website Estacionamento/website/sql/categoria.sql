CREATE TABLE Categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    tarifa DOUBLE
);

ALTER TABLE Categoria ADD CONSTRAINT nome_unico UNIQUE (nome);