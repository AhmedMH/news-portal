<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
$formatter = \Yii::$app->formatter;
$this->title = $article->title;

?>

<div class=" panel panel-default">
  <div class="panel-heading"> <div class="row">
        <div class="col-md-9">
       
            <h4>
                <strong><?= Html::encode($this->title) ?></strong></h4>
        </div>
        <div class="col-md-3" align="right">
            <a href="/download/<?=$article->id?>" class="btn btn-success"><i class="fa fa-fw fa-download"></i> Download PDF</a>

            <?php 
            if(!Yii::$app->user->isGuest)
            {

            $user = app\models\Article::findOne($article->id)->user;
                 if (Yii::$app->user->identity->id == $user->id) {
                    echo Html::a('<i class="fa fa-fw fa-ban"></i> Delete', ['delete', 'id' => $article->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],

            ]);}} ?>

        </div>
    </div></div>
    <div class="panel-body">
   
  
    <div class="row post-content">
        <div class="col-md-12 thumbnail-image" title="<?=$article->image_tag ?>" style="background:url(/uploads/article_<?=$article->id.'.'.$article->image_extension ?>)">
        </div>

        <div class="col-md-12">
            <i class="fa fa-fw fa-user"></i> by <strong><?=Html::encode($article->user->name)?>/</strong><?=Html::encode($article->user->email)?> | <i class="fa fa-fw fa-calendar"></i> <?=$formatter->asDatetime($article->date , 'long');?>
        </div>

        <div class="col-md-12" style="margin-top:20px;">
            <p>
               <?=Html::encode($article->content)?>
            </p>

        </div>
    </div>
    </div>
</div>


