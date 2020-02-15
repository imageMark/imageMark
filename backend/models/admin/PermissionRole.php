<?php
namespace backend\models\admin;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class PermissionRole extends \common\models\PermissionRole {

    public static $used_status = 1;
    public static $drop_status = 5;
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
            [['role_id', 'permission_id'], 'required'],
            [['role_id', 'permission_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => '角色',
            'permission_id' => '权限',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }


    /**
     * 获取某个角色的权限
     * @param $id
     * @return array
     */
    public static function takePermissionByRole($id){
        $result = self::find()->andFilterWhere(['role_id'=>$id,'status'=>1])->all();
        if($result) return ArrayHelper::getColumn($result,'permission_id');
        return [];
    }





}