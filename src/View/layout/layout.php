<html lang="pl">
<head>
    <title><?= $model->title ?></title>
    <?= $this->requireTemplate("layout/css", $model) ?>
</head>
<body style="height: 100%;padding-bottom: 80px;">
<?= $this->requireTemplate("layout/header", $this->user)?>
<main class="container">
    <?=  $this->requireTemplate($model->view, $model) ?>
</main>
<?=  $this->requireTemplate('layout/footer', $model) ?>
<?=  $this->requireTemplate('layout/js', $model) ?>
</body>
</html>