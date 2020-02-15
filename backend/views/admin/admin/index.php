<?php

use backend\models\admin\AdminSearch;
use backend\models\admin\SystemRole;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    th {text-align: center;}
</style>
<div class="content">
    <div class="box">
        <section class="box-header with-border">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </section>
        <!-- Main content -->
        <section class="content">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options'=>['class'=>'text-center'],
        'rowOptions'=>['style'=>'text-align:center;vertical-align:middle;'],
        'pager'=>[
            'firstPageLabel'=>"首页",
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            'lastPageLabel'=>'末页',
        ],
        'columns' => [
            'id',
            'username',


            ['attribute'=>'thumb_url',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->thumb_url?"<img style='width:40px;height:40px;border-radius:50%;' src='".$model->thumb_url."'>":"<div style='border-radius: 50%;height:40px;width:40px;line-height: 40px;margin-left: calc(50% - 20px);".
                        "background-color: #1890FF;color: #ffffff;'>".mb_substr($model->username,0,4)."</div>";
                }
            ],
            ['attribute'=>'updated_at',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            ['attribute'=>'created_at',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            ['attribute'=>'role_id',
                'value'=>function($data){
                    if($data->role_id==0){
                        return "超级管理员";
                    }else{
                        $result = SystemRole::findOne($data->role_id);
                        if($result) return $result->name;
                        return "无该角色名称";
                    }
                },
            ],
            [
                'attribute'=>'status',
                'label' => '状态',
                'value' =>function($data){
                    if($data->status ==1){
                        return "正常";
                    }else {
                        return "禁用";
                        //var_dump($model);exit;
                    }
                },
                'contentOptions'=>['width'=>'6%']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'header'=>'操作',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('查看', ['view','id'=>$model->id],['class'=>'btn my-bg']);
                    },
                    'update' => function ($url, $model) {
                        if($model->username!='admin') {
                            return Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn update-bg']);
                        }
                        return "";
                    },
                    'delete' => function ($url, $model) {
                         if($model->username!='admin') {
                             return Html::a('删除', ['delete', 'id' => $model->id], [
                                 'class' => 'btn delete-bg',
                                 'data' => ['confirm' => '确认要删除用户信息吗？']
                             ]);
                         }
                         return "";
                    },
                ]
            ],
        ],
    ]); ?>
        </section>
</div>
</div>
