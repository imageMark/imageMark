<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $id 主键
 * @property string $project_name 项目名称
 * @property string $description 项目介绍
 * @property int $operator_id 操作人员
 * @property int $status 状态
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class Project extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_name', 'description', 'created_at', 'updated_at'], 'required'],
            [['operator_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['project_name', 'description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'description' => 'Description',
            'operator_id' => 'Operator ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
