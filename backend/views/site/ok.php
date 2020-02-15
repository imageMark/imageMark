<?php

use yii\helpers\Url;

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>注册成功</title>

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
    .content{
        width: 100%;
        padding: 20px 10px;
    }
    .content p img{
        align-content: center;
        width: calc(100% - 48px);
    }
</style>
<body>

<div class="content" style="display: flex;flex-direction: column;align-items: center;">
    <h3 style="text-align: center">注册成功</h3>
    <div style="text-indent: 10px;">
        <span style="color: #0d6aad;">注册时间</span>
        <span style="color: #9B9B9B">|</span>
        <span style="color: #9B9B9B"><?=date("Y年m月d日",time())?></span>
    </div>
    <img style="margin-top: 20px;width: 300px;border-radius: 100%;height: 300px;" src="<?=Url::to("@web/image/login-bg.png")?>">
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

