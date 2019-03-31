<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <title>阳光财富</title>
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <link rel="icon" type="image/png" href="assets/i/favicon.png">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <!--<link rel="apple-touch-icon-precomposed" href="/assets/i/app-icon72x72@2x.png">-->
    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="/assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">
    <link rel="stylesheet" href="/assets/css/amazeui.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/my.css"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="am-container">
    <div class="am-g" style="margin-top: 30%;">
        <div class="am-u-sm-centered am-u-sm-10" >
            <?php if(isset($message)) {?>
            <div class="am-panel am-panel-danger am-animation-shake">
            <div class="am-panel-hd">
            <h1 style="margin: 0px;" class="am-text-center ">阳光财富</h1>
            </div>
            <div class="am-panel-bd">
            <h2 class="am-text-danger"> <?php echo($message); ?></h2>
            <h4 class="am-text-danger">The system will automatically return in <b id="wait"><?php echo($waitSecond); ?></b> seconds or click <a  id="href" href="<?php echo($jumpUrl); ?>">Here</a> to return</h4>
            </div>
            </div>
            <?php }else{?>
            <div class="am-panel am-panel-primary am-animation-shake">
            <div class="am-panel-hd">
            <h1 style="margin: 0px;" class="am-text-center ">阳光财富</h1>
            </div>
            <div class="am-panel-bd">
            <h2 class="am-text-secondary">登陆成功</h2><img src="/assets/img/loading.gif" width="28" height="28" />
            <h4 class="am-text-primary">欢迎回来<?php  echo $_SESSION['uname']; ?></h4>
            <h4>
            <?php echo($message); ?>
            </h4>
            <h4 class="am-text-danger">The system will automatically return in <b id="wait"><?php echo($waitSecond); ?></b> seconds or click <a  id="href" href="<?php echo($jumpUrl); ?>">Here</a> to return</h4>
            </div>
            </div>

            <?php }?>
        </div>
    </div>
</div>
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