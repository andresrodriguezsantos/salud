<?php
/**
 * @var $this \yii\web\View
 * @var $certificado \app\models\Certificado
 */
use app\models\Areasalud;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

$data = Areasalud::find()
    ->select(['id as value', 'nombre as label'])
    ->asArray()
    ->all();
?>

<div class="col-md-12">
    <div class="box box-solid">
        <div class="box-header">
            <i class="glyphicon glyphicon-"></i>

            <h3 class="box-title" style="text-align: center; color: #04ccfe"> SOLICITUD DE EXAMENES CLINICOS
                <?php
                $text = strtoupper(Yii::$app->request->get('tipo'));
                ($text == 'EXAMEN') ? $text = '' : $text;
                echo $text;
                ?>
            </h3>
        </div>
        <div class="box-body" style="overflow: hidden">
            <div class="col-md-6">
                <label>Filtro de Areas de Salud</label>
                <?= AutoComplete::widget([
                    'name' => 'nombre',
                    'value' => '',
                    'clientOptions' => [
                        'source' => $data,
                        'select' => new JsExpression('
                    function(event,ui){
                        $.setFilt(ui.item.value);
                        $(this).val(ui.item.label);
                        return false;
                    }
                ')
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ]
                ])
                ?>
            </div>
            <div class="col-md-6">
                <?= \yii\helpers\Html::label('Filtre un examen', 'certifi') ?>
                <?= \yii\helpers\Html::input('text', 'certificado', null, [
                    'id' => 'certifi',
                    'autocomplete' => 'off',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-md-12">

                <ol id="examenes">
                </ol>

                <?= \yii\helpers\Html::label('Observación', \yii\helpers\Html::getInputId($certificado, 'campos[Observación]')) ?>
                <?= $form->field($certificado, 'campos[Observación]')->label(false)->textarea() ?>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('@web/js/certificados.js', [
    'depends' => [\yii\web\JqueryAsset::className()],
    'position' => \yii\web\View::POS_END,
]) ?>