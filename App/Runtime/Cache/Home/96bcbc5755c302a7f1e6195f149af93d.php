<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/Public/Login/css/team.css">    
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
    
    <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
    <script src="/Public/Admin/js/jquery.js"></script>
    <!--layer弹窗插件-->
    <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
    <script src="/Public/Login/layui/layui.js"></script>
    <script type="text/javascript">
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
 
        <div class="head">
                <a href="javascript:history.back(-1)"> 
                  <i class="iconfont icon-xiaoyu">返回</i>
                </a>
                <p>我的团队</p>
             </div>

<div class="list">
        <table>
             <tr>
                 <td><i class="iconfont icon-tuandui" style="color:#DE4410;"></i></td>
                 <td>一级会员</td>
                 <td style="color:red;">普通:<?php echo ($fdata["normal"]); ?>人</td>
                 <td style="color:red;">VIP:<?php echo ($fdata["vip"]); ?>人</td>
                 <td style="color:red;">黄金会员:<?php echo ($fdata["gold"]); ?>人</td>
             </tr>
              <tr>
                 <td><i class="iconfont icon-tuandui" style="color:#DE4410;"></i></td>
                 <td >二级会员</td>
                 <td style="color:red;">普通:<?php echo ($sdata["normal"]); ?>人</td>
                 <td style="color:red;">VIP:<?php echo ($sdata["vip"]); ?>人</td>
                 <td style="color:red;">黄金会员:<?php echo ($sdata["gold"]); ?>人</td>
             </tr>
         </table>
   
</body>
</html>

</div>