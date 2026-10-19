document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        alert('Sua sugestão de filme foi enviada com sucesso! Obrigado por participar da comunidade.');
        window.history.replaceState({}, document.title, window.location.pathname);
    }

    const campoCep = document.getElementById('cep');
    const botaoCep = document.getElementById('buscar-cep');

    if (campoCep && botaoCep) {
        botaoCep.addEventListener('click', buscarCEP);
        campoCep.addEventListener('keydown', (evento) => {
            if (evento.key === 'Enter') {
                evento.preventDefault();
                buscarCEP();
            }
        });
    }
});

async function buscarCEP() {
    const campoCep = document.getElementById('cep');
    const mensagem = document.getElementById('mensagem-cep');
    const cep = campoCep.value.replace(/\D/g, '');
    const campos = ['rua', 'bairro', 'cidade', 'estado'];

    mensagem.textContent = '';
    campos.forEach((id) => {
        document.getElementById(id).value = '';
    });

    if (cep.length !== 8) {
        mensagem.textContent = 'Digite um CEP válido com 8 números.';
        return;
    }

    try {
        mensagem.textContent = 'Buscando endereço...';
        const resposta = await fetch(`https://viacep.com.br/ws/${cep}/json/`);

        if (!resposta.ok) {
            throw new Error('Falha na requisição');
        }

        const dados = await resposta.json();

        if (dados.erro) {
            throw new Error('CEP não encontrado');
        }

        document.getElementById('rua').value = dados.logradouro || '';
        document.getElementById('bairro').value = dados.bairro || '';
        document.getElementById('cidade').value = dados.localidade || '';
        document.getElementById('estado').value = dados.uf || '';
        mensagem.textContent = 'Endereço encontrado com sucesso!';
    } catch (erro) {
        mensagem.textContent = 'Não foi possível encontrar o CEP. Confira os números e tente novamente.';
    }
}
