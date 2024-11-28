<?php
session_start();
include_once 'sanitizar.php';


$dadosform = sanitizar($_POST);
$loginUsuario = $dadosform['login'];

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error); // Mensagem de erro ao conectar com o banco
}

$sql = "DELETE FROM usuario WHERE login = '{$loginUsuario}'";

$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) != 0) {
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Usuário Excluído com Sucesso.</div>';
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Excluir Usuário no Banco!</div>';
}
$conn->close();

header("Location:listarUsuarios.php");
