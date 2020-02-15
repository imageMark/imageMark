<?php

use backend\models\image\ProjectImage;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ProjectImage */

$this->title = "图片详情";
$this->params['breadcrumbs'][] = ['label' => '数据管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="box">
        <div class="box-body">
            <h2 class="page-header">
                <i class="fa fa-user"></i> <?=$model->image_name?>
                <small class="pull-right">创建于: <?=date('Y/m/d H:i')?></small>
            </h2>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'image_name',
                    ['attribute'=>'image_url',
                        'format'=>'raw',
                        'label' => '图片',
                        'value'=>function($model){
                            return $model->image_url?"<img width='120' height='120' src='".Url::to("@web".$model->image_url)."'>":"未设置";
                        }
                    ],
                    [
                        'attribute'=>'status',
                        'label'=>'状态',
                        'value'=>function($model){
                            return Yii::$app->params['statusType'][$model->status];
                        }
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