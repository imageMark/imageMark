<?php

use backend\models\project\Project;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
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

    <?= $form->field($model, 'keywords')->label(false)->textInput(['class'=>'form-control','placeholder' => "请输入关键字查询..."]) ?>


    <?=$form->field($model,'project')->widget(Select2::className(),[
        'data' => Project::takeProjectForSelect(),
        'theme' => Select2::THEME_KRAJEE,
        'options' => ['placeholder' => '请选择项目'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false)?>

    <?=$form->field($model,'file')->widget(DepDrop::className(),[
        //'data'=> [6 =>'Bank'],
        'options' => [
            'id'=>'file_id',
            'placeholder' => '请选择项目下的所属文件夹'
        ],
        'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['projectimagesearch-project'],
            'url' => \yii\helpers\Url::to(['image/image/file']),
        ]
    ])->label(false)?>

    <?=$form->field($model,'image_status')->label(false)->dropDownList([1=>'未标注',5=>'已标注',8=>'已审核'],['class'=>'form-control','prompt' => "请选择图片状态查询..."])?>
    <div class="form-group" style="vertical-align: top">
        <?= Html::submitButton('搜索', ['class' => 'btn my-bg']) ?>
        <?= Html::a('上传图片', ['create'], ['class' => 'btn my-bg'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
if($model->file){ ?>
    <script>
        $("#file_id").select()
    </script>
<?php }?>
