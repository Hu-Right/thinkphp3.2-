<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>微转客服</title>
   <link rel="stylesheet" href="/Public/Login/css/service.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
    <!--其他插件样式-->  
  
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
        <p>客服中心</p>
    </div>
    <div class="service">
            <p>微转客服一</p>
            <div id="code"></div>
            <span>长按识别或保存到手机</span>
    </div>
    <div class="serv">
            <p>微转客服二</p>
            <div id="codeic"></div>
            <span>长按识别或保存到手机</span>
    </div>
 
<script src="/Public/Login/js/qrcode.js"></script>
   
<script>
         function makeQRcode(){

 　　　　var qrcode = new QRCode(document.getElementById("code"), );
     　　 qrcode.makeCode("http://baidu.com");

       }
       makeQRcode();
        function make(){

 　　　　var qrcode = new QRCode(document.getElementById("codeic"), );
     　　 qrcode.makeCode("http://baidu.com");

       }
       make();
</script>
</body>
</html>