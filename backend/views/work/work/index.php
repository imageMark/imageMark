<?php

use backend\models\project\Project;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $project Project */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我的工作区';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="box box-danger" >
        <div class="box-header with-border">
            <h3 class="box-title">我参与的项目</h3>

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

                if($project){
                    foreach ($project as $l){

                        ?>

                        <li>
                            <a href="<?=Url::to(['/work/work/file','id'=>$l['id']])?>">
                            <img alt="project" style="border-radius: unset;height: 220px;" src="<?=Url::to("@web/image/project.jpg")?>">
                            <span class="users-list-name" style="margin-top: 8px;"><?=$l['project_name']?></span>
                            </a>
                        </li>

                    <?php }}else{?>
                    暂时无项目
                <?php }?>

            </ul>
            <!-- /.users-list -->
        </div>
        <!-- /.box-body -->

    </div>


</div>
