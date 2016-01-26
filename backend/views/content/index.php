<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 3:32 PM
 */
use common\models\Category;
use common\models\Content;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $models Content[] */
$this->title = 'Content';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Search</h3>
            </div>
            <?php $form = ActiveForm::begin([
                'method' => 'get'
            ]); ?>
            <div class="panel-body">
                <?= $form->field($search, 'id') ?>
                <?= $form->field($search, 'title') ?>
                <?= $form->field($search, 'status')->dropDownList([Content::STATUS_DRAFT => 'Draft', Content::STATUS_PUBLISH => "Publish"], ['prompt' => "(Choose)"]) ?>
                <?= $form->field($search, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'), ['prompt' => "(Choose)"]) ?>
            </div>
            <div class="panel-footer">
                <button class="btn btn-default btn-block" type="submit">Search</button>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Content [<?= $pages->totalCount ?>]</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-condensed table-hover">
                    <tbody>
                    <?php
                    foreach ($models as $model) {
                        ?>
                        <tr class="<?= $model->status == $model::STATUS_DRAFT ? "danger" : "" ?>">
                            <td width="10">#<?= $model->id ?></td>
                            <td><?= Html::a($model->title, ['update', 'id' => $model->id]) ?></td>
                            <td class="text-right">
                                <?= Html::a("<i class='glyphicon glyphicon-trash'></i>", ['delete', 'id' => $model->id]) ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        echo LinkPager::widget(['pagination' => $pages,]);
        ?>
    </div>
</div>
