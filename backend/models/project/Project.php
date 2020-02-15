<?php
namespace backend\models\project;

use yii\helpers\ArrayHelper;

class Project extends \common\models\Project
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_name', 'description'], 'required'],
            [['operator_id', 'status', 'created_at', 'updated_at'], 'integer'],
            ['operator_id','default','value'=>\Yii::$app->user->id],
            ['status','default','value'=>1],
            [['project_name', 'description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @return array
     */
    public static function takeProjectForSelect(){
        $result = self::find()->andFilterWhere(['status'=>1])
                        ->asArray()->all();
        if($result) return ArrayHelper::map($result,'id','project_name');
        return [];
    }


}