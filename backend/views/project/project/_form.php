<?php

use backend\models\project\Project;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model Project */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content">
    <div class="admin-user-form">

        <?php $form = ActiveForm::begin([
            'options' => ['style' =>'background:white;padding:20px'],
        ]); ?>

        <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('添加项目', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>