<div class="row">
    <div class="offset-4 col-4 mt-4">
        <section>
            <h2>Zaloguj się</h2>
            <form  method="post" class="form-horizontal" role="form" action="/login" novalidate="novalidate">
                <hr>
                <?php if (!empty($model->errorMessage)): ?>
                <div class="text-danger validation-summary-valid" data-valmsg-summary="true">
                    <?= $model->errorMessage ?>
                </div>
                <?php endif; ?>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="Login">Login</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" data-val="true" data-val-required="The Email field is required." id="login" name="login" value="">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Login" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" for="Password">Hasło</label>
                    <div class="col-md-10">
                        <input class="form-control" type="password" data-val="true" data-val-required="The Hasło field is required." id="password" name="password">
                        <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-2 col-md-10">
                        <button type="submit" class="btn btn-block btn-success">Zaloguj</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>