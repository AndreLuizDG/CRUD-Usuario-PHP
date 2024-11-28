<?php
session_start();
include_once 'sanitizar.php';

$dados = sanitizar($_GET);
$idproduto = $dados['id'];

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

$sql = "SELECT * FROM Produto WHERE id={$idproduto}";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) != 1) {
  die('Produto não encontrado');
}

$produto = mysqli_fetch_assoc($result);


$_SESSION['form'] = $produto;
header("Location:editarProdutoForm.php");


$conn->close();
