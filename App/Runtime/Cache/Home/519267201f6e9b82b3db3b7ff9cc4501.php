<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>钱包</title>
    
    <link rel="stylesheet" href="/Public/Login/css/wallet.css">
    
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">


    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
   
    <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
    <script src="/Public/Admin/js/jquery.js"></script>
	<!--layer弹窗插件-->
	<link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
	<script src="/Public/Login/layui/layui.js"></script>
    

</head>
<body>
        <div class="head">
                <a href="javascript:history.back(-1)"> 
                <i class="iconfont icon-xiaoyu">返回</i>
                </a>
                <p>我的钱包</p>
                <a href="<?php echo U('putforward');?>" class="right">提现</a>
        </div>
        <div class="wallet">
            
            <div class="asset">
                <p>总资产:<?php echo ($count); ?>元</p>
            </div>
            <div class="list-text">
                <div class="left">
                    <p>总收入</p>
                    <p><?php echo ($count); ?>元</p>
                </div>
                <div class="right-ri">
                    <p>已提现</p>
                    <p><?php echo ($d); ?>元</p>
                </div>
            </div>
        </div>
    </body>
</html>