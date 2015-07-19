<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title="Choose a new password!"
?>
<div class="col-md-5 center-block" style="float:none;">

<h2 class="form-title" ><?= Html::encode($this->title) ?></h2>
        <hr class="line">

    <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Set Password', ['class' => 'btn btn-warning btn-lg btn-block']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
