<div class="row">
    <div class="offset-3 col-6 mt-4">
        <section>
            <h2>Zarejestruj się</h2>
            <form method="post" class="form-horizontal" role="form" action="/registry" novalidate="novalidate">
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="login">Login</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="login" name="login"
                               value="<?= $model->user->login ?>"/>
                    </div>
                    <?php if (!empty($model->errorMessage['login'])): ?>
                    <div class="col-10 offset-2">
                        <span class="text-danger field-validation-error">
                            <span id="Login-error" class=""><?= $model->errorMessage['login'] ?></span>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="password">Hasło</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" id="password" name="password"/>
                    </div>
                    <?php if (!empty($model->errorMessage['password'])): ?>
                        <div class="col-10 offset-2">
                        <span class="text-danger field-validation-error">
                            <span id="Login-error" class=""><?= $model->errorMessage['password'] ?></span>
                        </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="first_name">Imię</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="first_name" name="first_name"
                               value="<?= $model->user->firstName ?>"/>
                    </div>
                    <?php if (!empty($model->errorMessage['first_name'])): ?>
                        <div class="col-10 offset-2">
                        <span class="text-danger field-validation-error">
                            <span id="Login-error" class=""><?= $model->errorMessage['first_name'] ?></span>
                        </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="last_name">Nazwisko</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" id="last_name" name="last_name"
                               value="<?= $model->user->lastName ?>"/>
                    </div>
                    <?php if (!empty($model->errorMessage['last_name'])): ?>
                        <div class="col-10 offset-2">
                        <span class="text-danger field-validation-error">
                            <span id="Login-error" class=""><?= $model->errorMessage['last_name'] ?></span>
                        </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group row">
                    <div class="offset-2 col-md-10">
                        <button type="submit" class="btn btn-block btn-success">Zarejestruj się</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>