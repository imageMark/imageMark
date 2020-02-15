<?php


namespace backend\models\customer;


use yii\data\ActiveDataProvider;

class OperationTypeSearch extends OperationType
{
    public $keywords;//搜索关键字


    public function scenarios()
    {
        $parent[self::SCENARIO_DEFAULT][] = 'keywords';
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
            $query->andFilterWhere(['like','operation_name',$this->keywords]);
        }

        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }
}