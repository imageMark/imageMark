<?php

use backend\models\image\ProjectImage;
use backend\models\project\Project;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ProjectImage */

$this->title = '上传图片';
$this->params['breadcrumbs'][] = ['label' => '图片管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">图片</h3>
                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    </div>
                </div>
                <div class="box-body">
                <?php
                    $imageList = ProjectImage::find()->andFilterWhere([
                            'project_id'=>$model->project_id,
                            'file_id'=>$model->file_id
                    ])->limit(6)->orderBy(['created_at'=>SORT_DESC])->asArray()->all();
                    if($imageList){
                        foreach ($imageList as $image){
                ?>
                            <img alt="111" style="width: 60px;height: 60px;" src="<?=Url::to("@web".$image['image_url'])?>">
                <?php }}?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
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
        </div>
    </div>
</div>
