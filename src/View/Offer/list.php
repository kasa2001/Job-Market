<div class="mt-5 mb-5">
    <h1>Oferty</h1>

    <?php foreach ($model->categoryList as $category): ?>
        <a href="/category/list/<?= $category->name ?>" class="btn btn-success">
            <?= $category->name ?>
        </a>
    <?php endforeach; ?>
    <form  method="GET" class="form-horizontal" role="form" novalidate="novalidate">
        <hr>
        <div class="form-group row">
            <label class="col-md-3 col-12 control-label" for="description">Description</label>
            <div class="col-md-6 col-12">
                <input class="form-control" type="text" id="description" name="description" />
            </div>
            <div class="col-md-3  col-12">
                <button type="submit" class="btn btn-block btn-success">Szukaj oferty</button>
            </div>
        </div>
    </form>
    <?php foreach ($model->list as $offer): ?>
        <div class="row">
            <hr class="border-bottom col-12 border-dark"/>
            <div class="offset-md-2 col-md-2 text-right">
                Id:
            </div>
            <div class="col-8">
                <?= $offer->id ?>
            </div>
            <div class="offset-md-2 col-md-2 text-right">
                Description:
            </div>
            <div class="col-8">
                <?= $offer->description ?>
            </div>
            <div class="offset-md-2 col-md-2 text-right">
                Active:
            </div>
            <div class="col-8">
                <?= $offer->active ? "Yes": "No" ?>
            </div>
            <div class="offset-md-4 col-md-2 col-12">
                <a href="/offerDetails/<?= $offer->id ?>" class="btn btn-warning">Szczegóły</a>
                <button id="<?= $offer->id ?>" class="btn btn-danger js-activate-offer"><?= $offer->active ? "Dezaktywuj": "Aktywuj" ?></button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
