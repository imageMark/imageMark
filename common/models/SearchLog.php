<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cnpo_search_log".
 *
 * @property string $id 主键
 * @property string $title 搜索标题
 * @property int $number 搜索次数
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class SearchLog extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnpo_search_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['number', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'number' => 'Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
