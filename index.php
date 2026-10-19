<?php require_once 'config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top IMDb - Comunidade</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <span class="imdb-badge">IMDb</span> <span class="logo-text">Top Filmes</span>
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="index.php" class="active">Comunidade</a>
            <a href="pages/contato.html">Sugerir Filme</a>
            <a href="pages/portifolio.html">Sobre</a>
        </nav>
    </header>

    <main class="container fade-in">
        <h2 class="section-title">Últimas Sugestões da Comunidade</h2>
        
        <div class="suggestions-grid">
            <?php
            try {
                $sql = "SELECT nome, sugestao_filme, data_envio FROM sugestoes_filmes ORDER BY id DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                
                $sugestoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($sugestoes) > 0) {
                    foreach ($sugestoes as $linha) {
                        echo "<div class='suggestion-card'>";
                        echo "<div class='card-header'>";
                        echo "<strong>" . htmlspecialchars($linha['nome']) . "</strong>";
                        echo "<span class='date'>" . date('d/m/Y H:i', strtotime($linha['data_envio'])) . "</span>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<p>\"" . htmlspecialchars($linha['sugestao_filme']) . "\"</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='empty-state'>";
                    echo "<p>Nenhuma sugestão ainda. Seja o primeiro a compartilhar seu filme favorito!</p>";
                    echo "<a href='pages/contato.html' class='btn-primary'>Fazer Sugestão</a>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='error-msg'>Erro ao carregar dados: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Top Filmes IMDb Clone - Projeto Acadêmico</p>
    </footer>
    <script src="script/script.js"></script>
</body>
</html>
