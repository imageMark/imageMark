<?php
namespace backend\controllers\admin;
use backend\controllers\base\BaseController;
use backend\models\admin\Admin;
use backend\models\admin\AdminSearch;
use backend\models\admin\PassWordForm;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class AdminController extends BaseController{

    /**
     * 管理员列表
     * @return string
     */
    public function actionIndex(){

        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * 创建权限
     * @return string|\yii\web\Response
     */
    public function actionCreate(){
        $model = new Admin();
        if($model->load(Yii::$app->request->post())){
            $model->password = \Yii::$app->security->generatePasswordHash(Yii::$app->request->post('password'));
            $model->auth_key = \Yii::$app->security->generateRandomString();
            $file = UploadedFile::getInstance($model,'thumb_key');
            if($file){
                $image_id = Yii::$app->uploadFile->uploadImage($file->tempName);
                if($image_id) {
                    $model->thumb_key=$image_id;
                    $model->thumb_url=Yii::$app->params['imageUrl'].$image_id;
                }
            }
            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        Admin::updateAll(['status'=>5],['id'=>$id]);
        return $this->redirect(['index']);
    }

    /**
     * 查看权限
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * 更新权限
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->id==$id||Yii::$app->user->id==2){
            if($model->load(Yii::$app->request->post())){
                $file = UploadedFile::getInstance($model,'thumb_key');
                if($file){
                    $image_id = Yii::$app->uploadFile->uploadImage($file->tempName);
                    if($image_id) {
                        $model->thumb_key=$image_id;
                        $model->thumb_url=Yii::$app->params['imageUrl'].$image_id;
                    }
                }
                $adminUser=Yii::$app->request->post('AdminUser');
                if(isset($adminUser['password'])){
                    $model->password = \Yii::$app->security->generatePasswordHash($adminUser['password']);
                    $model->auth_key = \Yii::$app->security->generateRandomString();
                }
                if($model->save()){
                    return $this->redirect(['index', 'id' => $model->id]);
                }
            }
        }else{
            Yii::$app->getSession()->setFlash('error', '你只能修改自己的信息');
            return $this->redirect(['index', 'id' => $model->id]);
        }

        $model->password='';
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * 定义权限模型
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionChange(){
        $model = new PassWordForm();
        if($model->load(Yii::$app->request->post()) && $model->changePwd()){
                return $this->redirect(['site/index']);
        }
        return $this->render('change', [
            'model' => $model,
        ]);

    }





}