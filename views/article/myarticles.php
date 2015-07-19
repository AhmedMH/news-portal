<?php
use yii\widgets\LinkPager;
$this->title = 'My Published Articles';
?>


<?= $this->render('/article/list', [
        'articles' => $articles,
        'title' => $this->title,
        'public' => false,
    ]) ?>
<div class="row" style="text-align: center;"><?= LinkPager::widget(['pagination' => $pagination]) ?></div>