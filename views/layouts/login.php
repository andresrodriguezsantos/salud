<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
        body {
            background-color: #ffffff;
        }
    </style>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div>
            <?php if (($msm = Yii::$app->session->getAllFlashes()) !== null): ?>
                <?php foreach ($msm as $type => $menssage): ?>
                    <div class="alert alert-<?php echo $type ?> fade in">
                        <button data-dismiss="alert" class="close" type="button">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button><?php echo $menssage ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
