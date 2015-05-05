<?php
/** @var $optometria \app\models\optometria\Optometria */

/** @var $this \yii\web\View */
?>
<?php /** @var \app\models\optometria\OptRetinoscopia $model */
/** @var \yii\bootstrap\Tabs $tab */
$tab = \yii\bootstrap\Tabs::begin();
foreach ($optometria->optRetinoscopias as $key => $model): ?>
    <?php $tab->items[] = [
        'label' => ucwords($model->tipo),
        'content' => $this->render('retinoscopia/v_retinoscopia', [
            'model' => $model
        ])
    ] ?>
<?php endforeach ?>
<?php /*$tab->items[] = [
            'label'=>'agregar',
            'content'=>
                Html::beginTag('div',['class'=>'panel panel-default']) .
                Html::beginTag('div',['class'=>'panel-body']) .
                Html::beginTag('div',['class'=>'col-md-6']) .
                Html::beginForm(['add','id'=>$optometria->id,'model'=>'retinoscopia']) .
                Html::beginTag('div',['class'=>'form-group']) .
                Html::label('Nombre','tipo') .
                Html::textInput('tipo',null,['class'=>'form-control','id'=>'tipo']) .
                Html::endTag('div') .
                Html::button('Agregar',['type'=>'submit','class'=>'btn btn-info btn-sm']) .
                Html::endForm() .
                Html::endTag('div') .
                Html::endTag('div') .
                Html::endTag('div')
        ]*/
?>
<?php $tab->end() ?>
