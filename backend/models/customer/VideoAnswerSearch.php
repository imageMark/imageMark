<?php


namespace backend\models\customer;


use backend\models\answer\QuestionLog;
use yii\data\ActiveDataProvider;

class VideoAnswerSearch extends QuestionLog
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
            'query' => $query->select('*')->andFilterWhere(['customer_id'=>$id,'type'=>QuestionLog::$videoAnswerType]),
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