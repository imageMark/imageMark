<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>帮助</title>

    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    .list-group-items{
        position: relative;
        display: block;
        padding: 5px 15px;
    }
    .list-group-items-top{
        font-size: 16px;
        color: #4A4A4A;
    }
    .divider{
        height: 1px;
        margin: 9px 0;
        overflow: hidden;
        background-color: #e5e5e5;
    }
</style>
<body>

<div class="container" style="background: #F8F8F8;">
    <div class="row">
        <ul class="list-group">
            <li class="list-group-items list-group-items-top">常见问题</li>
            <li class="divider"></li>
            <li class="list-group-items" style="font-size: 14px;"><span style="color: #FF2D4B">Q：</span>一个手机号可以注册多少个账号？</li>
            <li class="list-group-items" style="color: #9B9B9B">目前一个手机可登陆或绑定一个账号。</li>
        </ul>
        <ul class="list-group">
            <li class="list-group-items" style="font-size: 14px;"><span style="color: #FF2D4B">Q：</span>如何修改密码？</li>
            <li class="list-group-items" style="color: #9B9B9B">1.修改位置：「我的」-「设置」-「账号密码绑定」-「更改密码」</li>
            <li class="list-group-items" style="color: #9B9B9B">2.两种方式：通过密码修改新密码；通过手机号修改密码</li>
        </ul>
        <ul class="list-group">
            <li class="list-group-items" style="font-size: 14px;"><span style="color: #FF2D4B">Q：</span>可以修改我的个人信息吗？</li>
            <li class="list-group-items" style="color: #9B9B9B">1.修改路径：「我的」-「头像」-修改信息</li>
            <li class="list-group-items" style="color: #9B9B9B">2.除绑定的企业信息外，您可以修改头像和昵称，性别，学历。</li>
        </ul>
        <ul class="list-group">
            <li class="list-group-items" style="font-size: 14px;"><span style="color: #FF2D4B">Q：</span>可怎样集齐所有勋章？</li>
            <li class="list-group-items" style="color: #9B9B9B">您好，勋章是您学习的重要证明，可以通过答题和累积学习时长的方式获得。请加油努力收集吧！</li>
        </ul>
        <ul class="list-group">
            <li class="list-group-items" style="font-size: 14px;"><span style="color: #FF2D4B">Q：</span>测一测是怎么回事，为什么有时我只要答一道，有时却让我回答三道？能不能重复测验？</li>
            <li class="list-group-items" style="color: #9B9B9B">1.首先回答您第一个问题：e安盾会在每日推送您一个问题进行测试，如果答题成功则无需再答，如果失败，需继续回答一道问题，成功即完成，如果再次失败，回答最后一个问题。最多为三道问题</li>
            <li class="list-group-items" style="color: #9B9B9B">2.第二个问题：“测一测”为每日推送题目，每日只能回答一次，暂无重复测验功能。</li>
        </ul>
    </div>

</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
