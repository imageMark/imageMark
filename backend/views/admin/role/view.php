<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model \backend\models\auth\Role*/
$this->title = '详情';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-body">
        <h2 class="page-header">
            <i class="fa fa-user"></i> <?=$model->name?>
            <small class="pull-right">创建于: <?=date('Y/m/d H:i',$model->created_at)?></small>
        </h2>
        <?=DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'remark',
                ['attribute'=>'created_at',
                    'value'=>date("Y-m-d ",$model->created_at)
                ],
                ['attribute'=>'updated_at',
                    'value'=>date("Y-m-d ",$model->updated_at)
                ],
            ],
        ]) ?>

    </div>

    <div class="box-footer">
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除将导致部分数据失效，确认删除？',
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>