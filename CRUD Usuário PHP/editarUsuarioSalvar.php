<?php

session_start();
include_once 'sanitizar.php';


$dadosform = sanitizar($_POST);
$errovalidacao = false;

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
    $_SESSION['errosenha'] = 'Campo Obrigatorio';
    $errovalidacao = true;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errovalidacao = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroEmail'] = 'Este campo deve conter: user@email.com';
}

if ($permissao == 'Selecione') {
    $errovalidacao = true;
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Preencha os Campos Obrigatorios.</div>';
    $_SESSION['erroPermissao'] = 'É necessário selecionar um Tipo de Permissão.';
}

if ($errovalidacao) {
    $_SESSION['form'] = $dadosform;
    header("Location:editarUsuarioSalvar.php");
    die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudproduto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$login = $dadosform["login"];
$nome = $dadosform["nome"];
$senha = $dadosform["senha"];
$email = $dadosform["email"];
$permissao = $dadosform["permissao"];

$sql = "UPDATE Usuario SET login='" . $dadosform["login"] . "',nome='" . $dadosform["nome"] . "',senha='" . $dadosform["senha"] . "',email='" . $dadosform["email"] . "', permissao='" . $dadosform["permissao"] . "' WHERE login='" . $dadosform["login"] . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) == 1) {
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Usuário Editado com Sucesso.</div>';
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Editar Usuário no Banco!</div>';
    die();
}

$conn->close();



header("Location:listarUsuarios.php");
