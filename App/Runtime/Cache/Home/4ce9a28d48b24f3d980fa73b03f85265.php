<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>任务记录</title>  
   <link rel="stylesheet" href="/Public/Login/css/submit1.css">
 <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
  <!--其他插件-->
  <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <script src="/Public/Admin/js/jquery.js"></script>
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/> 
  <script src="/Public/Login/layui/layui.js"></script>
</head>
<body>
    <div class="centre">
        <a href="javascript:history.back(-1)"> 
            <i class="iconfont   icon-xiaoyu">返回</i>
        </a>
        <p>提交任务</p>
    </div>
    <div class="aud" style="margin-top: 3rem;">
    <?php if(is_array($stlist)): $i = 0; $__LIST__ = $stlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="audit" style="height: 7rem;">
        
        <!-- <span id="localtime"><?php echo ($time=date("Y-m-d H:i:s",time())); ?></span> -->

        <!-- <p>任务名称:<?php echo ($data["taskname"]); ?></p> -->
       
        <!-- <p>任务状态:<span class="spn"><?php if($data['taskstatus']==1):?>审核中<?php endif; if($data['taskstatus']==2):?>未通过<?php endif; if($data['taskstatus']==3):?>已结算<?php endif;?></span></p> -->

        <!-- <p>提交时间:<?php echo (date("Y-m-d H:i:s",$data["stime"])); ?></p> -->

        <p class="min"><?php echo ($data["money"]); ?></p>  
     </div><?php endforeach; endif; else: echo "" ;endif; ?> 
</div>
<!-- <?php if(is_array($date)): foreach($date as $key=>$vo): ?><p class="renmin">¥<?php echo ($vo["id"]); ?></p>
<p class="renmin">¥<?php echo ($vo["type"]); ?></p><?php endforeach; endif; ?>  -->
 
  <script>
                function showLocale(objD)
                {
                    // var str,colorhead,colorfoot;
                    var str;
                    var yy = objD.getYear();
                    if(yy<1900) yy = yy+1900;
                    var MM = objD.getMonth()+1;
                    if(MM<10) MM = '0' + MM;
                    var dd = objD.getDate();
                    if(dd<10) dd = '0' + dd;
                    var hh = objD.getHours();
                    if(hh<10) hh = '0' + hh;
                    var mm = objD.getMinutes();
                    if(mm<10) mm = '0' + mm;
                    // var ss = objD.getSeconds();
                    // if(ss<10) ss = '0' + ss;
                    // var ww = objD.getDay();
                    // if  ( ww==0 )  colorhead="<font color=\"#FF0000\">";
                    // if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#666\">";
                    // if  ( ww==6 )  colorhead="<font color=\"#008000\">";
                    // if  (ww==0)  ww="星期日";
                    // if  (ww==1)  ww="星期一";
                    // if  (ww==2)  ww="星期二";
                    // if  (ww==3)  ww="星期三";
                    // if  (ww==4)  ww="星期四";
                    // if  (ww==5)  ww="星期五";
                    // if  (ww==6)  ww="星期六";
                    // colorfoot="</font>";
                    // str = colorhead + yy + "年-" + MM + "月-" + dd + "日 " + ww + "  "+ hh + ":" + mm + ":" + ss;
                    str = yy + "-" + MM + "-" + dd + " " + hh + ":" + mm;
                    return(str);
                }
                function tick()
                {
                    var today;
                    today = new Date();
                    document.getElementById("localtime").innerHTML = showLocale(today);
                    window.setTimeout("tick()", );
                }
                tick();
            </script>
</body>
</html>