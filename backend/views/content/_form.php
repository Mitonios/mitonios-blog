<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 3:32 PM
 */
use backend\assets\AppAsset;
use common\models\Category;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Content */
?>
<?php $form = ActiveForm::begin([
    //'layout' => 'horizontal',
    'options' => ['enctype' => 'multipart/form-data'],
    'fieldConfig' => [
        'template' => "\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'wrapper' => 'col-md-12',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Information</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'title')->hint($model->slug) ?>
                <?= $form->field($model, 'body')->textarea() ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Other</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'sapo',['template'=>"{label}{input}{error}"])->textarea() ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-<?= $model->status == $model::STATUS_DRAFT ? "default" : "primary" ?>">
            <div class="panel-heading">
                <h3 class="panel-title">Action</h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <p class="form-control-static"><?= $model->status == $model::STATUS_DRAFT ? "Draft" : "Publish" ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="btn btn-group pull-right" style="padding:0;">
                    <button type="submit" class="btn btn-default" name="save" value="0">Draft</button>
                    <button type="submit" class="btn btn-primary" name="save" value="1">Publish</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Category & Tag</h3>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'), ['prompt' => "(Choose)"]) ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Avatar</h3>
            </div>
            <div class="panel-body text-center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                        <?= !empty($model->avatar) ? Html::img(Yii::$app->params['uploadUrl'] . $model->avatar) : "" ?>
                    </div>
                    <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                            <?= Html::activeFileInput($model, "avatarFile") ?>
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerCssFile("@web/plugin/jasny-bootstrap/css/jasny-bootstrap.min.css", [
    'depends' => [AppAsset::className()],
]);
$this->registerJsFile('@web/plugin/jasny-bootstrap/js/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()],
    'position' => View::POS_HEAD]);
$this->registerJsFile('@web/plugin/tinymce/js/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::className()],
    'position' => View::POS_HEAD])
?>
<script>
    //moxiemanager
    tinymce.init({
        selector: '#content-body',
        height: 800,
        plugins: [
            'advlist autolink autoresize charmap code codesample textcolor colorpicker contextmenu directionality emoticons fullscreen hr image imagetools',
            'legacyoutput link lists media paste preview table textcolor visualblocks wordcount'
        ],
        toolbar1: 'bold italic strikethrough bullist numlist blockquote hr | alignleft aligncenter alignright link unlink fullscreen code',
        toolbar2: 'formatselect underline alignjustify forecolor removeformat charmap indent outdent undo redo image',
        content_css: ['<?=Url::home()?>plugin/bootstrap-3.3.6-dist/css/bootstrap.min.css', '<?=Url::home()?>css/blog.css'],
        file_picker_callback: elFinderBrowser
    });
    function elFinderBrowser(callback, value, meta) {
        tinymce.activeEditor.windowManager.open({
            file: '<?=Url::home()?>plugin/elfinder-2.x/elfinder.html',// use an absolute path!
            title: 'File Manager',
            width: 1024,
            height: 450,
            resizable: 'yes'
        }, {
            oninsert: function (file, elf) {
                var url, reg, info;
                // URL normalization
                url = file.url;
                reg = /\/[^/]+?\/\.\.\//;
                while (url.match(reg)) {
                    url = url.replace(reg, '/');
                }
                // Make file info
                info = file.name + ' (' + elf.formatSize(file.size) + ')';

                // Provide file and text for the link dialog
                if (meta.filetype == 'file') {
                    callback(url, {text: info, title: info});
                }
                // Provide image and alt text for the image dialog
                if (meta.filetype == 'image') {
                    callback(url, {alt: info});
                }
                // Provide alternative source and posted for the media dialog
                if (meta.filetype == 'media') {
                    callback(url);
                }
            }
        });
        return false;
    }
    /*window.onbeforeunload = confirmExit;
     function confirmExit() {
     return "Đang biên tập nội dung, save chưa mà tắt?";
     }*/
    $(document).on('focusin', function (e) {
        if ($(e.target).closest(".mce-window").length) {
            e.stopImmediatePropagation();
        }
    });
</script>
