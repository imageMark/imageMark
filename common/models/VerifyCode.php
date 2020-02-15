<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cnpo_verify_code".
 *
 * @property string $id 主键
 * @property string $phone 手机号
 * @property string $code 验证码
 * @property int $created_at 添加时间
 * @property string $generate_time 验证生成日期
 */
class VerifyCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnpo_verify_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'code', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['generate_time'], 'safe'],
            [['phone'], 'string', 'max' => 11],
            [['code'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'code' => 'Code',
            'created_at' => 'Created At',
            'generate_time' => 'Generate Time',
        ];
    }
}
