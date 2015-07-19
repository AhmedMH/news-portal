<?php
$this->title = 'Trending Newsstand';
?>

<?= $this->render('/article/list', [
        'articles' => $articles,
        'title' => $this->title,
        'public' => true,
    ]) ?>

