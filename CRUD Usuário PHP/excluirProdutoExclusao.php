<?php
session_start();
include_once 'sanitizar.php';

$dadosform = sanitizar($_POST);
$idproduto = $dadosform['id'];

if (!is_numeric($idproduto)) {
  die("Id do produto não é numérico!");
}

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';


$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

$sql = "DELETE FROM Produto WHERE id='{$idproduto}'";

$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) != 0) {
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto Excluído com Sucesso.</div>';
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao Excluir Produto no Banco!</div>';
}
$conn->close();


header("Location:listarProdutos.php");
