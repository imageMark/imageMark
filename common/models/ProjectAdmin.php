<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_admin".
 *
 * @property string $id 主键
 * @property string $project_id 项目ID
 * @property string $admin_id 项目成员ID
 * @property int $operator_id 操作人员
 * @property int $status 状态
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class ProjectAdmin extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'admin_id', 'created_at', 'updated_at'], 'required'],
            [['operator_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['project_id', 'admin_id'], 'string', 'max' => 100],
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
            'admin_id' => 'Admin ID',
            'operator_id' => 'Operator ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
