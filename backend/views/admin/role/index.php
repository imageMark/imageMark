<?php
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \backend\models\admin\SystemRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = '角色管理';
$this->params['breadcrumbs'][]='管理员管理';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => '第一页',
            'lastPageLabel' => '最后一页',
        ],
        'options' => [ 'style' => 'text-align: center;','class'=>'box-body'],
        'columns' => [
            [
                'attribute'=>'id',
                'headerOptions' => [ 'style' => 'text-align: center;'],
                'value'=>'id',
                'header'=>'ID',
            ],
            [
                'attribute'=>'name',
                'headerOptions' => [ 'style' => 'text-align: center;'],
                'value'=>'name',
                'header'=>'角色名称',
            ],

            [
                'attribute'=>'created_at',
                'headerOptions' => [ 'style' => 'text-align: center;'],
                'format'=>['date','php:Y-m-d H:i:s'],
                'header'=>'创建时间',
            ],[
                'attribute'=>'updated_at',
                'headerOptions' => [ 'style' => 'text-align: center;'],
                'format'=>['date','php:Y-m-d H:i:s'],
                'header'=>'编辑时间',
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
                        return Html::a('编辑', ['update','id'=>$model->id],['class'=>'btn update-bg']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('删除', ['delete','id'=>$model->id],[
                            'class'=>'btn delete-bg',
                            'data'=>['confirm'=>'确认要删除用户信息吗？']
                        ]);
                    },
                ]
            ]
        ],
    ]);?>
</div>
