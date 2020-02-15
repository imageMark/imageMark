<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cnpo_system_score".
 *
 * @property string $id 主键
 * @property int $compamy_id 企业ID
 * @property string $type_name 类型名称
 * @property string $rule_description 规则描述
 * @property string $description 描述
 * @property int $score_type 积分来源类型
 * @property int $url_type 跳转类型
 * @property string $max_number 最多积分
 * @property int $status 状态1正常 5删除
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class SystemScore extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnpo_system_score';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compamy_id', 'type_name', 'rule_description', 'description', 'score_type', 'max_number', 'status', 'created_at', 'updated_at'], 'required'],
            [['compamy_id', 'score_type', 'url_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['type_name', 'max_number'], 'string', 'max' => 100],
            [['rule_description', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'compamy_id' => 'Compamy ID',
            'type_name' => 'Type Name',
            'rule_description' => 'Rule Description',
            'description' => 'Description',
            'score_type' => 'Score Type',
            'url_type' => 'Url Type',
            'max_number' => 'Max Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
