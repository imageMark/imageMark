<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */
?>
<style>
    .sidebar-toggle:hover{background-color: #ffffff!important;}
    .my-bg{background-color: #1890FF;border-color: #1890FF;color: #ffffff;}
    .my-bg:hover{background-color: #F6635F;border-color:#F6635F;color: #ffffff;}
    .update-bg{background-color: #F6635F;border-color: #F6635F;color: #ffffff;margin-left: 5px;}
    .update-bg:hover{background-color: #F6635F;border-color:#F6635F;color: #ffffff;}
    .delete-bg{background-color: #DFDFDF;border-color: #DFDFDF;color: #4A4A4A; margin-left: 5px;}
    .delete-bg:hover{background-color: #F6635F;border-color:#F6635F;color: #ffffff;}
    .box.box-cnpo{border-top-color: #1890FF;}
    th>a{color:#1890FF !important; }
    th>a :hover{color:#F6635F !important; }
    .breadcrumb li a{color:#1890FF !important;}
    .breadcrumb .active{color:#F6635F !important; }
    .sidebar-menu.active {
        background-color: #2672ec !important;
    }
    .sidebar>li>.active{background-color: #2672ec !important;}
    .table>tbody>tr>td{vertical-align:middle;}
</style>
<header class="main-header" >
    <!--header左侧-->
    <a href="<?=Yii::$app->homeUrl?>" class="logo" style='background-color: #001529!important;'>
        <span class="logo-mini">
            <img height="45px" width="45px" src="<?=Url::to('@web/image/logo.png')?>" alt="User Image">
        </span>
        <span class="logo-lg">
        <img height="35px" width="35px" src="<?=Url::to('@web/image/logo.png')?>" alt="User Image" >
            <?= Yii::$app->name?>
        </span>
    </a>
    <!--header左侧-->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #ffffff;">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="color: #001529!important;">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!--系统消息-->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o" style="color:#2672ec!important; "></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                        </li>
                        <li class="footer"><a href="#">全部</a></li>
                    </ul>
                </li>
                <!--系统消息-->
                <!--管理员-->
                <li class="dropdown user user-menu" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#000000 !important;">
                        <img src="<?=Url::to('@web/image/logo.png') ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->getUser()->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: auto;">
                            <img src="<?=Url::to('@web/image/admin.png') ?>" class="img-circle"
                                 alt="User Image"/>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    '修改密码',
                                    ['/admin/admin/change'],
                                    [ 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    '退出登录',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!--管理员-->

            </ul>
        </div>
    </nav>
</header>
