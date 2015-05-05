<?php
/* @var array $btn */
/* @var array $url */
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h2 style="color: #8EC4EC">Welcome , thank you for joining our platform</h2>',
    'options' => [],
    'footer' => Html::button('Close', ['data-dismiss' => 'modal', 'class' => 'btn btn-success '])
]); ?>
    <h3 style="color: #8EC4EC" align="center">Enjoy the multiples beneficies we have for you</h3>
    <i></i>
<?php
Modal::end();
