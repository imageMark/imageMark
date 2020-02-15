<?php
namespace backend\models\admin;
use yii\data\ActiveDataProvider;

class AdminSearch extends Admin{

    public $keywords;//搜索关键字
    public $admin_status;//管理员状态
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keywords'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $parent[self::SCENARIO_DEFAULT][] = 'keywords';
        $parent[self::SCENARIO_DEFAULT][] = 'admin_status';
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
            $query->andFilterWhere(['like','username',trim($this->keywords)]);
        }
        //状态
        if($this->admin_status){
            $query->andFilterWhere(['status'=>$this->admin_status]);
        }
        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }

}