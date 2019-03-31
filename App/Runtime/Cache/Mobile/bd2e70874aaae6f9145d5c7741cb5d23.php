<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<script src="/Public/Admin/js/jquery.min.js"></script>
<script src="/Public/Admin/js/layer/layer.js"></script>
</head>
<body>
<?php if(isset($message)) {?>
	<script type="text/javascript">
	layer.alert("<?php echo($message); ?>", {
	  title: "<?php echo($message); ?>",
	  icon: 1,
	  content: '<a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>', 
	  skin: 'layer-ext-moon'
	}, function(){
		location.href = href;
		clearInterval(interval);
	});
	 </script>
<?php }else{?>
	<script type="text/javascript">
	layer.alert("<?php echo($error); ?>", {
	  title: "<?php echo($error); ?>",
	  icon: 2,
	  content: '<a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>', 
	  skin: 'layer-ext-moon'
	}, function(){
		location.href = href;
		clearInterval(interval);
	});
	 </script>
<?php }?>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>