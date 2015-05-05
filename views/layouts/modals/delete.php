<?php
/* @var array $btn */
/* @var array $url */
use yii\bootstrap\Modal;
use yii\helpers\Html;

Modal::begin([
    'header' => '<h3 style="color: #b81900">Sure you want to delete ? </h3>',
    'toggleButton' => $btn,
    'footer' => Html::a('borrar', $url, ['class' => 'btn btn-warning']) .
        Html::button('cancel', ['data-dismiss' => 'modal', 'class' => 'btn btn-default'])
]); ?>
    <h3>The information will be permanently deleted</h3>
<?php
Modal::end();