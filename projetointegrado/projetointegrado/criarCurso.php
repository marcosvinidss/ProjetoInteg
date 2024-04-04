<?php 
if(isset($_POST['submit'])){
    include_once('config.php');

    $nome_curso = $_POST['nome_curso'];
    $coordenador = $_POST['coordenador'];
    $materias = $_POST['materias'];
    $status = $_POST['status'];

    $result = $conexao->prepare("INSERT INTO cursos (nome_curso, coordenador, materias, statuscurso) VALUES (?, ?, ?, ?)");
    $result->bind_param("ssss", $nome_curso, $coordenador, $materias, $status);
    $result->execute();

    if ($result->affected_rows > 0) {
        $mensagem = "Curso criado com sucesso!";
    } else {
        $mensagem = "Erro ao criar o curso: " . $conexao->error;
    }

    $result->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISGECC</title>
    <link rel="stylesheet" href="css/criar.css">
    <link rel="stylesheet" href="css/styles.css"> <!-- Adicionando o arquivo CSS externo -->
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
    </div>
    <div tabindex="0" class="content" id="content">
        <h1 style="margin-bottom: 20px;">Criar novo curso:</h1>
       
        <form action="criarCurso.php" method="POST">
            <label for="nome_curso">Nome do Curso:</label><br>
            <input type="text" id="nome_curso" name="nome_curso"><br>
            <label for="coordenador">Coordenador:</label><br>
            <input type="text" id="coordenador" name="coordenador"><br>
            <label for="materias">Matérias:</label><br>
            <textarea id="materias" name="materias" rows="4" placeholder="Digite as matérias separadas por vírgula"></textarea><br>
            <br><br>
            <label for="status">Status do Curso:</label><br>
            <select id="status" name="status">
                <option value="analise">Em Análise</option>
                <option value="execucao">Em Execução</option>
                <option value="finalizado">Finalizado</option>
            </select><br>
            <input type="submit" name="submit" value="Criar Curso">
        </form>
        
        <?php if(isset($mensagem)) echo "<p>$mensagem</p>"; ?>
        
    </div>

    <script src="js/criar.js"></script>
</body>
</html>
