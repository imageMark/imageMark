<?php

use backend\models\admin\Admin;
use backend\models\project\ProjectAdmin;
use backend\models\project\ProjectFiles;
use backend\models\project\ProjectLabel;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $Model ProjectAdmin*/
/* @var $Label ProjectLabel*/
/* @var $File ProjectFiles*/
$this->title = $model->project_name;
$this->params['breadcrumbs'][] = ['label' => '项目管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="box box-info">
                <div class="box-body">
            <h2 class="page-header">
                <i class="fa fa-user"></i> <?=$model->project_name?>
                <small class="pull-right">创建于: <?=date('Y/m/d H:i')?></small>
            </h2>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'project_name',
                    'description',
                    'operator_id',
                    ['attribute'=>'updated_at',
                        'format'=>['date','php:Y-m-d H:i:s'],
                    ],
                    ['attribute'=>'created_at',
                        'format'=>['date','php:Y-m-d H:i:s'],
                    ],
                ],
            ]) ?>
        </div>
            </div>

            <!--files manager-->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">项目文件夹管理</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="height: 420px;">
                    <ul class="users-list clearfix">
                        <?php $files = ProjectFiles::find()->andFilterWhere(['project_id'=>$model->id])
                                ->andFilterWhere(['status'=>1])->all();
                        if($files){
                            foreach ($files as $f){
                        ?>
                        <li>
                            <a href="<?=Url::to(['/image/image/create','project_id'=>$model->id,'file_id'=>$f->id])?>">
                            <img style="border-radius: unset;" src="<?=Url::to("@web/image/files.jpg")?>" alt="User Image">
                            <span class="users-list-name" href="#"><?=$f->file_name?></span>
                            <span class="users-list-date"><?=date("Y-m-d",$f->created_at)?></span>
                            </a>
                        </li>
                        <?php }}?>

                        <li style="line-height: 179px;font-size: 100px;color: #9B9B9B;border: #9B9B9B 1px ridge;"
                            data-toggle='modal' data-target='#addFile'>
                            +
                        </li>
                    </ul>
                </div>
            </div>
            <!--files manager-->
        </div>

        <div class="col-lg-4 col-md-4">

            <!--project admin-->
            <div class="box box-danger" >
                <div class="box-header with-border">
                    <h3 class="box-title">项目成员</h3>
                        <?php $user = ProjectAdmin::find()->andFilterWhere(['project_id'=>$model->id])
                            ->asArray()->all();?>
                    <div class="box-tools pull-right">
                        <span class="label label-danger"><?=count($user)?> 个成员</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="height: 300px;">
                    <ul class="users-list clearfix">
                        <?php

                        if($user){
                            foreach ($user as $u){
                                $admin = Admin::findOne($u['admin_id']);
                        ?>
                        <li>
                            <?=$admin->thumb_url?"<img style='width:40px;height:40px;border-radius:50%;' src='".$admin->thumb_url."'>":"<div style='border-radius: 50%;height:40px;width:40px;line-height: 40px;margin-left: calc(50% - 20px);".
                        "background-color: #1890FF;color: #ffffff;'>".mb_substr($admin->username,0,4)."</div>"?>
                            <a class="users-list-name" href="#"><?=$admin->username?></a>
                            <span class="users-list-date"><?=date("Ymd H:i",$u['created_at'])?></span>
                        </li>

                        <?php }}else{?>
                                暂时无项目成员
                        <?php }?>

                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#" data-toggle='modal' data-target='#addUser' class="uppercase">添加成员</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--project admin-->
             <!--project label-->
            <div class="box box-danger" >
                <div class="box-header with-border">
                    <h3 class="box-title">项目标签</h3>
                    <?php $label = ProjectLabel::find()->andFilterWhere(['project_id'=>$model->id])
                        ->asArray()->all();?>
                    <div class="box-tools pull-right">
                        <span class="label label-danger"><?=count($label)?> 个标签</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="height: 300px;">
                    <ul class="users-list clearfix">
                        <?php

                        if($label){
                            foreach ($label as $l){

                                ?>
                                <li>
                                            <?=$l['label_name']?>
                                </li>

                            <?php }}else{?>
                            暂时无项目标签
                        <?php }?>

                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#" data-toggle='modal' data-target='#addLabel' class="uppercase">添加标签</a>
                </div>
                <!-- /.box-footer -->
            </div>

            <!--project label-->
        </div>
    </div>
</div>


<!--项目成员模态框-->

<div class="modal fade bs-example-modal-lg" id="addUser" style="display: none;">
    <div class="modal-dialog modal-lg">
        <?php $form = ActiveForm::begin([
            'id' => 'selectCode',
            'action'=>['save','id'=>$model->id],
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加项目成员</h4>
            </div>
            <div class="modal-body">
                <?=$form->field($Model,'admin[]')->widget(Select2::className(),[
                    'data' => ProjectAdmin::takeProjectAdminForSelect(),
                    'theme' => Select2::THEME_KRAJEE,
                    'options' => ['placeholder' => '请添加项目成员','multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label('项目成员')?>

            </div>
            <div class="modal-footer">
                 <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.modal-dialog -->
</div>


<!--项目标注模态框-->

<div class="modal fade bs-example-modal-lg" id="addLabel" style="display: none;">
    <div class="modal-dialog modal-lg">
        <?php $form = ActiveForm::begin([
            'id' => 'selectCode',
            'action'=>['save-label','id'=>$model->id],
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加项目标签</h4>
            </div>
            <div class="modal-body">
                <?=$form->field($Label,'label_name')->textInput()->label('项目标签')?>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.modal-dialog -->
</div>


<!--项目文件夹模态框-->

<div class="modal fade bs-example-modal-lg" id="addFile" style="display: none;">
    <div class="modal-dialog modal-lg">
        <?php $form = ActiveForm::begin([
            'id' => 'selectCode',
            'action'=>['save-file','id'=>$model->id],
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">添加项目文件夹</h4>
            </div>
            <div class="modal-body">
                <?=$form->field($File,'file_name')->textInput()->label('项目文件夹')?>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.modal-dialog -->
</div>