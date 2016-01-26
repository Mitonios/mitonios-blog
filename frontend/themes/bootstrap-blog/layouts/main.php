<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Category;
use frontend\widgets\BootstrapBlogMenu;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?= Url::home() ?>favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name . ":" . Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <?php
            $items = [['label' => 'Home', 'url' => ['/site/index']]];
            $result = Category::getDb()->cache(function ($db) {
                return Category::find()->where(['parent_id' => null])->all();
            });
            foreach ($result as $item) {
                $items[] = ['label' => $item->title, 'url' => ['/site/category', 'id' => $item->id]];
            }
            echo BootstrapBlogMenu::widget([
                'items' => $items,
            ]);
            ?>
        </nav>
    </div>
</div>
<div class="container">
    <div class="blog-header">
        <h1 class="blog-title">Mitonios Blog</h1>
        <p class="lead blog-description">Yiiframework and share some resources.</p>
    </div>
    <div class="row">
        <?= $content ?>
    </div><!-- /.row -->

</div>
<footer class="blog-footer">
    <p>&copy; <?= date("Y") ?> by Mitonios</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
