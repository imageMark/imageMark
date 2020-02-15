<?php
namespace  backend\controllers\base;
use yii\web\Controller;

class BaseController extends Controller{

    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
            return false;
        }
        return true;
    }






}