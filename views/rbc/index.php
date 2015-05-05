<?php
/* @var $this yii\web\View */

?>
<?= $this->render('/layouts/modals/delete', ['btn' => [
    'label' => '<i class="glyphicon glyphicon-remove"></i>',
], 'url' => ['site/index']]);
?>
