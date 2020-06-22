<!doctype html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="/assets/images/ico.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/dashboard.css" rel="stylesheet">
  <title>Alterar dados</title>
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>

  <!-- sidebar -->
  <div class="container">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <ul class="nav flex-column mb-2">
          <div class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Início</span>
          </div>
          <li class="nav-item">
            <a class="nav-link" href="/tarefa">
              <span data-feather="log-out"></span>
              Tarefas
            </a>
          </li>
        </ul>
        <div class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Meus dados</span>
        </div>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="/users/profile">
              <span data-feather="user"></span>
              Perfil (<b><?= session()->get('loginUsuario') ?></b>)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/users/logout">
              <span data-feather="log-out"></span>
              Sair
            </a>
          </li>
        </ul>
      </nav>
      <!-- descricao -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div class="row">
          <div class="col-12">
            <h6 style="margin-bottom:30px;margin-top:30px;">Atualização de dados</h6>
          </div>
          <form action="/profile" method="post">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="login">Login</label>
                  <input type="text" class="form-control" name="loginUsuario" id="loginUsuario" value="<?= session()->get('loginUsuario') ?>">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" name="senhaUsuario" id="senhaUsuario" value="">
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="senha_confirm">Repita a senha</label>
                  <input type="password" class="form-control" name="senha_confirm" id="senha_confirm" value="">
                </div>
              </div>
              <?php if (isset($validation)) : ?>
                <div class="col-12">
                  <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
            <div class="row">
              <div class="col-12 col-sm-4">
                <button type="submit" class="btn btn-primary">Atualizar</button>
              </div>
            </div>
            <?php if (session()->get('success')) : ?>
              <div class="alert alert-success" role="alert">
                <?= session()->get('success') ?>
              </div>
            <?php endif; ?>
          </form>
        </div>
    </div>
    </main>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>