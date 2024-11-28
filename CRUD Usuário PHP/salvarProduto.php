<?php

session_start();
include_once 'sanitizar.php';

$dadosform = sanitizar($_POST);

$errovalidacao = false;
if (empty($dadosform['preco'])) {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
  $_SESSION['erropreco'] = 'Este campo deve ser preemchido';
  $errovalidacao = true;
}

if (isset($_SESSION['form'])) {
  unset($_SESSION['form']);
}

if ($errovalidacao) {
  $_SESSION['form'] = $dadosform;
  header("Location:cadastrarProdutos.php");
  die();
}

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';
 
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

$conn->set_charset("utf8");

$nome = $dadosform["nome"];
$descricao = $dadosform["descricao"];
$preco = $dadosform["preco"];
$quantidade = $dadosform["quantidade"];

$sql = "INSERT INTO Produto(nome,descricao,preco,quantidade) VALUES('$nome','$descricao','$preco','$quantidade')";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) == 1) {
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto Cadastrado com Sucesso.</div>';
} else {
  $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar Produto no Banco!</div>';
}

$conn->close();


header("Location:listarProdutos.php");