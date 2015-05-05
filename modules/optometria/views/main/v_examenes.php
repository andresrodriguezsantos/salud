<?php
/** @var $optometria \app\models\optometria\Optometria */
/** @var $this \yii\web\View */

?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php $tab = \yii\bootstrap\Tabs::begin(); ?>
        <?php foreach ($optometria->optExamenexterno as $key => $model): ?>
            <?php $tab->items[] = [
                'label' => ucwords($model->tipo),
                'content' => $this->render('examenexterno/v_examen', [
                    'model' => $model,
                ])
            ] ?>
        <?php endforeach ?>
        <?php /*$tab->items[] = [
            'label'=>'Agregar',
            'content'=>
                Html::beginTag('div',['class'=>'panel panel-default']) .
                Html::beginTag('div',['class'=>'panel-body']) .
                Html::beginTag('div',['class'=>'col-md-6']) .
                Html::beginForm(['add','id'=>$optometria->id,'model'=>'examenexterno']) .
                Html::beginTag('div',['class'=>'form-group']).
                Html::label('Nombre','tipo') .
                Html::textInput('tipo',null,['class'=>'form-control','id'=>'tipo']) .
                Html::endTag('div') .
                Html::button('Agregar',['type'=>'submit','class'=>'btn btn-info btn-sm']) .
                Html::endForm() .
                Html::endTag('div') .
                Html::endTag('div') .
                Html::endTag('div')
        ]*/ ?>
        <?php $tab->end() ?>
    </div>
</div>
