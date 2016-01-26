<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use backend\assets\AppAsset;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->registerCssFile("@web/css/signin.css", [
    'depends' => [AppAsset::className()],
]);
?>
<?php $form = ActiveForm::begin(['id' => 'login-form',
    'options' => ['class' => 'form-signin'],
    'fieldConfig' => [
        'template' => "{input}",
    ]]); ?>
<h2 class="form-signin-heading">Please sign in</h2>

<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>

<div class="checkbox">
    <?= $form->field($model, 'rememberMe')->checkbox() ?>
</div>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
<?php ActiveForm::end(); ?>
