<?php

use backend\models\project\Project;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model Project */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box">
    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['style' =>'background:white;padding:20px'],
        ]); ?>

        <?= $form->field($model, 'project_id')->hiddenInput(['maxlength' => true])->label(false) ?>

        <?= $form->field($model, 'file_id')->hiddenInput(['maxlength' => true])->label(false) ?>




        <?= $form->field($model, 'image_url')->widget(\kartik\file\FileInput::classname(), [
            'options' => ['multiple' => false,'prompt' => '请选择图片'],
            'name'=>'thumb',
            //'value'=>$model->thumb_key,
            'pluginOptions' => [
                'initialPreview'=>[
                    //$model->thumb_key?'<img src="'.$model->thumb_url.'" class="img-responsive">':''
                ],
                'allowedFileExtensions' => ['jpg', 'png','gif', 'jpeg'],
                'initialPreviewAsData'=>false,

                'initialPreviewConfig' => [

                ],
                'overwriteInitial'=>true,
                'uploadUrl' => \yii\helpers\Url::to(['/user/company/uploadimg','id'=>$model->id]),
                //'deleteUrl' => \yii\helpers\Url::to(['/user/company/deleteimg','id'=>$model->id]),
                // 最多上传的文件个数限制
                'maxFileCount' => 1,
                'showCaption'=>false,
                'showRemove' =>true,
                'showUpload' => false,
                'browseClass' => 'btn btn-success',
            ],

        ])->label('上传图片');?>

        <div class="form-group">
            <?= Html::submitButton('上传图片', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>