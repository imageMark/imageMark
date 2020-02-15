<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model \backend\models\admin\Permission*/
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxLength' => true])->label("权限名称") ?>

    <?= $form->field($model, 'permission')->textInput(['maxLength' => true])->label("权限规则") ?>

    <?= $form->field($model, 'permission_level')->dropDownList($model->PermissionLevel(),['maxLength' => true,'prompt'=>'请选择权限等级'])->label("权限等级") ?>

    <?= $form->field($model,'parent_id')->widget(\kartik\depdrop\DepDrop::classname(), [
        'options' => [
                'id'=>'name',
                'placeholder' => '请选择上级权限'
        ],
        'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['permission-permission_level'],
            'url' => \yii\helpers\Url::to(['admin/data/parent-permission']),
        ]])->label("上级权限")?>


    <?= $form->field($model, 'sort')->textInput(['maxLength' => true])->label("排序") ?>

    <?= $form->field($model, 'icon')->textInput(['maxLength' => true])->label("图标") ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>