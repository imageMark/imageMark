<?php

use backend\models\admin\AdminSearch;
use backend\models\admin\SystemRole;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '数据管理';
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
                    'image_name',
                    ['attribute'=>'image_url',
                        'format'=>'raw',
                        'value'=>function($model){
                            return "<img style='width:40px;height:40px;border-radius:50%;' src='".Url::to("@web".$model->image_url)."'>";

                        }
                    ],
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
                            //return $data->status;
                            switch ($data->status) {
                                case 1:
                                    return "未标注";break;
                                case 5:
                                    return "已标注";break;
                                case 8:
                                    return "完成";break;
                                default:
                                    return "未知状态";
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
                                if($model->status==5) {
                                    return Html::a('审核', ['check', 'id' => $model->id], [
                                        'class' => 'btn delete-bg',
                                        'data' => ['confirm' => '确认要删除用户信息吗？']
                                    ]);
                                }

                            },
                        ]
                    ],
                ],
            ]); ?>
        </section>
    </div>
</div>
