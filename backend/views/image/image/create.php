<?php

use backend\models\image\ProjectImage;
use backend\models\project\Project;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
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
            <div class="box">
                <div class="box-body">

                    <?php $form = ActiveForm::begin([
                        'options' => ['style' =>'background:white;padding:20px'],
                    ]); ?>


                    <?=$form->field($model,'project_id')->widget(Select2::className(),[
                        'data' => Project::takeProjectForSelect(),
                        'theme' => Select2::THEME_KRAJEE,
                        'options' => ['placeholder' => '请添加项目'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('所属项目')?>

                    <?=$form->field($model, 'file_id')->widget(DepDrop::className(),[
                        'options' => [
                            'id'=>'file_id',
                            'placeholder' => '请选择项目下的所属文件夹'
                        ],
                        'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions'=>[
                            'depends'=>['projectimage-project_id'],
                            'url' => \yii\helpers\Url::to(['image/image/file']),
                        ]
                    ])->label("选择存放文件夹")?>


                    <?= $form->field($model, 'image_url')->widget(\kartik\file\FileInput::classname(), [
                        'options' => ['multiple' => true,'prompt' => '请选择图片'],
                        'name'=>'image_url',
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
                            //'uploadUrl' => \yii\helpers\Url::to(['/user/company/uploadimg','id'=>$model->id]),
                            //'deleteUrl' => \yii\helpers\Url::to(['/user/company/deleteimg','id'=>$model->id]),
                            // 最多上传的文件个数限制
                            'maxFileCount' =>100,
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
