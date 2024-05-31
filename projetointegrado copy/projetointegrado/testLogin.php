<?php
session_start();

// Verificar se o usuário está logado. Se estiver, redirecionar para a página de dashboard
if (isset($_SESSION['matricula']) && isset($_SESSION['senha'])) {
    header('Location: dashboard.php');
    exit; // Certifique-se de sair do script após o redirecionamento
}

// Se o formulário de login for enviado, realizar a autenticação
if (isset($_POST['submit']) && !empty($_POST['matricula']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $matricula = $_POST['matricula'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE matricula = $matricula AND senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['matricula']);
        unset($_SESSION['senha']);
        $error = "Matrícula ou senha inválida!";
    } else {
        $_SESSION['matricula'] = $matricula;
        $_SESSION['senha'] = $senha;
        header('Location: dashboard.php');
        exit;
    }
}
?>
