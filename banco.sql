CREATE DATABASE IF NOT EXISTS filmes_imdb_db;
USE filmes_imdb_db;

CREATE TABLE sugestoes_filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sugestao_filme TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
