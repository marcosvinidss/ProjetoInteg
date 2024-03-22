// Função para abrir o pop-up
function openPopup() {
    document.getElementById("popup").style.display = "block";
}

// Função para fechar o pop-up
function closePopup() {
    document.getElementById("popup").style.display = "none";
}

function searchTable() {
    // Obtenha o valor de entrada de pesquisa
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    
    // Obtenha a tabela e as linhas da tabela
    var table = document.getElementsByTagName("table")[0];
    var rows = table.getElementsByTagName("tr");
    
    // Loop através de todas as linhas da tabela
    for (var i = 0; i < rows.length; i++) {
        var found = false;
        // Obtenha todas as células da linha atual
        var cells = rows[i].getElementsByTagName("td");
        // Loop através de todas as células da linha atual
        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];
            if (cell) {
                var txtValue = cell.textContent || cell.innerText;
                // Verifique se o texto da célula contém o filtro de pesquisa
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        // Exiba ou oculte a linha com base no resultado da pesquisa
        if (found) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

