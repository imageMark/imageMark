<?php
namespace backend\models\image;

class ProjectImage extends \common\models\ProjectImage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'file_id', 'image_name', 'image_url'], 'required'],
            ['operator_id','default','value'=>\Yii::$app->user->id],
            [['file_id', 'status', 'operator_id', 'label_user', 'created_at', 'updated_at'], 'integer'],
            [['project_id', 'image_name', 'image_url'], 'string', 'max' => 100],
            [['image_annotation'], 'string', 'max' => 500],
        ];
    }

}