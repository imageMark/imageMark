<?php


namespace backend\models\image;


use yii\data\ActiveDataProvider;

class ProjectImageSearch extends ProjectImage
{
    public $keywords;//搜索关键字
    public $image_status;//管理员状态
    public $project;//所属项目
    public $file;//项目下的文件夹
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keywords'],'string'],
            [['project','file'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $parent[self::SCENARIO_DEFAULT][] = 'keywords';
        $parent[self::SCENARIO_DEFAULT][] = 'image_status';
        $parent[self::SCENARIO_DEFAULT][] = 'project';
        $parent[self::SCENARIO_DEFAULT][] = 'file';
        return $parent;
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->select('*')
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        //关键词
        if($this->keywords){
            $query->andFilterWhere(['like','image_name',trim($this->keywords)]);
        }
        //状态
        if($this->image_status){
            $query->andFilterWhere(['status'=>$this->image_status]);
        }
        //所属项目
        if($this->project){
            //echo $this->project;exit;
            $query->andFilterWhere(['project_id'=>$this->project_id]);
            //所属文件夹
            if($this->file){
                echo $this->file;exit;
                $query->andFilterWhere(['file_id'=>$this->file_id]);
            }
        }

        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }

}