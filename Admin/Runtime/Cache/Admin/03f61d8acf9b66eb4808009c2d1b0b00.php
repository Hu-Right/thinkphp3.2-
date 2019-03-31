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
     
      <form method="post" action="/admin.php/Admin/Transaction/bdel">
        <table class="table table-hover text-center">
          <tr>
            <th width="120">ID</th>
            <th>会员唯一登录ID</th>
            <th>币种类型</th>
            <th>操作类型</th>
            <th>金额</th>
            <th>说明</th>
      <th>时间</th>
           </tr>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr style=" height: 35px;">
              <td><?php echo ($v["id"]); ?></td>
              <td><?php echo ($v["email"]); ?></td>
              <td><?php echo ($v["type"]); ?></td>
              <td><?php echo ($v["income"]); ?></td>
              <td><?php echo ($v["money"]); ?></td>
             <td><?php echo ($v["info"]); ?></td>
        <td><?php echo ($v["time"]); ?></td>
             
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          <tr>
            <td colspan="8">
              <div class="pagelist"><?php echo ($page); ?></td></tr>
        </table>
        </div>
      
      </form>
      <script type="text/javascript">function del(id) {
          if (confirm("您确定要删除吗?")) {

} else {
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
</html>