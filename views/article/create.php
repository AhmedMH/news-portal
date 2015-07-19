<?php

use yii\helpers\Html;


$this->title = 'Create New Article';
?>
<div class="article-create">
	
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
