<?php

/* @var $this yii\web\View */
use common\models\Content;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $models Content[] */

$this->title = $model->title;
?>
<div class="col-sm-8 blog-main">
    <?php
    foreach ($models as $content) {
        ?>
        <div class="blog-post">
            <h2 class="blog-post-title"><?= $content->title ?></h2>
            <p class="blog-post-meta"><?= date("d/m/Y", $content->created_at) ?></p>
            <?php
            if (!empty($content->avatar)) {
                ?>
                <a href="<?= Url::to(['/site/content', 'id' => $content->id]) ?>">
                    <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                </a>
                <?
            }
            ?>
            <?= $content->sapo ?>
            <br><br>
            <a class="btn btn-primary" href="<?= Url::to(['/site/content', 'id' => $content->id]) ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        </div><!-- /.blog-post -->
        <?
    }
    ?>
    <nav>
        <?php
        echo LinkPager::widget(['pagination' => $pages]);
        ?>
    </nav>
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