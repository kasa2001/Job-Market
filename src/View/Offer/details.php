<section>
    <div class="row mt-5 mb-5">


        <div class="offset-md-2 col-10">
            <h1>Dane oferty</h1>
        </div>

        <div class="offset-md-2 col-md-2 text-right">
            Id:
        </div>
        <div class="col-8">
            <?= $model->offer->id ?>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            Description:
        </div>
        <div class="col-8">
            <?= $model->offer->description ?>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            Active:
        </div>
        <div class="col-8">
            <?= $model->offer->active ? "Yes": "No" ?>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            Skills:
        </div>
        <div class="col-8">
            <?php foreach ($model->skillList as $skill): ?>
            <li>
                <?= $skill->name ?>
            </li>
            <?php endforeach; ?>
        </div>
    </div>
</section>