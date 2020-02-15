<?php


namespace backend\models\system;


use yii\data\ActiveDataProvider;

class SystemScoreSearch extends SystemScore
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
            'query' => $query->select('*'),
            'pagination' => [
                'pageSize' =>'10',
            ]
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->selectStatus){
            $query->andFilterWhere(['status'=>$this->selectStatus]);
        }

        if($this->keywords){
            $query->andFilterWhere(['like','type_name',$this->keywords]);
        }
        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }
}