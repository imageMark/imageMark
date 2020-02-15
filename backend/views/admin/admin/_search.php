<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\admin\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-user-search">

    <?php $form = ActiveForm::begin([
        'options'=>['class'=>'form-inline','style'=>'margin:8px 10px;'],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'keywords')->label(false)->textInput(['class'=>'form-control','placeholder' => "请输入用户名查询..."]) ?>

    <?=$form->field($model,'admin_status')->label(false)->dropDownList([1=>'正常',5=>'禁用'],['class'=>'form-control','prompt' => "请选择管理员状态查询..."])?>
    <div class="form-group" style="vertical-align: top">
        <?= Html::submitButton('搜索', ['class' => 'btn my-bg']) ?>
        <?= Html::a('添加', ['create'], ['class' => 'btn my-bg'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
