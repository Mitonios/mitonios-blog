<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 3:32 PM
 */
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Create New';
$this->params['breadcrumbs'][] = ['label' => "Content", 'url' => Url::to(['/content/index'])];
$this->params['breadcrumbs'][] = $this->title;
echo $this->render("_form", ['model' => $model]);
?>

