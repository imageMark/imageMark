<?php
namespace backend\models\admin;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Permission extends \common\models\Permission {

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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permission', 'name', 'permission_level'], 'required'],
            [['permission_level', 'status', 'created_at','parent_id','sort', 'updated_at'], 'integer'],
            [['permission', 'name','icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
  public function load($data, $formName = null)
  {
     if(parent::load($data, $formName)){
            if(!$this->parent_id) $this->parent_id = 0;
            return true;
     }
      return false;
  }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permission' => '权限规则',
            'name' => '权限名称',
            'permission_level' => '权限等级',
            'parent_id' => '上级权限',
            'sort' => '排序',
            'icon' => '图标',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    /**
     * @return array
     */
    public function PermissionLevel(){
        return [
            '1'=>'一级',
            '2'=>'二级',
            '3'=>'三级'
        ];
    }

    /**
     * 根据权限等级获取权限
     * @param $level
     * @return array
     */
    public static function takeParentOption($level)
    {
        if($level ==1) return null;
        $permissionLevel = $level-1;
        $result = self::find()->andFilterWhere(['status'=>self::$used_status])
            ->andFilterWhere(['permission_level'=> $permissionLevel])
            ->asArray()->all();
        if($result) return $result;
        return null;
    }


    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function takePermissionForSelect(){
        $top = self::find()->select('id,name')->andFilterWhere([
            'status'=>1,
            'permission_level'=>1
        ])->asArray()->all();
        foreach ($top as $key=> $val){
            $child = self::find()->select('id,name')->andFilterWhere([
                'status'=>1,
                'permission_level'=>2,
                'parent_id'=> $val['id']
            ])->asArray()->all();
            if($child){
                foreach ($child as $k=>$v){
                    $grandChild = self::find()->select('id,name')->andFilterWhere([
                        'status'=>1,
                        'permission_level'=>3,
                        'parent_id'=> $v['id']
                    ])->asArray()->all();
                    $v['child'] = $grandChild;
                    $child[$k] = $v;
                }
            }
            $top[$key]['child'] =  $child;
        }
        return $top;
    }

   public static function takeMenuByAdmin(){
       $menu[ 'options'] = ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'];
       $menu[ 'items'][] =  ['label' => '管理系统首页',
           'icon'=>'home',
           'url' => \Yii::$app->homeUrl,
           //'options' => ['class' => 'header']
       ];
       $topMenu = self::find()->andFilterWhere(['status'=>self::$used_status])
                              ->andFilterWhere(['permission_level'=>1])->orderBy(['sort'=>SORT_ASC])->all();
       if($topMenu){
           foreach ($topMenu as $key=>$top) {
               $menu['items'][$key+2] =[
                   'label'=>$top->name,
                   'icon' => $top->icon?$top->icon:'calendar-check-o',
                   'url' => '#',
               ];
               $childItem = self::find()->andFilterWhere(['parent_id'=>$top->id])->andFilterWhere(['status'=>self::$used_status])
                                        ->andFilterWhere(['permission_level'=>2])->all();
               if($childItem){
                   foreach ($childItem as $two) {
                       $menu['items'][$key + 2]['items'][] =  [
                           'label'=>$two->name,
                           'icon' => $two->icon?$two->icon:'calendar-check-o',
                           'url' => [$two->permission],
                       ];
                   }
               }
           }
       }
       return $menu;


   }



    /**
     * 根据角色获取权限
     * @param $role_id
     * @return mixed
     */
    public static function  takeMenuByPermission($role_id){
        $menu[ 'options'] = ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'];
        $menu[ 'items'][] =  ['label' => '系统菜单', 'options' => ['class' => 'header']];
        $topMenu = self::takePermission($role_id);
        if($topMenu){
            foreach ($topMenu as $key=>$top) {
                $menu['items'][$key+2] =[
                    'label'=>$top->name,
                    'icon' => $top->icon?$top->icon:'calendar-check-o',
                    'url' => '#',
                ];
                $childItem = self::takeChildPermission($role_id,$top->id);
                if($childItem){
                    foreach ($childItem as $two) {
                        $menu['items'][$key + 2]['items'][] =  [
                            'label'=>$two->name,
                            'icon' => $two->icon?$two->icon:'calendar-check-o',
                            'url' => [$two->permission],
                        ];
                    }
                }
            }
        }
        return $menu;
    }

    /**
     * 根据角色id获取顶级菜单栏
     * @param $role_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function takePermission($role_id){
        $result = PermissionRole::find()->andFilterWhere(['role_id'=>$role_id])->orderBy(['sort'=>SORT_ASC])->all();
        $data = self::find()->andFilterWhere(['and',[
            'in','id',ArrayHelper::getColumn($result,'permission_id')
        ],['permission_level'=>1]])->andFilterWhere(['status'=>self::$used_status])->all();
        //var_dump($data);exit;
        return $data;
    }

    /**
     * 根据顶级菜单栏获取二级菜单栏
     * @param $role_id
     * @param $parent_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function takeChildPermission($role_id,$parent_id){
        $result = PermissionRole::find()->andFilterWhere(['role_id'=>$role_id])->all();
        $data = self::find()->andFilterWhere([
            'in','id',ArrayHelper::getColumn($result,'permission_id')
        ])->andFilterWhere(['permission_level'=>2,'parent_id'=>$parent_id])->all();
        //var_dump($data);exit;
        return $data;
    }



}