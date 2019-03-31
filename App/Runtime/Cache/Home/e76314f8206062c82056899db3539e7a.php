<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>下载</title>
    <!-- <link rel="stylesheet" href="/Public/Login/css/register.css"> -->
   
    <link rel="stylesheet" href="/Public/Login/css/xiazai.css">
    <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
    <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
    <script src="/Public/Admin/js/jquery.js"></script>
	<!--layer弹窗插件-->
	<link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/>
	<script src="/Public/Login/layui/layui.js"></script>	
</head>
<body>
        <div class="head">
                <p>微转达人</p>
            <span><a href="<?php echo U('registe');?>">•••</a></span>
      </div>
      <div class="tishi">
          <div class="rig">
              <img src="/Public/Login/img/tishi.png" alt="">
          </div>
      </div>
  
  
              <div class="loog">
                  <div class="img">
                     <img src="/Public/Login/css/log.png" alt="">  
                  </div>
              </div>


              <div class="btn">
                  <button class="left" onclick="an()">
                      
                      安卓下载
                  </button>
                  <button class="right" onclick="pi()"> 
                      
                      苹果下载
                  </button>
              </div>
</body>
<script>
layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form
});
    //     $('#regist').click(function rs() {
    //     var parent_id = $('input[name=parent_id]').val();
    //    var mobile = $("input[name='mobile']").val();
    //     var password  = $("input[name='password']").val();
    //     var passwords =$("input[name='passwords']").val();
    //     //js验证用户名和密码
    //     if(mobile == ''){
    //         layer.msg('请输入手机号');
    //         return false;
    //     }
    
//安竹
$('.left').click(function an(){
 window.location.href = "http://www.weizhuanwangzhuan.com/an/H52D87B18_0921192201.apk";
 
});
//苹果
$('.right').click(function pi(){

 window.location.href = "<?php echo U('Login/index');?>";

});






// <!-- 
// if(mobile && /^1[3|6|4|7|5|8]\d{9}$/.test(mobile)){
    
// }else{
// 	layer.msg('请输入正确的手机号码');  
//     return false;
// } -->
        // if(password == '') {
        //     layer.msg('请输入密码');
        //     return false;
        // }
        // if(passwords == '') {
        //     layer.msg('请输入确认密码');
        //     return false;
        // }
        // if(password!==passwords) { 
        //     layer.msg('密码与确认密码不一致');
        //     return false;

        // }
       
//异步处理
//  $.post("<?php echo U('registe');?>",{parent_id: parent_id, mobile:mobile, password:password},function(data){
//     if(data.status)
//     {
//       layer.msg(data.message,{time:1000});
//           return false;  
//    }if(data.status==0)
//     {
		 
// 			layer.msg(data.message,{time:1000},function(){
// 			 window.location.href = "<?php echo U('Login/index');?>";
// 		});
//         return false;
// 	 }else{
       
//         layer.msg(data.message,{time:1000});
//      } 
    
//  });
//  return false;

// });


</script>
</html>