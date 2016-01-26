<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 12:39 PM
 */

namespace backend\controllers;

use backend\models\SearchContent;
use common\models\Content;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class ContentController extends Controller
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
        $search = new SearchContent();


        $params['search'] = $search;
        $query = Content::find();
        if ($search->load(Yii::$app->request->get())) {
            foreach ($search->attributes as $k => $v) {
                $query->andFilterWhere(['like', $k, $v]);
            }
        }

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $params['pages'] = $pages;
        $pages->pageSize = 20;
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)->orderBy('id DESC')
            ->all();
        $params['models'] = $models;

        return $this->render("index", $params);
    }

    public function actionCreate()
    {
        $model = new Content();
        if ($model->load(Yii::$app->request->post())) {
            $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
            if ($model->save() && $model->upload()) {
                Yii::$app->session->setFlash("success", "Create Content Successful");
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render("create", ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        /**
         * @var $model Content
         */
        $model = Content::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->avatarFile = UploadedFile::getInstance($model, 'avatarFile');
            if ($model->save() && $model->upload()) {
                Yii::$app->session->setFlash("success", "Update Content Successful");
                return $this->refresh();
            }
        }
        return $this->render("update", ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Content::findOne($id);
        $model->delete();
        Yii::$app->session->setFlash("success", "Delete " . $model->title . " successful");
        return $this->redirect(\Yii::$app->request->getReferrer());
    }

}