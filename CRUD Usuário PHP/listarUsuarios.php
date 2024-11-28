<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-2">Listagem de Usuários</h1>

    <?php 
    if (isset($_SESSION['msg'])) {
      echo $_SESSION["msg"];
      unset($_SESSION["msg"]);
    }
    ?>

    <?php

    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'crudproduto';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$conn) {
      die('Falha ao conectar com o MySQL: ' . mysqli_connect_error());
    }

    $sql = 'SELECT * FROM Usuario';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo '<div class="table-responsive">';
      echo '  <table class="table table-bordered table-hover table-sm">';
      echo '    <thead >';
      echo '      <tr class="table-info">';
      echo '        <th class="info">Login</th>';
      echo '        <th class="info">Nome</th>';
      echo '        <th class="info">Email</th>';
      echo '        <th class="info">Tipo de Permissão</th>';
      echo '        <th class="info"></th>';
      echo '      </tr>';
      echo '    </thead>';
      echo '    <tbody>';
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '  <td>' . $row['login'] . '</td>';
        echo '  <td>' . $row['nome'] . '</td>';
        echo '  <td>' . $row['email'] . '</td>';
        echo '  <td>' . $row['permissao'] . '</td>';
        //echo ' <td> <a href="editarUsuario.php?id=' . $row['login'] . '" class=" bi bi-pencil-fill btn btn-primary btn-sm">Editar</a>
          //    <a href="excluirUsuario.php?id=' . $row['login'] . '&nome=' . $row['nome'] . '" class="btn btn-danger btn-sm">Excluir</a></td>';
          echo '<td>
        <a href="editarUsuario.php?id=' . $row['login'] . '" class="btn btn-primary btn-sm">
            <i class="bi bi-pencil-fill"></i> Editar
        </a>
        <a href="excluirUsuario.php?id=' . $row['login'] . '&nome=' . $row['nome'] . '" class="btn btn-danger btn-sm">
        <i class="bi bi-trash"></i>
            Excluir
        </a>
      </td>';
          echo '</tr>';
      }
      echo '    </tbody>';
      echo '  </table>';
      echo '</div>';
    } else {
      echo "Nenhum Produto Encontrado.";
    }

    mysqli_close($conn);
    ?>

  </div>
</main>

<?php
require_once 'footer.php';
