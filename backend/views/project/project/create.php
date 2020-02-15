<?php
use backend\models\project\Project;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model Project */

$this->title = '添加项目';
$this->params['breadcrumbs'][] = ['label' => '项目管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
