<?php
session_start();
include_once 'sanitizar.php';

$dados = sanitizar($_GET);
$loginUsuario = $dados['id'];

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = '';
$dbname = 'crudproduto';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
  die('Falha ao conectar com o MySQL: ' . $conn->connect_error);
}

$sql = "SELECT * FROM Usuario WHERE login = '{$loginUsuario}'";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) != 1) {
  die('Falha ao recuperar dados do Usuario');
}

$usuario = mysqli_fetch_assoc($result);

$_SESSION['form'] = $usuario;

$conn->close();

header("Location:editarUsuarioForm.php");