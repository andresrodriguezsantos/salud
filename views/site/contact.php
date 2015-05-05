<?php
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contactenos';
?>
<div class="col-md-12">
    <div class="box-header">
        <h3 class="box-title">CONTACTENOS</h3>
    </div>
    <div class="box-body">
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

            <div class="alert alert-success">
                Gracias por contactarnos. Nosotros responderemos a la mayor brevedad posible.
            </div>

            <p>
                Note that if you turn on the Yii debugger, you should be able
                to view the mail message on the mail panel of the debugger.
                <?php if (Yii::$app->mailer->useFileTransport): ?>
                    Because the application is in development mode, the email is not sent but saved as
                    a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                                                                                                        Please configure the
                    <code>useFileTransport</code> property of the <code>mail</code>
                    application component to be false to enable email sending.
                <?php endif; ?>
            </p>

        <?php else: ?>

            <p>
                Si tiene consultas, inquietudes u otras preguntas , por favor , diligencie el siguiente formulario para
                contactar con nosotros. Gracias.
            </p>

            <div class="row">
                <div class="col-md12">
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="col-md-3">
                        <?= $form->field($model, 'name') ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'subject') ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                    </div>
                    <div class=" col-md-6">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <br/>
                            <?= Html::submitButton('enviar', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>