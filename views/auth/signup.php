<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Welcome! Create your account';
?>
<div class="col-md-5 center-block" style="float:none;">

<h2 class="form-title" ><?= Html::encode($this->title) ?></h2>
        <hr class="line">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
    
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-fw fa-user"></i> Register', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
