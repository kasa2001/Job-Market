<div class="mt-5 mb-5">
    <h1>Umiejętności</h1>

    <?php foreach ($model->list as $skill): ?>
        <div class="row">
            <hr class="border-bottom col-12 border-dark"/>
            <div class="offset-md-2 col-md-2 text-right">
                Id:
            </div>
            <div class="col-8">
                <?= $skill->id ?>
            </div>
            <div class="offset-md-2 col-md-2 text-right">
                Name:
            </div>
            <div class="col-8">
                <?= $skill->name ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
