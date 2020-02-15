<?php
namespace backend\models\admin;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class SystemRole extends \common\models\SystemRole{
    public static $used_status =1;//使用状态
    public static $drop_status = 5;//弃用状态

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => '角色名称',
            'remark' => '备注',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }

    /***
     * 获取角色提供选择
     * @return array
     */
    public static function takeRoleForSelect(){
        $result = self::find()->andFilterWhere(['status'=>self::$used_status])
                ->select('id,name')->all();
        if($result) return ArrayHelper::map($result,'id','name');
        return [];
    }



}