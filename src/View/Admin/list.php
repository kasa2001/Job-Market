<div class="mt-5 mb-5">
    <h1>Użytkownicy w systemie</h1>

    <?php foreach ($model->users as $user): ?>
        <div class="row">
            <hr class="border-bottom col-12 border-dark"/>
            <div class="offset-md-2 col-md-2 text-right">
                Id:
            </div>
            <div class="col-8">
                <?= $user->id ?>
            </div>
            <div class="offset-md-2 col-md-2 text-right">
                Login:
            </div>
            <div class="col-8">
                <?= $user->login ?>
            </div>
            <div class="offset-md-2 col-md-2 text-right">
                First Name:
            </div>
            <div class="col-8">
                <?= $user->firstName ?>
            </div>
            <div class="offset-md-2 col-md-2 text-right">
                Last Name:
            </div>
            <div class="col-8">
                <?= $user->lastName ?>
            </div>
            <div class="offset-md-4 col-md-2 col-12">
                <a href="/profile/<?= $user->id ?>" class="btn btn-warning">Szczegóły</a>
                <?php if ($this->hasRole('ROLE_ADMIN')): ?>
                    <button class="btn btn-success js-add-role-user">Administrator</button>
                <?php endif; ?>
                <button id="<?= $user->id ?>" class="btn btn-danger js-remove-user">Usuń</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
