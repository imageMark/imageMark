<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model \backend\models\admin\SystemRole*/
$this->title = '添加角色';
$this->params['breadcrumbs'][] = '用户管理';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header with-border">

    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>