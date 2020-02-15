<?php
namespace backend\controllers;

use backend\components\Mybehavior;
use backend\components\test;
use backend\components\user\UserServers;
use backend\models\admin\Login;
use backend\models\admin\PassWordForm;
use backend\models\customer\Customer;
use backend\models\customer\CustomerInfo;
use backend\models\expert\Expert;
use backend\models\RegisterForm;
use backend\models\system\AppUpdate;
use backend\models\system\System;
use backend\models\user\Medal;
use backend\models\user\User;
use backend\models\video\Cate;
use backend\models\video\Theme;
use backend\models\video\Video;
use dosamigos\qrcode\QrCode;
use frontend\components\user\PhoneCodeServers;
use frontend\models\user\PhoneCode;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\admin\Admin;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','site','help', 'error','register'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','site','help','index','register'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
	

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



    /**
     * 首页
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * 登录
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSite()
    {
        $this->layout=false;
        return $this->render('site');
    }


    public function actionReset()
    {
        $model = new PassWordForm();
        if($model->load(Yii::$app->request->post() )&& $model->validate()){
            if($model->changePwd(Yii::$app->user->id)){
                return $this->redirect(['index']);
            }
        }else{
            return $this->render('/site/update',
                ['model'=>$model]);
        }
    }

    public function actionRegister()
    {
        $this->layout = false;
        //return $this->render('ok');
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())&&$model->saveData(Yii::$app->request->post())) {
            return $this->render('ok');
        } else {
            return $this->render( 'register', [
                'model' => $model,
            ]);
        }


    }
}
