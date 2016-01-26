<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 12:40 PM
 *
 */
use common\models\Category;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model Category */
/* @var $items Category[] */
$this->title = 'Category';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">List Category</h3></div>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-hover table-excel">
                    <thead>
                    <tr>
                        <th width="10">ID</th>
                        <th colspan="2">title</th>
                        <th>Slug</th>
                        <th width="100">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($items as $item) {
                        ?>
                        <tr class="">
                            <form class="form-excel">
                                <?= Html::hiddenInput('id', $item->id) ?>
                                <td>#<?= $item->id ?></td>
                                <td class="col-excel" colspan="2">
                                    <?= Html::activeTextInput($item, 'title', []) ?>
                                </td>
                                <td class="col-excel">
                                    <?= Html::activeTextInput($item, 'slug', []) ?>
                                </td>
                                <td class="text-right">
                                    <div class="btn-group btn-group-xs">
                                        <button type="submit" class="btn btn-default"
                                                data-toggle="tooltip" data-placement="top" title="Save"><i class="glyphicon-floppy-disk glyphicon"></i></button>
                                        <a href="<?= Url::to(['index', 'id' => $item->id]) ?>"
                                           class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="" class="btn btn-default btn-delete" data-id="<?= $item->id ?>"
                                           data-toggle="tooltip" data-placement="left" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <?
                        $children = $item->children;
                        if (!empty(($children))) {
                            foreach ($children as $child) {
                                ?>

                                <tr>
                                    <form class="form-excel">
                                        <?= Html::hiddenInput('id', $child->id) ?>
                                        <td>#<?= $item->id ?></td>
                                        <td style="border-right: none;" width="30">|--</td>
                                        <td class="col-excel" style="border-left: none;">
                                            <?= Html::activeTextInput($child, 'title', []) ?>
                                        </td>
                                        <td class="col-excel">
                                            <?= Html::activeTextInput($child, 'slug', []) ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group btn-group-xs">
                                                <button type="submit" class="btn btn-default"
                                                        data-toggle="tooltip" data-placement="top" title="Save"><i class="glyphicon-floppy-disk glyphicon"></i></button>
                                                <a href="<?= Url::to(['index', 'id' => $child->id]) ?>"
                                                   class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                                <a href="" class="btn btn-default btn-delete" data-id="<?= $child->id ?>"
                                                   data-toggle="tooltip" data-placement="left" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </td>
                                    </form>
                                </tr>

                                <?
                            }
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><?= $model->isNewRecord ? "New" : "Update" ?> Category</h3></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'fieldConfig' => [
                    ]]); ?>
                <?= $form->field($model, 'title') ?>
                <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Category::find(['parent_id' => null])->where(['parent_id' => null])->all(), 'id', 'title'),
                    ['prompt' => '(Choose)']) ?>
                <button class="btn btn-lg btn-<?= $model->isNewRecord ? "primary" : "success" ?> btn-block" type="submit">Save</button>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
        $('.form-excel').submit(function () {
            var form = this;
            $.ajax({
                type: "POST",
                url: '<?=Url::to(['quick-save'])?>',
                data: $(form).serialize(),
                error: function (xhr, ajaxOptions, thrownError) {
                    $.notify(xhr.responseText, "error");
                },
                success: function (data) {
                    $.notify(data, "success");
                    $(form).find('tr').addClass("success")
                }
            });
            return false;
        })
        $('.btn-delete').click(function () {
            if (confirm("Are you sure?")) {
                $(this).parent().parent().parent().remove()
                var id = $(this).data('id')
                $.ajax({
                    type: "POST",
                    url: '<?=Url::to(['delete'])?>',
                    data: {'id': id}
                });
            }
            return false;
        })
    })
</script>