<?php
namespace backend\controllers\admin;
use backend\models\admin\Permission;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;
class DataController extends Controller{


    public function actionParentPermission(){

        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $level = empty($ids[0]) ? null : $ids[0];
            if ( $level != null) {
                $data = Permission::takeParentOption($level);
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }






}