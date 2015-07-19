<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
$formatter = \Yii::$app->formatter;
?>
<h1 class="title"><?= Html::encode($title) ?> <?= $public==true?'<a target="_blank" class="btn btn-warning" href="/rss"><i class="fa fa-rss"></i> Rss</a>':'';?></h1>
    <div class="row">

    <?php if(!empty($articles)) {foreach ($articles as $article): ?>

         <div class="col-sm-6 col-md-6 wow animated fadeInUp " style="visibility: hidden;">
            <a href="/article/<?=$article->id ?>" style="text-decoration: none; color: inherit;" >
            <div class="post">
                <div class="post-img-content" style="background:url(/uploads/article_<?=$article->id.'.'.$article->image_extension ?>)">
                    <span class="post-title"><b><?=Html::encode("{$article->title}")?></b></span>
                </div>
                <div class="content">
                    <div class="author">
                        By <b><?= $public==true? Html::encode($article->user->name) : 'You' ?></b> |
                        <time><?= $formatter->asDate($article->date , 'long');?></time>
                    </div>
                    <div class="sidebar-box">
  <?= Html::encode("{$article->content}") ?>
  <p class="read-more"></p>
</div>
                </div>
            </div>
            </a>
        </div>
        
        
<?php endforeach;}else {?><div class="alert alert-info">There are no published articles yet</div><?php } ?>
      

</div>

