<?php
session_start();
include_once 'sanitizar.php';

$dados = sanitizar($_GET); 
$idproduto = $dados['id'];
if (!is_numeric($idproduto)) {
  die("Id do produto não é numérico!");
}

$_SESSION['form'] = $dados;
header("Location:excluirProdutoForm.php");
