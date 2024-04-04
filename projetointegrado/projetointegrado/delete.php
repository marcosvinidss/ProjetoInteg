    <?php
    session_start();
    include_once('config.php');

    if (!isset($_SESSION['matricula']) || !isset($_SESSION['senha'])) {
        header('Location: index.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["curso_id"])) {
            $id = $_POST["curso_id"];

            // Preparar e executar a consulta SQL para excluir o curso
            $sql = "DELETE FROM cursos WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "Curso excluído com sucesso.";
            } else {
                echo "Erro ao excluir o curso.";
            }

            $stmt->close();
            header('Location: dashboard.php');
        }
    }

    $conexao->close();
    ?>
