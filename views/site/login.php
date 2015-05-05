<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

?>

<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <!--<div>
                    <? /*= Html::img(\yii\helpers\Url::base() . '/img/logo.jpg',[],false) */ ?>
                </div>-->

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>
                <h4> Cuenta Clinikbox <?= Html::a('¿ Que es esto ?', '') ?></h4>
                <br/>
                <?= $form->field($model, 'username')->label(false)->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                <?= $form->field($model, 'password')->passwordInput()->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="row">
                    <div class="col-md-12">
                        <?= Html::submitButton('Ingresar', ['class' => 'btn btn-info btn-lg btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div class="col-md-12">
                    <br/>
                    <?= Html::a('¿No puedes acceder a tu cuenta?', '') ?>
                    <br/>
                    <?= Html::a('Inicia sesion con un codigo de un solo uso', '') ?>
                    <br/>
                    <h4>¿No dispones de una cuenta Medikbox ? <br/><br/><?= Html::a('Registrate ahora', ['registro']) ?>
                    </h4>
                </div>
            </div>
            <div class="col-md-8">

                <?= Html::img(\yii\helpers\Url::base() . '/img/opt2.jpg', ['class' => 'img-responsive']) ?>

            </div>
            <div class="col-md-12">
                <br/>
                <label for="" style="text-align: justify">Acceso a historias clínicas, diagnósticos y tratamientos en su
                    dispositivo movil, tablets
                    o computador, en cualquier lugar, en todo momento, en tiempo real. <br> El seguimineto de sus casos
                    clinicos y tratamientos,
                    integrados en un solo sitio; una experiencia diferente; informacion agil es mejor conocimiento de
                    salud, <br> es mejor calidad de vida
                </label>
            </div>
        </div>
    </div>
</div>


