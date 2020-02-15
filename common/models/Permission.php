<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cnpo_permission".
 *
 * @property int $id ID
 * @property string $permission 权限规则
 * @property string $name 权限名称
 * @property int $permission_level 权限等级
 * @property int $parent_id 上级权限
 * @property int $sort 排序
 * @property string $icon 图标
 * @property int $status 状态 1有效 5无效
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnpo_permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['permission', 'name', 'permission_level', 'created_at', 'updated_at'], 'required'],
            [['permission_level', 'parent_id', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['permission', 'name'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permission' => 'Permission',
            'name' => 'Name',
            'permission_level' => 'Permission Level',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'icon' => 'Icon',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
