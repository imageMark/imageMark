<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\user\user\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-header with-border">
    <?php $form = ActiveForm::begin([
        'options'=>['class'=>'form-inline','style'=>'margin:8px 10px;'],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= Html::textInput('keyword',$model->keyword,['class'=>'form-control','placeholder'=>' 请输入搜索关键字'])?>

    <?= Html::submitButton('搜索', ['class' => 'btn my-bg']) ?>
    <?= Html::a('添加权限', ['create'], ['class' => 'btn my-bg']) ?>


    <?php ActiveForm::end(); ?>

</div>