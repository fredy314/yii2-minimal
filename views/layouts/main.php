<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Nav;

/* @var $this \yii\web\View */
/* @var $content string */

\yii\web\YiiAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?=Html::encode($this->title)?></title>
        <link rel="stylesheet" href="<?=Yii::$app->request->getBaseUrl()?>/css/site.css"/>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="header">
        <?php
        NavBar::begin(['brandLabel' => 'NavBar Test']);
        echo Nav::widget([
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                [
                    'url'     => ['/site/logout'],
                    'label'   => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'linkOptions' => [
                        'data-method' => 'post',
                    ],
                ]
                ),
            ],
        ]);
        NavBar::end();
        ?>
    </div>

    <div class="container">
        <?=$content?>
    </div>

    <footer class="footer container">
        &copy; My Company <?=date('Y')?>, <?=Yii::powered()?>
    </footer>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>