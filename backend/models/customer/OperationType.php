<?php


namespace backend\models\customer;


use yii\helpers\ArrayHelper;

class OperationType extends \common\models\OperationType{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operation_name', 'operation_desc', 'resource_relation', ], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            ['resource_relation', 'filter', 'filter' => function(){
                return implode(",",$this->resource_relation);
            }],
            [['operation_name'], 'string', 'max' => 11],
            [['operation_desc'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operation_name' => '作业类型名称',
            'operation_desc' => '作业类型描述',
            'resource_relation' => '关联资源分类',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }

    /**
     * 获取作业类型给员工选择
     * @return array
     */
    public static function takeOptionForSelect(){
        $result = self::find()
            ->asArray()->all();
        if($result){
            return ArrayHelper::map($result,'id','operation_name');
        }
    }

}