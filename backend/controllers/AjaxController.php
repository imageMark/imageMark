<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 10:03
 */
namespace backend\controllers;

use backend\models\article\Feedback;
use backend\models\user\Company;
use backend\models\user\CompanyRole;
use backend\models\user\UserInfo;
use yii\helpers\Json;
use yii\web\Controller;

class AjaxController extends Controller
{
    public function actionGetUserInfo()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $company_id = $parents[0];
                $out = UserInfo::getUserInfoArrays($company_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGetCompanyRole()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $company_id = $parents[0];
                $out = CompanyRole::getCompanyRole($company_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionSetFeedbackStatus()
    {
        $id = \Yii::$app->request->get('id');
        $status = \Yii::$app->request->get('status');
        $model = Feedback::findOne($id);
        $model->status=$status;
        if($model->save()){
            return true;
        }else{
            var_dump($model->getErrors());exit;
        }
        return false;
    }
}