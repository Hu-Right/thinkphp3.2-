<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>推广二维码</title>
     
    <link rel="stylesheet" href="/Public/Login/css/codes.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
    <!--其他插件样式-->
   <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <script src="/Public/Admin/js/jquery.js"></script>
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
  <script src="/Public/Login/layui/layui.js"></script> 
    <script src="/Public/Login/js/qrcode.js"></script> 

    <script>
        (function (n, e) {
        var t = n.documentElement, i = "orientationchange" in window ? "orientationchange" : "resize", d = function () {
        var n = t.clientWidth;
        n && (t.style.fontSize = n / 7.5 + "px")
        };
        n.addEventListener && (e.addEventListener(i, d, !1), n.addEventListener("DOMContentLoaded", d, !1))
        })(document, window);
    </script>

</head>
<body>
       <div class="header">
        <a href="<?php echo U('Index/index');?>"> 
          <i class="iconfont icon-xiaoyu">返回</i>
        </a>
        <p>推广二维码123</p>
     </div>
     <div class="genlize">
          
        <div id="code"></div>
     </div>
 <script>
        function makeQRcode(){
  　　　　var qrcode = new QRCode(document.getElementById("code"), );
      　　 qrcode.makeCode("http://baidu.com");
        }
        makeQRcode();
     </script>
</body>
</html>