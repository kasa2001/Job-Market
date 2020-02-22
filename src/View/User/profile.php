<section>
    <div class="row mt-5 mb-5">


        <div class="offset-md-2 col-10">
            <h1>Dane użytkownika</h1>
        </div>

        <div class="offset-md-2 col-md-2 text-right">
            Id:
        </div>
        <div class="col-8">
            <?= $model->user->id ?>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            Login:
        </div>
        <div class="col-8">
            <?= $model->user->login ?>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            First Name:
        </div>
        <div class="col-8">
            <?= $model->user->firstName ?>
        </div>
        <div class="offset-md-2 col-md-2 text-right">
            Last Name:
        </div>
        <div class="col-8">
            <?= $model->user->lastName ?>
        </div>


    </div>
</section>