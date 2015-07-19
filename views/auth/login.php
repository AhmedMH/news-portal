<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Welcome back, Please sign in';
?>







<div class="col-md-5 center-block" style="float:none;">

<h2 class="form-title" ><?= Html::encode($this->title) ?></h2>
        <hr class="line">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group">
        <div >
            <?= Html::submitButton('<i class="fa fa-fw fa-sign-in"></i> Login', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
 