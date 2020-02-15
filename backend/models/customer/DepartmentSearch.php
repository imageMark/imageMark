<?php


namespace backend\models\customer;


use yii\data\ActiveDataProvider;

class DepartmentSearch extends Department
{
    public $keywords;//搜索关键字
    public $selectStatus;//状态


    public function scenarios()
    {
        $parent[self::SCENARIO_DEFAULT][] = 'keywords';
        $parent[self::SCENARIO_DEFAULT][] = 'selectStatus';
        return $parent;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
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
            $query->andFilterWhere(['like','name',$this->keywords]);
        }

        if($this->selectStatus){
            $query->andFilterWhere(['status'=>$this->selectStatus]);
        }
        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }
}