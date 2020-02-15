<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = '修改密码 ' ;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<section class="content">
    <div class="box">
        <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'old_password')->label('输入原密码')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'new_password')->label('输入新密码')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'new_password_repeat')->label('确认新密码')->passwordInput(['maxlength' => true]) ?>


        <div class="form-group">
            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>


