<?php
namespace backend\models;
use backend\models\customer\Customer;
use backend\models\customer\CustomerInfo;
use backend\models\customer\OperationType;
use yii\base\Model;

class RegisterForm extends Model{
 public $phone;
 public $department_id;

 public $truename;

    public function rules()
    {
        return [
            [['phone','department_id','truename'],'required'],
            [['truename'], 'string', 'max' => 20],
            ['phone','match','pattern'=>'/^[1][34578][0-9]{9}$/','message' => '手机号不符合规则'],
        ];
    }

    public function saveData($data)
    {
        if(!$this->validate()) return false;
        if($data['RegisterForm']['phone']){
            if(Customer::findOne(['phone'=>$data['RegisterForm']['phone']])){
                $this->addError('phone','手机号码已经注册了！');
                return false;
            }
            $model = new Customer();
            $model->company_id =1;
            $model->department_id = $data['RegisterForm']['department_id'];
            $model->phone = $data['RegisterForm']['phone'];
            $model->user_status =1;
            if($model->save(false)){
                $customer = new CustomerInfo();
                $customer->customer_id = $model->attributes['id'];
                $customer->company_id = 1;
                $customer->department_id = $data['RegisterForm']['department_id'];
                $model->phone = $data['RegisterForm']['phone'];
                $customer->truename =$data['RegisterForm']['truename'];
                $model->phone = $data['RegisterForm']['phone'];
                $res = OperationType::find()->select(['id'])->asArray()->column();
                //var_dump($res);
                $customer->relation_operation = implode(",",$res);
                $customer->status = 1;
                if($customer->save(false)) return true;
                return false;
            }else{
                return false;
            }
        }

        return false;



    }


}