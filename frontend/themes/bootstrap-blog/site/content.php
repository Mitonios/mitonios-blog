<?php

/* @var $this yii\web\View */
use common\models\Content;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $model Content */

$this->title = $model->title;
?>
<div class="col-sm-8 blog-main">
    <div class="blog-post">
        <h2 class="blog-post-title"><?= $model->title ?></h2>
        <p class="blog-post-meta"><?= date("d/m/Y", $model->created_at) ?></p>
        <?= $model->body ?>
    </div><!-- /.blog-post -->
</div><!-- /.blog-main -->

<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Hi, I am Nguyễn Văn Nhân, a full-stack web developer.</p>
    </div>
    <!--<div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>-->
</div><!-- /.blog-sidebar -->