<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_image".
 *
 * @property string $id 主键
 * @property string $project_id 项目ID
 * @property int $file_id 文件ID
 * @property string $image_name 图片名称
 * @property string $image_url 图片地址
 * @property string $image_annotation 图片标注信息
 * @property int $status 状态 1未标注  5标注  8 审核
 * @property int $operator_id 上传人员
 * @property int $label_user 标注人员
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class ProjectImage extends Common
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'file_id', 'image_name', 'image_url', 'created_at', 'updated_at'], 'required'],
            [['file_id', 'status', 'operator_id', 'label_user', 'created_at', 'updated_at'], 'integer'],
            [['project_id', 'image_name', 'image_url'], 'string', 'max' => 100],
            [['image_annotation'], 'string', 'max' => 500],
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
            'file_id' => 'File ID',
            'image_name' => 'Image Name',
            'image_url' => 'Image Url',
            'image_annotation' => 'Image Annotation',
            'status' => 'Status',
            'operator_id' => 'Operator ID',
            'label_user' => 'Label User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
