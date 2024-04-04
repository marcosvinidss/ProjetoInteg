<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['matricula']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
    exit();
}

$sql = "SELECT * FROM cursos";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISGECC</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        /* Adicione aqui o CSS para os blocos de curso */
        :root {
            --color-white: #fff;
            --color-dark1: rgb(39, 39, 39);
            --color-dark2: #2d2d2d;
            --color-dark3: #414141;
            --color-dark4: #1c1c1c;
            --color-dark5: #343434;
            --color-cream: #eff1e0;
            --color-cream2: #eff1e1;
            --color-bronze: #eab676; 
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: var(--color-dark1);
            color: var(--color-white);
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .curso {
            background-color: var(--color-dark3);
            color: var(--color-white);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: calc(23% - 20px); /* Definindo largura igual para os blocos */
            min-height: 300px; /* Definindo altura mínima */
            text-align: left; /* Alinha o texto à esquerda */
            position: relative; /* Permite posicionamento absoluto para os botões */
        }

        .curso:hover {
            transform: translateY(-5px);
        }

        .curso h2 {
            margin-bottom: 10px;
            font-size: 34px; /* Aumentando o tamanho da fonte */
            color: var(--color-bronze); /* Alterando a cor para bronze */
        }

        .curso h3 {
            font-size: 20px; /* Aumentando o tamanho da fonte */
            font-weight: bold; /* Deixa os títulos em negrito */
            margin-bottom: 5px; /* Adiciona espaço abaixo dos títulos */
            text-align: left; /* Alinha à esquerda */
            color: var(--color-bronze); /* Alterando a cor para bronze */
        }

        .curso p {
            margin-bottom: 10px; /* Aumentando o espaço abaixo dos parágrafos */
            font-size: 16px; /* Aumentando o tamanho da fonte */
            text-align: left; /* Alinha à esquerda */
            color: var(--color-white); /* Alterando a cor para branca */
        }

        .curso ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 10px; /* Adiciona espaço abaixo da lista */
            text-align: left; /* Alinha à esquerda */
        }

        .curso ul li {
            margin-bottom: 5px;
            color: var(--color-cream); /* Cor cream para os itens da lista */
        }

        .curso .botoes {
            position: absolute;
            bottom: 10px;
            right: 20px;
            display: flex; /* Alterado para flex para alinhar os botões lado a lado */
            align-items: center; /* Alinha os botões verticalmente ao centro */
        }

        .curso .botoes a, .curso .botoes button {
            margin-left: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }

        .curso .botoes a.editar {
            background-color: var(--color-bronze);
            color: var(--color-dark4);
        }

        .curso .botoes button.deletar {
            background-color: var(--color-dark4);
            color: white;
        }

        /* Adicione um estilo para o título "Painel de Cursos" */
        .titulo {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
            color: var(--color-cream); /* Cor cream para o título do painel de cursos */
        }
    </style>
</head>
<body id="body">
    <div class="header" id="header">
        <div class="logo_header">
            <h1>SISGECC</h1>
        </div>
        <div class="menu">
            <a href="dashboard.php">Home</a>
            <a href="criarCurso.php">Criar Novo curso</a>
            <a href="calchoras.php">Calculadora de Horas</a>
            <a href="contato.php">Contato</a>
        </div>
        <div class="logout-button">
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <div tabindex="0" class="content" id="content">
        <!-- Div para o título "Painel de Cursos" -->
        <div class="titulo">
            <h1>Painel de Cursos</h1>
        </div>

        <?php
        if (isset($result) && $result->num_rows > 0) {
            // Loop através dos resultados para exibir os cursos
            while ($row = $result->fetch_assoc()) {
                echo "<div class='curso'>";
                echo "<h2>" . $row["nome_curso"] . "</h2>";
                echo "<h3>Coordenador:</h3>";
                echo "<p>" . $row["coordenador"] . "</p>";
                echo "<h3>Matérias:</h3>";
                // Explode as matérias separadas por vírgula e exibe cada uma em um parágrafo
                $materias = explode(',', $row["materias"]);
                foreach ($materias as $materia) {
                    echo "<p>$materia</p>";
                }
                echo "<h3>Status:</h3>";
                echo "<p>" . (isset($row["statuscurso"]) ? $row["statuscurso"] : "Indisponível") . "</p>";
                echo "<div class='botoes'>";
                echo "<a href='edit.php?id=" . $row['id'] . "' class='editar'>Editar</a>";
                echo "<form action='delete.php' method='post'>";
                echo "<input type='hidden' name='curso_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='deletar' onclick='return confirm(\"Tem certeza que deseja excluir este curso?\")'>Deletar</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum curso encontrado.</p>";
        }
        ?>
    </div>
    <script src="js/index.js"></script>
</body>
</html>
