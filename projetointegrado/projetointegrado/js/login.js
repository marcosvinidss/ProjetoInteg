document.getElementById('loginForm').addEventListener('submit', function(event) {
    // Pega os valores dos campos de entrada
    var matricula = document.getElementById('matricula').value.trim();
    var senha = document.getElementById('senha').value.trim();

    // Verifica se algum campo está vazio
    if (matricula === '' || senha === '') {
        // Se algum campo estiver vazio, impede o envio do formulário
        alert('Por favor, preencha todos os campos.');
        event.preventDefault();
    }
});