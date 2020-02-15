<?php

use backend\models\project\Project;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $project Project */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目下文件分组';
$this->params['breadcrumbs'][] = ['label' => '我的工作区', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="box box-danger" >
        <div class="box-header with-border">
            <h3 class="box-title">我参与的项目<<<?=$project->project_name?>>></h3>

            <div class="box-tools pull-right">

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

                if($files){
                    foreach ($files as $l){

                        ?>

                        <li>
                            <a href="<?=Url::to(['/work/work/label','id'=>$l['id']])?>">
                                <img alt="project" style="border-radius: unset;" src="<?=Url::to("@web/image/files.jpg")?>">
                                <span class="users-list-name"><?=$l['file_name']?></span>
                            </a>
                        </li>

                    <?php }}else{?>
                    暂时无文件，请联系管理员添加文件夹上传数据
                <?php }?>

            </ul>
            <!-- /.users-list -->
        </div>
        <!-- /.box-body -->

    </div>


</div>
