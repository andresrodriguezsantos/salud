<?php
/** @var $this \yii\web\View */
/** @var $agudezavisual \app\models\optometria\OptAgudezavisual */
/** @var $agudezavisualconcorreccion \app\models\optometria\OptAgudezavisualConcorreccion */
/** @var $agudezavisualconph \app\models\optometria\OptAgudezavisualConph */
/** @var $agudezavisualsincorreccion \app\models\optometria\OptAgudezavisualSincorreccion */
/** @var \yii\bootstrap\ActiveForm $form */
/** @var $optometria \app\models\optometria\Optometria */

?>
<?= \yii\bootstrap\Tabs::widget([
    'items' => [
        [
            'label' => 'Agudeza Visual Sin Corrección',
            'content' => $this->render('agudezavisual/sincorreccion', ['sincorreccion' => $agudezavisualsincorreccion, 'form' => $form, 'optometria' => $optometria])
        ],
        [
            'label' => 'Agudeza Visual Con Correción',
            'content' => $this->render('agudezavisual/concorreccion', ['concorreccion' => $agudezavisualconcorreccion, 'form' => $form, 'optometria' => $optometria])
        ],
        [
            'label' => 'Agudeza Visual Con Pin Hole',
            'content' => $this->render('agudezavisual/conph', ['conph' => $agudezavisualconph, 'form' => $form, 'optometria' => $optometria])
        ],
    ],
    'options' => [
        'class' => 'nav-justified'
    ]
]) ?>
