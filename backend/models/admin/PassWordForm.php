<?php
namespace backend\models\admin;
use yii\base\Model;
use Yii;
class PassWordForm extends Model {

    public $old_password;
    public $new_password;
    public $new_password_repeat;
    public $password_hash;


    public function rules()
    {
        return [
            [['new_password','new_password_repeat'] ,'required'],
            ['new_password', 'string', 'min' => 6],
            ['new_password_repeat','compare','compareAttribute'=>'new_password','message'=>'两次输入的密码不一致！'],
            ['old_password','verifyPassword','skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    public function verifyPassword($attribute,$params){
        if(empty($this->old_password)){
            $this->addError($attribute, '请输入原密码');
        }
     $AdminInfo  = Admin::findOne(Yii::$app->user->identity->id);
        if(!Yii::$app->security->validatePassword($this->old_password,$AdminInfo->password)){
            $this->addError($attribute, '原密码不正确！');
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_password'=>'原密码',
            'new_password'=>'新密码',
            'new_password_repeat'=>'确认新密码'
        ];
    }

    /**
     *
     * @return bool|null
     * @throws \yii\base\Exception
     */
    public function changePwd(){
        $id = Yii::$app->user->getId();
        if (!$this->validate()) {
            return null;
        }
        $Admin = Admin::findOne($id);
        $Admin->setPassword($this->new_password);
        //$Admin->removePasswordResetToken();
        if($Admin->save(false)) return true;
        return false;
    }







}