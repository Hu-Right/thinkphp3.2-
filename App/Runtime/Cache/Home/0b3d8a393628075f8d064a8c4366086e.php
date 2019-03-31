<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>提现</title>
   
    <link rel="stylesheet" href="/Public/Login/css/bring.css">
    <link rel="stylesheet" href="css/font/iconfont.css">

    
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
            <p>提现</p>
            <a href="<?php echo U('withdraw');?>" class="right">提现记录</a>
    </div>
 


     
    <div class="sum">
        <p>总资产:<?php echo ($count); ?></p>    
    </div>
 
     
     <form action="" method="POST">
    <div class="bank-te"> 
        <div class="bank-list">
            <span>提现金额</span>
            <input id="money" value="100"  type="number" name="money" step="100">
           
            <p>元</p>
        </div>
        <p class="pp">提示:满100才可提现,且是100的倍数,每笔三元手续费</p>
        <div class="button">
            <button type="submit" onclick="checkMoney()">确认提现</button>
        </div>
    </div> 
    
</form>
</body>

<script>

layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;   
});

//金额
 function checkMoney(){
    var re = /^[0-9]*[1-9][0-9]*$/ ;
    var money = document.getElementById('money').value;
    var s=money/100;
    if(money<100){
   layer.alert('提现金额需大于等于100', {
   icon: 2,  
});
    }else if(money%100 != 0){
        layer.alert('提现金额需大于等于100!'); 
       document.getElementById('money').value="";
    } 
    //     $.ajax({
    //     url:'<?php echo U("putforward");?>',
    //     type:'post',
    //     data:'money='+money,
    //     dataType:'html',
    //   success:function(data){
          
    //       if(data.status){

    //         layer.msg(data.message,{time:1000},function(){
	// 		 window.location.href = "<?php echo U('Perinfo/info');?>";
    //        });
    //       }

    //       }else
    //       {    
    //         layer.msg(data.message,{time:1000});  
        
    //       }
      
    //   });
//异步处理
// $.post("<?php echo U('putforward');?>",{money:money},function(data){	
	

//    if(data.status==2)
//    {
 
//     layer.alert(data.message,{time:1000});  
    

//    }

//    else if(data.status==3)
//    {
       
//     layer.alert(data.message,{time:1000});  

//    }


//     else if(data.status==0)
//     {    
//         layer.msg(data.message,{time:1000},function(){
//             window.location.href = "<?php echo U('Perinfo/info');?>";
//     });
//     }else
//     {    
//          layer.msg(data.message,{time:1000});
//          return false;    
//     } 

//     });

// return false;

//   }
 }
 
</script>

</html>