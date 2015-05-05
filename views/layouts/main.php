<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
    <?php
    NavBar::begin([
        'brandLabel' => Html::img(\yii\helpers\Url::base() . '/img/logo.jpg', ['style' => 'width: 350px;', 'class' => 'img-thumbnail']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-static-top',
        ],
        'containerOptions' => [
            'style' => 'min-height: 65px;'
        ]
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right pull-right', 'style' => 'margin-top: 2%;'],
        'items' => [
            Yii::$app->user->can('Profesional') ?
                ['label' => 'Inicio', 'url' => ['/profesional/home']] : '',
            Yii::$app->user->can('Paciente') ?
                ['label' => 'Inicio', 'url' => ['/paciente/home']] : '',
            Yii::$app->user->can('LabGerente') ?
                ['label' => 'Inicio', 'url' => ['/laboratorio/home']] : '',
            Yii::$app->user->isGuest ?
                ['label' => 'inicio', 'url' => ['/site/index']] : '',
            Yii::$app->user->isGuest ?
                ['label' => '¿quienes somos?', 'url' => ['/site/about']] : '',
            Yii::$app->user->isGuest ?
                ['label' => 'patrocinadores', 'url' => ['/site/construccion']] : '',
            Yii::$app->user->isGuest ?
                ['label' => 'noticias', 'url' => ['/site/noticias']] : '',
            Yii::$app->user->isGuest ?
                ['label' => 'contactenos', 'url' => ['/site/contact']] : '',

            Yii::$app->user->can('LabGerente') ?
                [
                    'label' => 'Perfil del Laboratorio', 'items' => [
                    ['label' => 'Mi perfil', 'url' => ['/laboratorio/admin/actualizarlaboratorio']],
                ],
                ] : '',
            Yii::$app->user->can('LabGerente') ?
                [
                    'label' => 'Medicamentos', 'items' => [
                    // ['label'=>'Perfil del Laboratorio','url'=>['/laboratorio/admin/actualizarlaboratorio']],
                    ['label' => 'Registrar Medicamento', 'url' => ['/medicamento/admin']],
                    // ['label'=>'Agregar Sedes','url'=>['/laboratorio/admin/buscar']],
                    ['label' => 'Registrar Presentaciones', 'url' => ['/medicamento/admin/registrarpresentacion']],
                ],
                ] : '',
            Yii::$app->user->can('LabGerente') ? [
                'label' => 'Registro de Sedes', 'items' => [
                    ['label' => 'Agregar Sedes', 'url' => ['/laboratorio/admin/buscar']],
                ]
            ] : '',

            Yii::$app->user->can('Optometra') ?
                ['label' => 'Pacientes', 'items' => [
                    ['label' => 'Nueva Historia Clinica', 'url' => ['/optometria/main/list']],
                    /*['label' => 'Mis Pacientes', 'url' => ['/optometria/main/list']],*/
                    ['label' => 'Registrar Paciente', 'url' => ['/paciente/home/registrar']],
                ]] : '',
            Yii::$app->user->can('Optometra') ?
                ['label' => 'Estadisticas', 'items' => [
                    ['label' => 'Reportes de Diagnóstico', 'url' => ['/profesional/home']],
                ]] : '',
            Yii::$app->user->can('Administrador') ?
                [
                    'label' => 'administracion', 'items' => [
                    ['label' => 'Reg. Area de Salud', 'url' => ['/administracion/areasalud']],
                    ['label' => 'Registrar Clinica', 'url' => ['/administracion/clinicas']],
                    ['label' => 'Reg. Codigo Cie', 'url' => ['/administracion/codigocie']],
                    ['label' => 'Reg. Examenes', 'url' => ['/administracion/examenes']],
                    ['label' => 'Registrar Profesión', 'url' => ['/administracion/profesion']],
                    ['label' => 'Reg. tipo de documento', 'url' => ['/administracion/tdocumento']],
                    ['label' => 'Reg. tipos y subtipos Terapeuticos', 'url' => ['/administracion/medicamento']],
                ]] : '',
            Yii::$app->user->can('Administrador') ?
                [
                    'label' => 'Administrar noticias', 'items' => [
                    ['label' => 'Crear Noticias', 'url' => ['/administracion/noticias']],
                    ['label' => 'Listado de Noticias', 'url' => ['/administracion/noticias/admin']],
                ]] : '',
            Yii::$app->user->can('Paciente') ?
                [
                    'label' => 'Historia Clinica', 'url' => ['/paciente/home/historia', 'id' => Yii::$app->user->identity->paciente->id]
                ] : '',
            Yii::$app->user->can('Paciente') || Yii::$app->user->can('Profesional') ?

                [
                    'label' => Yii::$app->user->can('Paciente') ? 'Perfil del Paciente' : 'Perfil Profesional', 'items' => [
                    Yii::$app->user->can('Paciente') ?
                        ['label' => 'Mi perfil', 'url' => ['/paciente/perfil']] : '',
                    Yii::$app->user->can('Profesional') ?
                        ['label' => 'Mi perfil', 'url' => ['/profesional/perfil']] : ''
                ]] : '',

            Yii::$app->user->isGuest ?
                ['label' => 'Ingresar', 'url' => ['/site/login']] :
                ['label' => 'Salir (' . Yii::$app->user->identity->nombres . ')',
                    'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
    NavBar::end();
    ?>

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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ClinikBox <?= date('Y') ?></p>

        <p class="pull-right">By GreenSoftw</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
