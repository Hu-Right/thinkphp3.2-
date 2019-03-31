<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>领取任务</title>
    <link rel="stylesheet" href="/Public/Login/css/gettask.css">
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
        <p>领取任务</p>
    </div>
    <div class="img">
        <img src="/Public/Login/img/gettask.png" alt="">
    </div>

    <div class="get-list">
      
        <div class="date" id="localtime">
                <span id="localtime"><?php echo ($time=date("Y-m-d",time())); ?></span>
            <!-- <script>
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
                    // var hh = objD.getHours();
                    // if(hh<10) hh = '0' + hh;
                    // var mm = objD.getMinutes();
                    // if(mm<10) mm = '0' + mm;
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
                    str = yy + "-" + MM + "-" + dd;
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

            </script> -->
        </div>
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="get ">              
                <p>
                        <?php echo ($vo["cname"]); ?>
                        <!-- <?php if(($vo["status"] != 1)): echo ($vo["cname"]); ?>
                            </else>暂无任务<?php endif; ?> -->
                         
                    </p>
                    
                <button><a href="<?php echo U('getones',array('id'=>$vo['id']));?>" style="color:#ffff">点击领取</a></button>            
            </div><?php endforeach; endif; ?> 
    </div>
    <div class="text">
        <p>任务领取规则:</p>
        <span>1.VIP会员了领取每天两条朋友圈发布任务</span><br>
        <span>2.发布任务时必须与平台的内的文案和图片一致<br>
        &nbsp;【个人邀请好友海报图+产品图2张】
        </span><br>
        <span>3.不得屏蔽微信好友查看您的朋友圈</span>
    </div>
</body>
</html>