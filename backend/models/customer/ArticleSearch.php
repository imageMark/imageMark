<?php


namespace backend\models\customer;


use common\models\CustomerArticleLog;
use yii\data\ActiveDataProvider;

class ArticleSearch extends CustomerArticleLog
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$id)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query->select('*')->andFilterWhere(['customer_id'=>$id]),
            'pagination' => [
                'pagesize' =>'10',
            ]
        ]);
        if (!($this->load($params,'') && $this->validate())) {
            return $dataProvider;
        }
        //关键词
        if($this->keywords){
            $query->andFilterWhere(['like','truename',$this->keywords]);
        }
        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }

}