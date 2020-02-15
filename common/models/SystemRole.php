<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cnpo_system_role".
 *
 * @property int $id ID
 * @property string $name 角色名称
 * @property string $remark 角色说明
 * @property int $status 状态 1有效 5无效
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class SystemRole extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cnpo_system_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'remark' => 'Remark',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
