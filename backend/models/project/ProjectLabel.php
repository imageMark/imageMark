<?php


namespace backend\models\project;


class ProjectLabel extends \common\models\ProjectLabel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'label_name'], 'required'],
            ['operator_id','default','value'=>\Yii::$app->user->id],
            ['status','default','value'=>1],
            [['operator_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['project_id', 'label_name'], 'string', 'max' => 100],
        ];
    }

}