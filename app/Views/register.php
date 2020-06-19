<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Novo usuário</h3>
        <hr>
        <form action="/register" method="post">
          <div class="row">           
            <div class="col-12">
              <div class="form-group">
               <label for="login">Login</label>
               <input type="text" class="form-control" name="login" id="login" value="<?= set_value('login') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="senha">Senha</label>
               <input type="password" class="form-control" name="senha" id="senha" value="">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="senha_confirm">Repita a senha</label>
              <input type="password" class="form-control" name="senha_confirm" id="senha_confirm" value="">
            </div>
          </div>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            <div class="col-12 col-sm-8 text-right">
              <a href="/">Já possuo uma conta</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
