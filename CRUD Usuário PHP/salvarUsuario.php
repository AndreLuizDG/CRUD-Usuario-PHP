<?php
session_start();
include_once 'sanitizar.php';


$dadosform = sanitizar($_POST);

$errovalidacao = false;

// Grava Dados
$login     = $dadosform['login'];
$nome      = $dadosform['nome'];
$senha     = $dadosform['senha'];
$email     = $dadosform['email'];
$permissao = $dadosform['permissao'];

if (empty($nome)) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroNome'] = 'Campo Obrigatorio';
    $errovalidacao = true;
}


if (empty($senha)) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroSenha'] = 'Campo Obrigatorio'; 
    $errovalidacao = true;
}


if (empty($email)) {

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroEmail'] = 'Campo Obrigatorio';
    $errovalidacao = true;

} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroEmail'] = 'É Obrigatorio ter user@email.com'; 
    $errovalidacao = true;
}
if ($permissao == 'Selecione') {

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroPermissao'] = 'É necessário atribuir um tipo de Permissão.';
    $errovalidacao = true;
}



// Conectar Com o BD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudproduto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (empty($login)) {

    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroLogin'] = 'Campo obrigatorio';
    $errovalidacao = true;

} else {

        $loginEscapado = $conn->real_escape_string($login);

        $sql = "SELECT * FROM usuario WHERE login = '$loginEscapado'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Login já existente</div>';
            $_SESSION['erroLogin'] = 'Login já existente.';
            $errovalidacao = true;

            unset($dadosform['login']);
        }
}



if ($errovalidacao) {
    $_SESSION['form'] = $dadosform;
    header("Location:cadastrarUsuarios.php");
    die(); 
}


$sql = "INSERT INTO usuario(login, nome, senha, email, permissao) VALUES('$login','$nome','$senha','$email','$permissao')";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) == 1) {
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Usuário Cadastrado com Sucesso.</div>';
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar Usuário no Banco!</div>';
    die();
}

$conn->close();
header("Location:listarUsuarios.php");
