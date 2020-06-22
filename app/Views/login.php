<!doctype html>
<html lang="pt_BR">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="/assets/images/ico.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
        <div class="container">
          <h3>Login</h3>
          <hr>
          <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
              <?= session()->get('success') ?>
            </div>
          <?php endif; ?>
          <form action="/" method="post">
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" class="form-control" name="login" id="login" value="<?= set_value('login') ?>">
            </div>
            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" class="form-control" name="senha" id="senha">
            </div>
            <?php if (isset($validation)) : ?>
              <div class="col-12">
                <div class="alert alert-danger" role="alert">
                  <?= $validation->listErrors() ?>
                </div>
              </div>
            <?php endif; ?>
            <div class="row">
              <div class="col-12 col-sm-4">
                <button type="submit" class="btn btn-primary">Entrar</button>
              </div>
              <div class="col-12 col-sm-8 text-right">
                <a href="/register">Não possui uma conta? Clique aqui para criar</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>