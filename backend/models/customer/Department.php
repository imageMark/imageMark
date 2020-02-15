<?php


namespace backend\models\customer;


use yii\helpers\ArrayHelper;

class Department extends \common\models\Department
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company_id','level'], 'required'],
            ['status', 'default', 'value' => 1],
            [['company_id', 'parent_id', 'level', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }
    /**
     * 根据企业获取部门数组
     * @param $id
     * @return array|\yii\db\ActiveRecord[]|null
     */
    public static function takeDepartmentArray($id)
    {
        $result =  self::find()->select(['id','name'])
            ->andFilterWhere(['company_id'=>$id])
            ->andFilterWhere(['status'=>1])->asArray()->all();
        if($result) return $result;
        return null;
    }

    /**
     * @return array|null
     */
    public static function takeDepartmentForSelect()
    {
        $result =  self::find()->select(['id','name'])
            ->andFilterWhere(['company_id'=>1])
            ->andFilterWhere(['status'=>1])->asArray()->all();
        if($result) return ArrayHelper::map($result,'id','name');
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '组织机构名称',
            'company_id' => '所属企业',
            'parent_id' => '上级组织机构',
            'level' => '层级',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 根据depdrop需要获取上级组织机构
     * @param $company_id
     * @param $level
     * @return array|\yii\db\ActiveRecord[]|null
     */
    public static function takeDepartmentForDrop($company_id,$level){
        if($level ==1){
            return null;
        }else {
            $levelNeed = $level - 1;
            $result = self::find()->select(['id', 'name'])
                ->andFilterWhere(['company_id' => $company_id, 'status' => 1])
                ->andFilterWhere(['level'=>$levelNeed])->asArray()->all();
          if($result) return $result;
          return null;
        }
    }

    /**
     * 获取下级部门的ID
     * @param $departmentId
     * @return array|int
     */
    public static function takeChildDepartmentArray($departmentId){
        $child =self::find()->select(['id','level'])->andFilterWhere(['parent_id'=>$departmentId,'status'=>1])
            ->asArray()->all();
        if($child){
            $childArr = [];
            foreach ($child as $k=>$v){
                array_push($childArr,$v['id']);
                if($v['level']==3){
                    continue;
                }else{
                    $grandChild = self::find()->select(['id'])->andFilterWhere(['parent_id'=>$v['id'],'status'=>1])->asArray()->column();
                    if($grandChild)
                        $childArr = array_merge($childArr,$grandChild);
                }
            }
            array_push($childArr,(string)$departmentId);
            return $childArr;
        }
        $data = [];
        return array_push($data,$departmentId);
    }

}