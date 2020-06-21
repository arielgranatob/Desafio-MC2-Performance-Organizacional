<div class="container">
  <div class="row">
    <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <hr>
        <?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <form class="" action="/profile" method="post">
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
        </form>
      </div>
    </div>
  </div>
</div>