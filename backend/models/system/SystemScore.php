<?php


namespace backend\models\system;


class SystemScore extends \common\models\SystemScore
{
    public static $urlType =[
        0=>'无需跳转',
        1=>'安全信息',
        2=>'视频学习',
        3=>'安全打卡',
        4=>'我要答题',
        5=>'问题反馈',
    ];

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'compamy_id' => '所属企业',
            'type_name' => '积分规则',
            'rule_description' => '积分规则描述',
            'description' => '描述',
            'score_type' => '积分类型',
            'url_type' => '跳转类型',
            'max_number' => '每日最大积分数',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '编辑时间',
        ];
    }

}