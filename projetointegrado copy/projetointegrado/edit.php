<?php 
if(!empty($_GET['id'])){
    include_once('config.php');

    $id = $_GET['id'];
    $sqlselect ="SELECT * FROM cursos WHERE id=$id";

    $result = $conexao -> query($sqlselect);

   if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $nome_curso = $row['nome_curso'];
        $coordenador = $row['coordenador'];
        $materias = $row['materias'];
        $status = $row['statuscurso'];
   } else {
        header('Location: dashboard.php');
        exit();
   }
}

if(isset($_POST['submit'])) {
    $nome_curso = $_POST['nome_curso'];
    $coordenador = $_POST['coordenador'];
    $materias = $_POST['materias'];
    $status = $_POST['status'];

    $sqlupdate = "UPDATE cursos SET nome_curso='$nome_curso', coordenador='$coordenador', materias='$materias', statuscurso='$status' WHERE id=$id";

    if($conexao->query($sqlupdate) === TRUE) {
        $mensagem = "Curso atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar curso: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISGECC</title>
    <link rel="stylesheet" href="css/edit.css">
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
        <h1 style="margin-bottom: 20px;">Editar Curso:</h1>
       
        <form action="" method="POST">
            <label for="nome_curso">Nome do Curso:</label><br>
            <input type="text" id="nome_curso" name="nome_curso" value="<?php echo $nome_curso; ?>"><br>
            <label for="coordenador">Coordenador:</label><br>
            <input type="text" id="coordenador" name="coordenador" value="<?php echo $coordenador; ?>"><br>
            <label for="materias">Matérias:</label><br>
            <textarea id="materias" name="materias" rows="4" placeholder="Digite as matérias separadas por vírgula"><?php echo $materias; ?></textarea><br>
            <br><br>
            <label for="status">Status do Curso:</label><br>
            <select id="status" name="status">
                <option value="analise" <?php if($status == 'analise') echo 'selected'; ?>>Em Análise</option>
                <option value="execucao" <?php if($status == 'execucao') echo 'selected'; ?>>Em Execução</option>
                <option value="finalizado" <?php if($status == 'finalizado') echo 'selected'; ?>>Finalizado</option>
            </select><br>
            <input type="submit" name="submit" value="Salvar Alterações">
        </form>
        
        <?php if(isset($mensagem)) echo "<p>$mensagem</p>"; ?>
        
    </div>

    <script src="js/criar.js"></script>
</body>
</html>
