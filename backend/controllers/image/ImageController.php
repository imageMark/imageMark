<?php
namespace backend\controllers\image;
use backend\models\image\ProjectImage;
use backend\models\image\ProjectImageSearch;
use backend\models\project\ProjectFiles;
use Yii;
use backend\controllers\base\BaseController;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ImageController extends BaseController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate(){
        $model = new ProjectImage();
        if ($model->load(Yii::$app->request->post())) {
            $files = UploadedFile::getInstances($model,'image_url');
            if($files) {
                foreach ($files as $file) {
                    $imageModel = new ProjectImage();
                    $fileModel = ProjectFiles::findOne($model->file_id);
                    $imageName = time() . rand(1000, 9999) . "." . $file->extension;
                    $path = Yii::$app->basePath . "/web/data/project" . $model->project_id . "/" . $fileModel->file_name . "/" . $imageName;
                    $file->saveAs($path);
                    $imageModel->image_name = $imageName;
                    $imageModel->project_id = $model->project_id;
                    $imageModel->file_id = $model->file_id;
                    $imageModel->image_url = "/data/project" . $model->project_id . "/" . $fileModel->file_name . "/" . $imageName;
                    $imageModel->save(false);
                }
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id){
        return $this->render('view1', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return ProjectImage|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = ProjectImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * find file in project
     */
    public function actionFile(){
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $level = empty($ids[0]) ? null : $ids[0];
            if ( $level != null) {
                $res = [];
                $data = ProjectFiles::find()->select(['id','file_name as name'])->andFilterWhere([
                    'project_id'=>$level,'status'=>1
                ])->asArray()->all();
                echo Json::encode(['output' => $data, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }


    public function actionCreate1($project_id,$file_id){
        $model = new ProjectImage();
        $model->project_id = $project_id;
        $model->file_id = $file_id;
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model,'image_url');
            if($file){

                $fileModel = ProjectFiles::findOne($file_id);
                $imageName = time().rand(1000,9999).".".$file->extension;
                $path = Yii::$app->basePath."/web/data/project".$project_id."/".$fileModel->file_name."/".$imageName;
                $file->saveAs($path);
                $model->image_name = $imageName;
                $model->image_url = "/data/project".$project_id."/".$fileModel->file_name."/".$imageName;
            }
            if($model->save(false)){
                $model = new ProjectImage();
                $model->project_id = $project_id;
                $model->file_id = $file_id;
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

}