<?php
namespace backend\controllers\project;

use backend\controllers\base\BaseController;
use backend\models\project\Project;
use backend\models\project\ProjectAdmin;
use backend\models\project\ProjectFiles;
use backend\models\project\ProjectLabel;
use backend\models\project\ProjectSearch;
use Yii;
use yii\web\NotFoundHttpException;

class ProjectController extends BaseController
{
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->createFiles($model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionSave($id)
    {
        $data = Yii::$app->request->post('ProjectAdmin');
        if ($data['admin'] && count($data['admin']) > 0) {
            foreach ($data['admin'] as $val) {
                if ($model = ProjectAdmin::findOne(['project_id' => $id, 'admin_id' => $val])) {
                    continue;
                }
                $model = new ProjectAdmin();
                $model->project_id = $id;
                $model->admin_id = $val;
                $model->status = 1;
                $model->operator_id = Yii::$app->user->id;
                $model->save(false);
            }
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionSaveLabel($id)
    {
        $model = new ProjectLabel();
        $model->project_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionSaveFile($id)
    {
        $model = new ProjectFiles();
        $model->project_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->createFiles($id,$model->attributes['file_name']);
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->redirect(['view', 'id' => $id]);
    }


    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $basePath = Yii::$app->basePath;
        $dataPath = $basePath."/web/data";
        return $this->render('view', [
            'model' => $this->findModel($id),
            'Model'=>new ProjectAdmin(),
            'Label'=>new ProjectLabel(),
            'File'=>new ProjectFiles()
        ]);
    }

    /**
     * @param $id
     * @return Project|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $projectId
     * @param bool $fileName
     * @return bool
     */
    public function createFiles($projectId,$fileName = false){
        $basePath = Yii::$app->basePath;
        $dataPath = $basePath."/web/data";
        $projectName = "project".$projectId;
        $projectDir = $dataPath."/".$projectName;
        if($fileName){
            $fileDir = $projectDir."/".$fileName;
            if (!file_exists($fileDir)){
                if(mkdir ($fileDir,0777,true)) return true;
                echo "创建失败".$fileDir;exit;
            } else {
                return false;
            }
        }else{

            if (!file_exists($projectDir)){
                if(mkdir ($projectDir,0777,true)) return true;
                echo "创建失败".$projectDir;exit;
            } else {
                return false;
            }
        }
    }
}