<?php

use backend\models\admin\AdminSearch;
use backend\models\admin\SystemRole;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目管理';
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
                    'project_name',
                    ['attribute'=>'updated_at',
                        'format'=>['date','php:Y-m-d H:i:s'],
                    ],
                    ['attribute'=>'created_at',
                        'format'=>['date','php:Y-m-d H:i:s'],
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
                        'template' => '{view}{delete}',
                        'header'=>'操作',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('查看', ['view','id'=>$model->id],['class'=>'btn my-bg']);
                            },

                            'delete' => function ($url, $model) {

                                    return Html::a('删除', ['delete', 'id' => $model->id], [
                                        'class' => 'btn delete-bg',
                                        'data' => ['confirm' => '确认要删除用户信息吗？']
                                    ]);

                            },
                        ]
                    ],
                ],
            ]); ?>
        </section>
    </div>
</div>
