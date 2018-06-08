<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

print_r(Yii::$app->user->identity);

if (!$model->setdatabase) {
    $this->title = 'Login';
    $descrizione = 'Inserire le proprie credenziali di accesso:';
    
} else {
    $this->title = 'Selezione Database';
    $descrizione = 'Selezionare il proprio database:';
}

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::encode($descrizione) ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

<?php 
if (!$model->setdatabase) {
?>
        <?= $form->field($model, 'clientname')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-2 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-7\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

<?php 
} else {
?>

        <?= $form->field($model, 'database')->dropDownList($databases, ['prompt'=>'Seleziona...']) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('Seleziona', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?= $form->field($model, 'clientname')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'username')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'password')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'rememberMe')->hiddenInput()->label(false) ?>

<?php 
}
?>



    <?php ActiveForm::end(); ?>
</div>
