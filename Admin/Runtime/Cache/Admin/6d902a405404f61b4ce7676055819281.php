<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
	<title>公告</title>
    <link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
    <link rel="stylesheet" href="/Public/Admin/css/admin.css">
	<link rel="stylesheet" href="/Public/Admin/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/Public/Admin/kindeditor/plugins/code/prettify.css" />
    <script src="/Public/Admin/js/jquery.js"></script>
	<script charset="utf-8" src="/Public/Admin/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/Public/Admin/kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="/Public/Admin/kindeditor/plugins/code/prettify.js"></script>
	<link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/> 
  <script src="/Public/Login/layui/layui.js"></script>	

<script src="/Public/Admin/js/jquery.form.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '/Public/Admin/kindeditor/plugins/code/prettify.css',
				uploadJson : '/Public/Admin/kindeditor/php/upload_json.php',
				fileManagerJson : '/Public/Admin/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterBlur:function(){
                          this.sync();
                       },
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
		
	</script>
</head>
<body>
<style>
</style>
<div class="kind_content" style="width: 100%;padding:10px;">
	<form  enctype="multipart/form-data">
	    <div class="kind_title" style="margin-bottom:10px;">
		<span>请输入标题:</span><input type="text" name="biaoti" id="biaoti" style="min-width:300px;height:30px;margin-left:10px;">
		</div>
		<div class="kind_title" style="margin-bottom:10px;">
		<span>分类:</span>
		 <select name="catename" id="catename" style="min-width:300px;height:30px;margin-left:50px;">
		 	 <option value="">请选择</option>
		 	 <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cate_name"]); ?>"><?php echo ($vo["cate_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		 </select>
		</div>
		 <div class="kind_title" style="margin-bottom:10px;">
		<span>图片:</span>
         <input type="file" name="g_img" style="margin-left: 50px;" />
		</div> 
		<textarea name="content" style="width:80%;min-height:600px;visibility:hidden;" id="content"></textarea>
		<div class="kind_button" style="margin-top:10px;">
		<input type="submit"   id="btn" value="提交内容"/> (提交快捷键: Ctrl + Enter)
		</div>
	</form>
</div>
</body>
</html>
<script type="text/javascript">
 layui.use(['layer', 'form'], function(){
  var layer = layui.layer
  ,form = layui.form;   
}); 

$('form').submit(function (){
 $(this).ajaxSubmit({	
 		url:"<?php echo U('gonggao');?>",
		type:'post',
		datatype:'json',
		success:function (msg){
			 console.log(msg);
			if(msg.status==1){
			  layer.msg(msg.msg);
			}else{
			  layer.msg(msg.msg);
			}
		}
	});
 return false;
});
</script>