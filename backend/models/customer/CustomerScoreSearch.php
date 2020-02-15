<?php


namespace backend\models\customer;


use common\models\CustomerScoreLog;
use yii\data\ActiveDataProvider;

class CustomerScoreSearch extends CustomerScoreLog
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
            'query' => $query->select('customer_id,SUM(score_number) as score_number,score_time')->andFilterWhere(['customer_id'=>$id]),
            'pagination' => [
                'pagesize' =>'10',
            ]
        ]);
        if (!($this->load($params) && $this->validate())) {
            $query->groupBy('score_time');
            return $dataProvider;
        }

        $query->addOrderBy(['id'=>SORT_DESC]);
        $query->groupBy('score_time');
        return $dataProvider;
    }

}