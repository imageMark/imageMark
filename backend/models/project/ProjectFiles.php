<?php


namespace backend\models\project;


class ProjectFiles extends \common\models\ProjectFiles
{

    public function rules()
    {
        return [
            [['project_id', 'file_name'], 'required'],
            ['operator_id','default','value'=>\Yii::$app->user->id],
            ['status','default','value'=>1],
            [['operator_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['project_id', 'file_name'], 'string', 'max' => 100],
        ];
    }
}