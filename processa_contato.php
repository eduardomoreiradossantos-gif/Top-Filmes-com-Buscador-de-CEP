<?php
require_once 'config/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sugestao = $_POST['sugestao_filme'];

    try {
        $sql = "INSERT INTO sugestoes_filmes (nome, email, sugestao_filme) VALUES (:nome, :email, :sugestao)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sugestao', $sugestao);
        
        $stmt->execute();

        header("Location: index.php?status=success");
        exit();
        
    } catch (PDOException $e) {
        die("Erro ao salvar: " . $e->getMessage());
    }
} else {
    header("Location: index.html");
    exit();
}
?>
