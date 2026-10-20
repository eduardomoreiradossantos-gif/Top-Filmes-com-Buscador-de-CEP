document.addEventListener('DOMContentLoaded', () => {
    // Checa se há um parâmetro 'status=success' na URL (vindo do processa_contato.php)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        alert('Sua sugestão de filme foi enviada com sucesso! Obrigado por participar da comunidade.');
        
        // Limpa a URL para não mostrar o alerta se recarregar a página
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});