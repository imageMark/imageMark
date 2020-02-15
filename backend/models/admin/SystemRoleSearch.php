<?php
namespace backend\models\admin;
use yii\data\ActiveDataProvider;

class SystemRoleSearch extends SystemRole{
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
     * 搜索
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
        //关键词
        if($this->keyword){
            $query->andFilterWhere(['like','name',$this->keyword]);
        }
        //有效角色
        $query->andFilterWhere(['status'=>self::$used_status]);
        //排序
        $query->addOrderBy(['id'=>SORT_DESC]);

        return $dataProvider;
    }

}