document.getElementById('materiaInput').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        var materia = this.value.trim();
        if (materia !== '') {
            addMateria(materia);
            this.value = ''; // Limpa o input após adicionar a matéria
        }
    }
});

function addMateria(materia) {
    var materiaElement = document.createElement('div');
    materiaElement.classList.add('materia-item');

    var materiaText = document.createElement('span');
    materiaText.textContent = materia;

    var removeButton = document.createElement('span');
    removeButton.textContent = 'x';
    removeButton.classList.add('remove-button');
    removeButton.addEventListener('click', function () {
        materiaElement.remove();
    });

    materiaElement.appendChild(materiaText);
    materiaElement.appendChild(document.createTextNode(' '));
    materiaElement.appendChild(removeButton);
    document.getElementById('materiasSelecionadas').appendChild(materiaElement);

    // Adiciona a matéria ao input com o nome "materias"
    var materiasInput = document.createElement('input');
    materiasInput.type = 'hidden';
    materiasInput.name = 'materias[]';
    materiasInput.value = materia;
    document.getElementById('content').appendChild(materiasInput);
}
