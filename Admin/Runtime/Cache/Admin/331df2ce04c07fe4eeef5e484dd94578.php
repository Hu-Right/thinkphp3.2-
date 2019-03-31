<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
    <link rel="stylesheet" href="/Public/Admin/css/admin.css">
    <script src="/Public/Admin/js/jquery.js"></script>
    <script src="/Public/Admin/js/pintuer.js"></script>
  </head>
  
  <body>
    <div class="panel admin-panel">
      <div class="panel-head">
        <strong class="iconfont icon-liebiao">列表</strong></div>
     <!--  <div class="padding border-bottom">
        <ul class="search">
          <li>
            <form method="get" action="">
              <button type="button" class="button border-yellow" onclick="window.location.href='/admin.php/Admin/Bak/add'">
                <span class="iconfont icon-tianjia"></span>添加</button>
              <form method="get" action="">用户名：
                <input type="text" placeholder="请输入搜索关键字" name="keywords" value="<?php echo I('get.keywords')?>" class="input" style="width:250px; line-height:17px;display:inline-block" />ID：
                <input type="text" placeholder="请输入搜索关键字" name="id" value="<?php echo I('get.id')?>" class="input" style="width:250px; line-height:17px;display:inline-block" />
                <input type="submit" class="button border-main icon-search" value="搜索"></form></li>
        </ul>
      </div> -->
      <form method="post" action="/admin.php/Admin/Bak/bdel">
        <table class="table table-hover text-center">
          <tr>
            <th>公告编号</th>
            <th>公告分类</th>
            <th>公告标题</th>
            <th>公告内容</th>
            <th>公告图片</th>
             <th>公告时间</th>
            <th>操作</th></tr>
          <?php if(is_array($cg)): $i = 0; $__LIST__ = $cg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
              <td>
              <input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["id"]); ?></td>
              <td><?php echo ($v["catename"]); ?></td>
              <td><?php echo ($v["biaoti"]); ?></td>
              <td style="text-align: center"><span style="overflow: hidden;width:500px;height: 59px;line-height:59px;text-align: center;display: block;margin:0 auto"><?php echo ($v["content"]); ?></span></td>
              <td> <img src="/<?php echo ($v["g_img"]); ?>" style="width: 90px;"> </td>
              <td><?php echo (date('Y-m-d H:i:s',$v["addtime"])); ?></td>
        
              <td>
                <div class="button-group">
          
                  <a class="button border-red" href="/admin.php/Admin/Bak/delss/id/<?php echo ($v['id']); ?>" onclick="return del(1)">
                    <span class="iconfont icon-shanchu"></span>删除</a>
          
                </div>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         
        </table>
    </div>
    <div class="padding border-bottom">
      <button type="button" class="button border-green" id="checkall">
        <span class="iconfont icon-htmal5icon22"></span>全选</button>
      <button type="submit" class="button border-red" onclick="return DelSelect()">
        <span class="iconfont icon-shanchu"></span>批量删除</button>
    </div>
    </form>
    <script type="text/javascript" src="/Public/index/css/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">function del(id) {
        if (confirm("您确定要删除吗?")) {

} else {
          return false;
        }
      }
function gain_money(id){
  if (confirm("确定要提现吗?")) {
console.log(id);
      var money=document.getElementById('gain_money').value;
      $.ajax({
        url:'<?php echo U('Admin/Member/gain');?>',
        type:'post',
        data:{'money':money,'id':id},
        success:function(ret){
          if(ret==1){
            alert('提现成功');
            window.location.reload();
          }else if(ret==2){
            alert('操作失败，请重试！');
          }else if(ret==3){
            alert('可提分红金额不足，请重新输入!');
            window.location.reload();
          }
        }
      });
    } else{
      return false;
    }
}
      $("#checkall").click(function() {
        $("input[name='id[]']").each(function() {
          if (this.checked) {
            this.checked = false;
          } else {
            this.checked = true;
          }
        });
      })

      function DelSelect() {
        var Checkbox = false;
        $("input[name='id[]']").each(function() {
          if (this.checked == true) {
            Checkbox = true;
          }
        });
        if (Checkbox) {
          var t = confirm("您确认要删除选中的内容吗？");
          if (t == false) return false;
        } else {
          alert("请选择您要删除的内容!");
          return false;
        }
      }</script>
  </body>

</html>