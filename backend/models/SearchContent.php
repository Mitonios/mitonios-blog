<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/25/2016
 * Time: 3:44 PM
 */

namespace backend\models;

/**
 * @property integer $id
 * @property string $title
 * @property string $sapo
 * @property integer $status
 * @property integer $category_id
 */

use yii\base\Model;

class SearchContent extends Model
{
    public $id;
    public $title;
    public $status;
    public $category_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'status', 'category_id'], 'safe'],
        ];
    }
}