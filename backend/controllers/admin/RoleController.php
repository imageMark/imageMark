<?php
namespace backend\controllers\admin;
use backend\components\auth\AuthService;
use backend\controllers\base\BaseController;
use backend\models\admin\PermissionRole;
use backend\models\admin\SystemRoleSearch;
use backend\models\admin\SystemRole;
use yii;
use yii\web\NotFoundHttpException;
class RoleController extends BaseController{
    /**
     * 后台管理角色列表
     * @return string
     */
    public function actionIndex(){

        $searchModel = new SystemRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    /**
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException \yii\web\NotFoundHttpException
     */
    public function actionCreate(){
        $model = new SystemRole();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $authService = new AuthService($model);
            if($authService->createRolePermission()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            throw new NotFoundHttpException('create role auth fail.');
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return yii\web\Response
     */
    public function actionDelete($id){
        SystemRole::updateAll(['status'=>SystemRole::$drop_status],['id'=>$id]);
        return $this->redirect(['index']);
    }



    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $AuthService = new AuthService($model);
            if($AuthService->UpdateRole()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            throw new NotFoundHttpException('update fail.');
        } else {
            return $this->render('update', [
                'model' => $model,
                'Permission'=>PermissionRole::takePermissionByRole($id)
            ]);
        }
    }

    /**
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
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param $id
     * @return SystemRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemRole::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   

}