<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use backend\models\customer\Department;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>自主注册</title>

    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">



</head>
<style>
    .list-group-items{
        position: relative;
        display: block;
        padding: 5px 15px;
    }
    .list-group-items-top{
        font-size: 16px;
        color: #4A4A4A;
    }
    .divider{
        height: 1px;
        margin: 9px 0;
        overflow: hidden;
        background-color: #e5e5e5;
    }
</style>
<body>

<div class="container" style="background: #F8F8F8;">
    <div class="content">
        <ul class="list-group">
            <li class="list-group-items list-group-items-top">自主注册</li>
            <li class="divider"></li>
        </ul>

        <?php $form = \yii\widgets\ActiveForm::begin([
            'options' => ['style' =>'background:white;padding:20px'],
        ]); ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'style'=>'width:60%'])->label('手机号码') ?>
        <?= $form->field($model, 'truename')->textInput(['maxlength' => true,'style'=>'width:50%'])->label('真实姓名') ?>

        <?=$form->field($model,'department_id')->dropDownList(Department::takeDepartmentForSelect(),[
        ])->label('所在组织机构')?>

            <div class="form-group">
                <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
            </div>
        <?php \yii\widgets\ActiveForm::end(); ?>

    </div>

</div>


</body>
</html>
