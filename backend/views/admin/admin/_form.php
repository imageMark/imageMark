<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model \backend\models\admin\Admin */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content">
<div class="admin-user-form">

    <?php $form = ActiveForm::begin([
        'options' => ['style' =>'background:white;padding:20px'],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb_key')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['multiple' => false,'prompt' => '请选择图片'],
        'name'=>'thumb',
        'value'=>$model->thumb_key,
        'pluginOptions' => [
            'initialPreview'=>[
                $model->thumb_key?'<img src="'.$model->thumb_url.'" class="img-responsive">':''
            ],
            'allowedFileExtensions' => ['jpg', 'png','gif', 'jpeg'],
            'initialPreviewAsData'=>false,

            'initialPreviewConfig' => [

            ],
            'overwriteInitial'=>true,
            //'uploadUrl' => \yii\helpers\Url::to(['/user/company/uploadimg','id'=>$model->id]),
            'deleteUrl' => \yii\helpers\Url::to(['/user/company/deleteimg','id'=>$model->id]),
            // 最多上传的文件个数限制
            'maxFileCount' => 1,
            'showCaption'=>false,
            'showRemove' =>true,
            'showUpload' => false,
            'browseClass' => 'btn btn-success',


        ],

    ])->label('上传头像');?>

    <?= $form->field($model,'status')->dropDownList(Yii::$app->params['statusType'],['prompt'=>'请选择状态'])?>

    <?= $form->field($model,'role_id')->dropDownList(\backend\models\admin\SystemRole::takeRoleForSelect(),['prompt'=>'请选择角色'])?>


    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>