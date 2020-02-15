<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = '欧依安盾AI数据标注系统';
$this->title = '欧依安盾AI数据标注系统';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/jquery.selectareas.js');
$this->registerCssFile('@web/css/jquery.selectareas.css');
?>
<style>
    .bg-video{background-color: #448AFF;color: #ffffff;}
    .info-box-number{margin-top: 15px;}
</style>
<script src="js/jquery.selectareas.js" type="text/javascript"></script>
<link href="css/jquery.selectareas.css" rel="stylesheet">
<!-- Main content -->
<section class="content">

    <div class="content">

        <img class="border" id="img" src='<?=Url::to("@web/data/pexels-photo-60091.jpg")?>' />
    </div>
</section>
<script type="text/javascript">

    $(document).ready(function () {

        $('#img').imgAreaSelect({

            handles: true,

            onSelectEnd: function (e) {
                
            }

        });

    });

</script>