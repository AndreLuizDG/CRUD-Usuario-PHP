<?php
session_start();
require_once 'header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h1 class="mt-2">Editar Usuários</h1>
        <?php           
        if (isset($_SESSION['msg'])) {
          echo $_SESSION["msg"];
          unset($_SESSION["msg"]);
        }
        ?>

        <form action="editarUsuarioSalvar.php" method="post" id="formEditarProduto">

          <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control <?php if (isset($_SESSION["erroLogin"])) echo 'is-invalid'; ?>"
              name="login" value="<?php if (isset($_SESSION["form"]["login"])) echo $_SESSION["form"]["login"]; ?>"
              readonly>
            <div class="invalid-feedback">
              <?php echo $_SESSION["erroLogin"];
              unset($_SESSION["erroLogin"]); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="Nome Completo" class="col-form-label">Nome Completo</label>
            <input type="text" class="form-control" name="nome" id="nome"
              value="<?php if (isset($_SESSION["form"]["nome"])) echo $_SESSION["form"]["nome"]; ?>" required>
            <div class="invalid-feedback">
              <?php echo $_SESSION["errosenha"];
              unset($_SESSION["errosenha"]); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control <?php if (isset($_SESSION["errosenha"])) echo 'is-invalid'; ?>"
              name="senha" value="<?php if (isset($_SESSION["form"]["senha"])) echo $_SESSION["form"]["senha"]; ?>">
            <div class="invalid-feedback">
              <?php echo $_SESSION["errosenha"];
              unset($_SESSION["errosenha"]); ?>
            </div>
          </div>

          <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" class="form-control <?php if (isset($_SESSION["erroEmail"])) echo 'is-invalid'; ?>"
              name="email" value="<?php if (isset($_SESSION["form"]["email"])) echo $_SESSION["form"]["email"]; ?>">
            <div class="invalid-feedback">
              <?php echo $_SESSION["erroEmail"];
              unset($_SESSION["erroEmail"]); ?>
            </div>
          </div>

          <div class="form-group">
            <label class="permissao" for="permissao">Nível de Acesso</label> <br>
            <select class="form-control <?php if (isset($_SESSION["erroPermissao"])) echo 'is-invalid'; ?>"
              name="permissao" id="permissao">
              <option value="Selecione"
                hidden>Selecione</option>
              <option value="Admin">
                Administrador</option>
              <option value="Normal">
                Normal</option>
              <option value="Leitura">
                Somente Leitura</option>
            </select>
            <div class="invalid-feedback">
              <?php echo isset($_SESSION["erroPermissao"]) ? $_SESSION["erroPermissao"] : ''; ?>
              <?php unset($_SESSION["erroPermissao"]); ?>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-success">Salvar</button>
        </form>
        <?php unset($_SESSION['form']); ?>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>

<?php
require_once 'footer.php';
