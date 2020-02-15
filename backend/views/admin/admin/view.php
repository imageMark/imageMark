<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理员列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
<div class="box">
    <div class="box-body">
        <h2 class="page-header">
            <i class="fa fa-user"></i> <?=$model->username?>
            <small class="pull-right">创建于: <?=date('Y/m/d H:i')?></small>
        </h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nickname',
            ['attribute'=>'thumb_url',
                'format'=>'raw',
                'label' => '头像',
                'value'=>function($model){
                    return $model->thumb_url?"<img width='120' height='120' src='".$model->thumb_url."'>":"未设置";
                }
            ],
            [
                'attribute'=>'status',
                'label'=>'状态',
                'value'=>function($model){
                    return Yii::$app->params['statusType'][$model->status];
                }
            ],
            ['attribute'=>'role_id',
                'value'=>function($model){
                   if(!$model->role_id) return "超级管理员";
                   return $model->roleName->name;
                },
            ],
            ['attribute'=>'updated_at',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            ['attribute'=>'created_at',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>
    </div>


</div>
</div>