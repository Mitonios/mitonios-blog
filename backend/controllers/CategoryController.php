<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 12:39 PM
 */

namespace backend\controllers;

use Yii;
use common\models\Category;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;

class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->request->get('id')) {
            $model = Category::findOne(Yii::$app->request->get('id'));
        } else {
            $model = new Category();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Update Category Successful");
                return $this->refresh();
            }
        }

        $items = Category::find()->where(['parent_id' => null])->all();
        return $this->render("index", ['model' => $model, 'items' => $items]);
    }

    public function actionQuickSave()
    {
        /**
         * @var $model Category
         */
        $model = Category::findOne(Yii::$app->request->post('id'));
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                echo "Save done";
            } else {
                echo Json::encode($model->errors);
            }
        }
    }

    public function actionDelete()
    {
        /**
         * @var $model Category
         */
        $model = Category::findOne(Yii::$app->request->post('id'));
        $model->delete();
    }
}