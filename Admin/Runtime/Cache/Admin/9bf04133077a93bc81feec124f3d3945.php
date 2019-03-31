<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="renderer" content="webkit">

    <title>后台信息</title>

    <link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">

    <link rel="stylesheet" href="/Public/Admin/css/pintuer.css">

    <link rel="stylesheet" href="/Public/Admin/css/admin.css">

    <script src="/Public/Admin/js/jquery.js"></script>

    <script src="/Public/Admin/js/pintuer.js"></script>

  </head>
<body style="background: #edf1f5">
<style>
.two_zixun{margin:20px 0;}
.thumbnail{padding: 0;}
.thumbnail .caption {
    padding: 0.5em 1.2em;
    font-weight: bold;
}
.thumbnail .caption h3 {
    margin-top: 15px;
    font-weight: bold;
}
.flat-blue a {
    color: #363c46;
    font-weight: bold;
}
.bk-avatar img.bk-img-40 {
    width: 40px;
    height: 40px;
}
.panel-back {
    background-color: #929292;
}
.noti-box {
    min-height: 100px;
    color: #fff;
    padding: 20px;
}
.noti-box .icon-box {
    display: block;
    float: left;
    margin: 0 15px 10px 0;
    width: 70px;
    height: 70px;
    line-height: 75px;
    vertical-align: middle;
    text-align: center;
    font-size: 40px;
}
.bg-color-black {
    background-color: #424242;
    color: #fff;
}
.noti-box {
    /*min-height: 100px;*/
    color: #fff;
   /* padding: 20px;*/
}
.main-text {
    font-size: 25px;
    font-weight: 600;
}
  </style>
<div class="container-fluid">
<input type="hidden" value="<?php echo ($data["baodan"]); ?>" id="num">
<input type="hidden" value="<?php echo ($data["chonzhi"]); ?>" id="num1">
<input type="hidden" value="<?php echo ($data["tixian"]); ?>" id="num2">
<input type="hidden" value="<?php echo ($data["ganen"]); ?>" id="num3">
  <div class="four_box">
    <div class="row">
      <div class="col-md-3">
       <div class="sm-st bg_red clearfix">
          <span class="sm-st-icon st-red"><i class="iconfont icon-cart"></i></span>
          <div class="sm-st-info">
              <span id="count"></span>
              报单金额
          </div>
        </div>
      </div>
      <div class="col-md-3">
       <div class="sm-st bg_blue clearfix">
          <span class="sm-st-icon st-red"><i class="iconfont icon-dollar"></i></span>
          <div class="sm-st-info">
              <span id="count1"></span>
              充值金额
          </div>
        </div>
      </div>
      <div class="col-md-3">
       <div class="sm-st bg_green clearfix">
          <span class="sm-st-icon st-red"><i class="iconfont icon-comments"></i></span>
          <div class="sm-st-info">
              <span id="count2"></span>
              提现金额
          </div>
        </div>
      </div>
      <div class="col-md-3">
       <div class="sm-st bg_teal clearfix">
          <span class="sm-st-icon st-red"><i class="iconfont icon-attachment"></i></span>
          <div class="sm-st-info">
              <span id="count3"></span>
              重销额度
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="index_diagram">
    <div class="row">
      <div id="chartspie" class="col-md-6"></div>
      <div id="chartscolumn" class="col-md-6"></div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/Public/Admin/js/jquery1.js" ></script>
<script type="text/javascript" src="/Public/Admin/js/function.js" ></script>
<script type="text/javascript" src="/Public/Admin/js/highcharts.js" ></script>
<script language="javascript"> 

$(function() { 

   chart('chartscolumn',"column",['充值提现综合统计'],[{name:'总收入 <?php echo ($data["chonzhi"]); ?>',data:[<?php echo ($data["chonzhi"]); ?>]},{name:'总支出 <?php echo ($zongzhichu); ?>',data:[<?php echo ($zongzhichu); ?>]},{name:'利润 <?php echo ($lirun); ?>',data: [<?php echo ($lirun); ?>]},{name:'今日收支比例 <?php echo ($kzhi); ?>%',data: [<?php echo ($kzhi); ?>*1000]}]);

   chart('chartspie',"pie",['综合统计'],[['总收入',<?php echo ($shouru); ?>],['量碰奖',<?php echo ($data["liangpeng"]); ?>], ['重消奖',<?php echo ($data["ganen"]); ?>],['管理奖',<?php echo ($data["lingdao"]); ?>],['见点收益',<?php echo ($data["jiandian"]); ?>]]);

});

(function($){
    $.fn.numberRock=function(options){
        var defaults={
            lastNumber:100,
            duration:2000,
            easing:'swing'  //swing(默认 : 缓冲 : 慢快慢)  linear(匀速的)
        };
        var opts=$.extend({}, defaults, options);

        $(this).animate({
            num : "numberRock",
            // width : 300,
            // height : 300,
        },{
            duration : opts.duration,
            easing : opts.easing,
            complete : function(){
                console.log("success");
            },
            step : function(a,b){  //可以检测我们定时器的每一次变化
                // console.log(a);
                // console.log(b.pos);   //运动过程中的比例值(0~1)
                $(this).html(parseInt(b.pos * opts.lastNumber));
            }
        });

    }

})(jQuery);

$(function(){
  var num=$("#num").val();
  var num1=$("#num1").val();
  var num2=$("#num2").val();
  var num3=$("#num3").val();
  $("#count").numberRock({
    lastNumber:num,
    duration:5000,
    easing:'swing',  //慢快慢
  });
  $("#count1").numberRock({
    lastNumber:num1,
    duration:5000,
    easing:'swing',  //慢快慢
  });
  $("#count2").numberRock({
    lastNumber:num2,
    duration:5000,
    easing:'swing',  //慢快慢
  });
  $("#count3").numberRock({
    lastNumber:num3,
    duration:5000,
    easing:'swing',  //慢快慢
  });
});

</script>

</body>
</html>