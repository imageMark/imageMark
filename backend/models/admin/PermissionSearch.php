<?php
namespace backend\models\admin;
use yii\data\ActiveDataProvider;

class PermissionSearch extends Permission{

    public $keyword;//搜索关键字
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $parent[self::SCENARIO_DEFAULT][] = 'keyword';
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
        if (!($this->load($params,'') && $this->validate())) {
            return $dataProvider;
        }
        //状态
        $query->andFilterWhere(['status'=>1]);
        //关键词
        if($this->keyword){
            $query->andFilterWhere(['like','name',$this->keyword]);
        }
        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }







}