<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "eand_cate".
 *
 * @property string $id 主键
 * @property string $cate_name 分类名称
 * @property string $parent_id 上级ID
 * @property string $icon_key 分类图标key
 * @property string $icon_url 图标url
 * @property string $discription 描述
 * @property int $status 状态
 * @property string $tag 标签
 * @property string $order 排序
 * @property string $created_at 添加时间
 * @property string $updated_at 更新时间
 */
class Cate extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eand_cate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cate_name', 'created_at', 'updated_at'], 'required'],
            [['parent_id', 'status', 'order', 'created_at', 'updated_at'], 'integer'],
            [['cate_name'], 'string', 'max' => 50],
            [['icon_key', 'tag'], 'string', 'max' => 200],
            [['icon_url'], 'string', 'max' => 100],
            [['discription'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cate_name' => 'Cate Name',
            'parent_id' => 'Parent ID',
            'icon_key' => 'Icon Key',
            'icon_url' => 'Icon Url',
            'discription' => 'Discription',
            'status' => 'Status',
            'tag' => 'Tag',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
