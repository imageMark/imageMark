<?php


namespace backend\models\customer;


use backend\models\answer\Clock;
use yii\data\ActiveDataProvider;

class ClockSearch extends Clock
{
    public $keywords;//搜索关键字

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $parent[self::SCENARIO_DEFAULT][] = 'keywords';
        return $parent;
    }

    /**
     * @param $params
     * @param $id
     * @return ActiveDataProvider
     * @throws \Exception
     */
    public function search($params,$id)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->select('*')->andFilterWhere([
                'customer_id'=>$id,
                'status'=>1
            ]),
            'pagination' => [
                'pagesize' =>'10',
            ]
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->addOrderBy(['id'=>SORT_DESC]);
        return $dataProvider;
    }
}