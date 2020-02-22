<div class="row">
    <div class="offset-3 col-md-5 col-12 mt-4">
        <section>
            <h2>Dodaj ofertę</h2>
            <form  method="post" class="form-horizontal" role="form" action="/addOffer" novalidate="novalidate">
                <hr>
                <?php if (!empty($model->errorMessage)): ?>
                    <div class="text-danger validation-summary-valid" data-valmsg-summary="true">
                        <?= $model->errorMessage ?>
                    </div>
                <?php endif; ?>
                <div class="form-group row">
                    <label class="col-md-3 col-12 control-label" for="description">Description</label>
                    <div class="col-md-9 col-12">
                        <textarea class="form-control" type="text" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-12 control-label" for="description">Category</label>
                    <div class="col-md-9 col-12">
                        <select name="category_id">
                            <?php foreach ($model->categoryList as $category): ?>
                            <option value="<?= $category->id ?>">
                                <?= $category->name ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <?php foreach ($model->skillList as $skill): ?>
                    <div class="checkbox" style="left:25px;">
                        <input id="<?= $skill->name . $skill->id ?>" type="checkbox" value="<?= $skill->id ?>" name="skills[]">
                        <label for="<?= $skill->name . $skill->id ?>"><?= $skill->name?></label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="form-group row">
                    <div class="offset-2 col-md-10">
                        <button type="submit" class="btn btn-block btn-success">Dodaj ofertę</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>