<?php


namespace backend\models\customer;


use yii\helpers\ArrayHelper;

class Company extends \common\models\Company
{
    /**
     * 获取企业作业选择项
     * @return array|null
     */
    public static function takeCompanyForSelect(){
        $result = self::find()->select(['id','name'])
            ->andFilterWhere(['status'=>1])
            ->asArray()->all();
        if($result){
            return ArrayHelper::map($result,'id','name');
        }
        return null;
    }


}