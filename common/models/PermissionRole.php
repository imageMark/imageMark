<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cnpo_permission_role".
 *
 * @property int $id ID
 * @property int $role_id 角色ID
 * @property int $permission_id 权限ID
 * @property int $status 状态 1有效 5无效
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class PermissionRole extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnpo_permission_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'permission_id', 'created_at', 'updated_at'], 'required'],
            [['role_id', 'permission_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'permission_id' => 'Permission ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
