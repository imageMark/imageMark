<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 14:48
 */
namespace common\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Common extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}