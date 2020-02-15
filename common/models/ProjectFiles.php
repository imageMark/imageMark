<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_files".
 *
 * @property string $id 主键
 * @property string $project_id 项目ID
 * @property string $file_name 项目成员ID
 * @property int $operator_id 操作人员
 * @property int $status 状态
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class ProjectFiles extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'file_name', 'created_at', 'updated_at'], 'required'],
            [['operator_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['project_id', 'file_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'file_name' => 'File Name',
            'operator_id' => 'Operator ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
