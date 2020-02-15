<?php
namespace backend\components\auth;
use backend\models\admin\PermissionRole;
use backend\models\admin\SystemRole;
use yii\base\Component;
use Yii;
use yii\helpers\ArrayHelper;
class AuthService extends Component{

    /**
     * @var SystemRole
     */
    public $Role;


    public function __construct($role= false,array $config = [])
    {
        if($role) $this->Role = $role;
        parent::__construct($config);
    }

    /**
     * @return bool
     */
    public function createRolePermission(){
        if ($data =Yii::$app->request->post('Permission')) {

            foreach($data as $child){
                $model = new PermissionRole();
                $model->role_id = $this->Role->id;
                $model->permission_id = $child;
                $model->status = $model::$used_status;
                $model->save();
            }
            return true;
        }
        return false;
    }

    /**
     * 更新角色
     * @return bool
     */
    public function updateRole(){
        if($data = Yii::$app->request->post('Permission')){
            $oldData  =PermissionRole::find()->andFilterWhere(['role_id'=>$this->Role->id])->all();
            $old = ArrayHelper::getColumn($oldData,'permission_id');

            if(array_diff($data,$old)||array_diff($old,$data)){
                PermissionRole::deleteAll(['role_id'=>$this->Role->id]);
            }else{
                return true;
            }
            foreach ($data as $value){
                $model = new PermissionRole();
                $model->role_id = $this->Role->id;
                $model->permission_id = $value;
                $model->save();
            }
            return true;
        }
        return false;
    }

}



