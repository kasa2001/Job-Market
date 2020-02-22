<div class="row">
    <div class="offset-3 col-md-5 col-12 mt-4">
        <section>
            <h2>Dodaj umiejętność</h2>
            <form  method="post" class="form-horizontal" role="form" action="/addSkill" novalidate="novalidate">
                <hr>
                <?php if (!empty($model->errorMessage)): ?>
                    <div class="text-danger validation-summary-valid">
                        <?= $model->errorMessage ?>
                    </div>
                <?php endif; ?>
                <div class="form-group row">
                    <label class="col-md-3 col-12 control-label" for="name">Name</label>
                    <div class="col-md-9 col-12">
                        <input class="form-control" type="text" id="name" name="name" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-2 col-md-10">
                        <button type="submit" class="btn btn-block btn-success">Dodaj umiejętność</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>