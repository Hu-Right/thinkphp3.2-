<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>任务一</title>
   <link rel="stylesheet" href="/Public/Login/css/gettask1.css">
   <link rel="stylesheet" href="/Public/Login/css/font/iconfont.css">
 <!--其他插件-->
  <link rel="shortcut icon" href="/Public/Login/img/bitbug_favicon.ico" /> 
  <script src="/Public/Admin/js/jquery.js"></script>
  <!--layer弹窗插件-->
  <link rel="stylesheet" href="/Public/Login/layui/css/layui.css"/> 
  <script src="/Public/Login/layui/layui.js"></script>	

 <script type="text/javascript" src="http://www.w3school.com.cn/jquery/jquery-1.11.1.min.js"></script>
 <script src="https://cdn.bootcss.com/html2canvas/0.5.0-beta4/html2canvas.js"></script>
<style>
  /*弹出退出框*/
  .ddd{
            width:100%;
            height:12rem;
            margin-top: 6rem;
            position: fixed;
            top:8rem;left:0;
            display: none;
        }
        .ddd .nnn{
            width:14rem;
            height:9rem;
            margin: auto;
            color:#343434;
            font-size:1.1rem;
            text-align: center;
            background:#FFFFFF;
            border-radius: 5px;
        }
        .ddd .nnn span{
        margin-top: 5rem;
        line-height: 3.5rem;
        }
        .ddd .nnn button{
            width:7rem;
            height:2.5rem;
            float: left;
            color:#D76344;
            border:none;
            outline: none;
            font-size:1rem;
            background:#FFFFFF; 
            border-top:1px solid #F5F5F5;
            margin-top:2rem;
        }
        .ddd .nnn .quxiao{
            border-right: 1px solid #F5F5F5;
        }
</style>
</head>
</head>
<body>
    <div class="centre">
        <a href="javascript:history.back(-1)"> 
            <i class="iconfont   icon-xiaoyu">返回</i>
        </a>
        <p>任务中心</p>
    </div>
    
    <?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><div class="text">         
        <div class="getta"><?php echo ($vo["cname"]); ?>:</div>
        <div class="get-text" style="line-height: 1rem;">
           请将以下文案图片发布到您的朋友圈(长按图片保存手机相册)
        </div>
        <div class="writer">
            <div class="writer-text">
                <p> 
                    <textarea cols="29" rows="4" id="biao1" style="margin: 0px; width: 12rem; height: 77px;border:0px;"readonly="readonly"><?php echo ($vo["content"]); ?></textarea>                     
                </p>
            </div>
            <button onClick="copyUrl2()">复制文案</button>
        </div>
    </div><?php endforeach; endif; ?>

    <div class="picture">
       
        <p>图片附件信息</p>
        <div class="img">
         <a class="ok"  id="onk"> <img src="<?php echo ($vo["logo"]); ?>" alt="分享" id="onk"></a> 
        </div>
    </div>

 
  <div class="ddd">
    <div class="nnn">
        <span>提示</span>
        <p>确定保存图片吗</p>
        <button class="quxiao">取消</button>
        <button onclick="getQRImage()">确定</button>
    </div>
</div>


</body>
<script>

function copyUrl2()
{
var Url2=document.getElementById("biao1");
Url2.select(); // 选择对象
document.execCommand("Copy"); // 执行浏览器复制命令
alert("已复制好，可贴粘。");
}

</script>

<script>
    $("#onk").click(function (){
        $(".ddd").show();          
    //   confirm("您确定要退出");
   });

	function getQRImage() {
        var imgUrl ="<?php echo ($vo["logo"]); ?>";
				var dtask = plus.downloader.createDownload("<?php echo ($vo["logo"]); ?>", {}, function(d, status) {                   
					if(status == 200) {
						//mui.toast("下载成功,文件保存在"+d.filename)
						plus.gallery.save(d.filename, function() {
							//保存到相册方法
							plus.nativeUI.closeWaiting();                    
							alert('已保存到手机相册');            
						}, function() {                            
							plus.nativeUI.closeWaiting();                            
							alert('保存失败，请重试！');                        
						});                    
					} else {                        
						alert("下载失败");                    
					}                
				}); 
				dtask.start();
			}

 
  $('.quxiao').click(function(){
   $(".ddd").hide();
  });


</script>
</html>