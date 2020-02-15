<?php
namespace backend\controllers\work;
use backend\controllers\base\BaseController;
use backend\models\image\ProjectImage;
use backend\models\project\Project;
use backend\models\project\ProjectAdmin;
use backend\models\project\ProjectFiles;
use Yii;
use yii\helpers\Json;

class WorkController extends BaseController
{

    /**
     * 我的工作区
     * @return string
     */
    public function actionIndex(){
        $userId = Yii::$app->user->id;
        if($userId==2){
            $project = Project::find()->andFilterWhere(['status'=>1])->all();
        }else{
            $project = Project::find()->from(Project::tableName()." A")
                ->select(['A.id','A.project_name'])
            ->leftJoin(ProjectAdmin::tableName()." B","A.id = B.project_id adn B.project_admin = $userId")
            ->all();

        }
        return $this->render('index',
            ['project'=>$project]);
    }

    /***
     * 项目下的文件夹
     * @param $id
     * @return string
     */
    public function actionFile($id){
        $files = ProjectFiles::find()->andFilterWhere([
            'project_id'=>$id,'status'=>1
        ])->asArray()->all();
        $project = Project::findOne($id);
        return $this->render('file',
            ['files'=>$files,'project'=>$project]);
    }

    /**
     * 标注图片
     * @param $id
     * @return string
     */
    public function actionLabel($id){
        $imageNum = ProjectImage::find()->andFilterWhere([
            'status'=>1,'file_id'=>$id
        ])->count();
        if($imageNum<1){
            return $this->render('complete');
        }else{
            $image = ProjectImage::find()->andFilterWhere([
                'status'=>1,'file_id'=>$id
            ])->offset(rand(0,$imageNum-1))->limit(1)->one();
            $image->status = 3 ;
            $image->save(false);
            return $this->render('label',[
                'image'=>$image,
                'id'=>$id,
                'model'=>new ProjectImage()
            ]);
        }
    }


    public function actionSubmit($id){
        $model = new ProjectImage();
        if($model->load(Yii::$app->request->post())){
            $data = Json::decode($model->image_annotation);
            $imageId = Yii::$app->request->post()[$model->formName()]['id'];
            $image = ProjectImage::findOne($imageId);
            $image->image_annotation = serialize($data['annotations'][0]);
            $image->label_user = Yii::$app->user->id;
            $image->status = 5;
            if($image->save()){
                $this->redirect(['label','id'=>$id]);
            }
             echo "失败";
        }
        echo "没有数据";
    }

    public function actionTest()
    {

        return $this->render('test');
    }
}