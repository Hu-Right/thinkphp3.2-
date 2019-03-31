<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>提现</title>
    
    <link rel="stylesheet" href="/Public/Login/css/withdraw.css">
  
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
       <p>提现记录</p>
    </div>
    <!-- <div class="list">     
        <ul>
            <li>会员手机号</li>
            <li>到账金额</li>
            <li>手续费</li>
            <li>到账时间</li>
            <li>时间</li>
        </ul>
    </div>  -->
    <div class="table">     
        <table class="table-list">
            <tr class="red"  style="color:red; ">
              <td >会员手机</td>
              <td>金额</td>
              <td>手续费</td>
              <td>时间</td>
            </tr>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>          
              <td><?php echo ($vo["email"]); ?></td>
              <td><?php echo ($vo["money"]); ?></td>
              <td><?php echo ($vo["shouxu"]); ?></td> 
              <td><?php echo ($vo["time"]); ?></td> 
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table> 
</div>
  
</body>
</html>