<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/animate.css">

</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        $items[]=['label' => 'Home', 'url' => Yii::$app->homeUrl];

            if(Yii::$app->user->isGuest)
            {
                $items=array_merge($items,
                    [
                    ['label' => 'Login', 'url' => '/login'],
                    ['label' => 'Register', 'url' => '/signup']
                    ]);
            }
            else
            {
                 $items=array_merge($items,
                    [
                    ['label'=>'Publish New Article','url' => '/article/create'],
                    ['label'=>'My Articles','url' => '/myarticles'],
                    
            ['label' => Yii::$app->user->identity->name,'items' => [['label'=>'Logout','url' => '/logout','linkOptions' => ['data-method' => 'post']]]]
                    ]);

            }


            NavBar::begin([
                'brandLabel' => 'News Portal',
                'renderInnerContainer' => false,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top full-width',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right','style'=>'  padding-right: 15px;'],
                'items' => $items
            ]);
            NavBar::end();
        ?>

        <div class="container">
          <?php require_once('flash.php'); ?>
            <?= $content ?>
        </div>
    </div>

        <div class="container">
    <footer class="footer">
            <p class="pull-left">&copy; News Portal <?= date('Y') ?></p>
            <p class="pull-right">Powered By CrossOver</p>
    </footer>
        </div>


<?php $this->endBody() ?>
<script src="/assets/c0bbbca3/wow.min.js"></script>
<script type="text/javascript" src="/assets/b492fbf1/js/bootstrap-filestyle.min.js"></script>
    <script type="text/javascript">
    $(":file").filestyle();
    new WOW().init();
      </script>
</body>
</html>
<?php $this->endPage() ?>
