document.getElementById('cadastroForm').addEventListener('submit', function(event) {
    var nome = document.getElementById('nome').value.trim();
    var matricula = document.getElementById('matricula').value.trim();
    var senha = document.getElementById('senha').value.trim();

    if (nome === '' || matricula === '' || senha === '') {
        alert('Por favor, preencha todos os campos.');
        event.preventDefault();
    }
});