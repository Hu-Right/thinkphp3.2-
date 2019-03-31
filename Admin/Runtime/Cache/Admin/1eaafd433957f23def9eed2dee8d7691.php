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
        <a href="/admin.php/Admin/Withdrawals/daochu"><strong class="icon-reorder" style="float: right;margin-top: -30px;">导出今日Excel</strong></div></a>
  <a href="/admin.php/Admin/Withdrawals/daochus"><strong class="icon-reorder" style="float: right;margin-right: 150px;margin-top: -30px;">导出本月所有记录</strong></div></a>
      <form method="post" action="/admin.php/Admin/Withdrawals/bdel">
        <table class="table table-hover text-center">
          <tr>
            <th width="120">id</th>
            <th>用户手机号</th>
            <th>银行名称</th>
            <th>开户行信息</th>
            <th>提现帐号</th>
            <th>姓名</th>
            <th>金额</th>
            <th>状态</th>
            <th>留言</th>
            <th>申请时间</th>
            <th>操作</th></tr>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
              <td>
                <input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["id"]); ?></td>
              <td><?php echo ($v["email"]); ?></td>
              <td><?php echo ($v["mode"]); ?></td>
              <td><?php echo ($v["khhxx"]); ?></td>
              <td><?php echo ($v["accounts"]); ?></td>
              <td><?php echo ($v["name"]); ?></td>
              <td><?php echo ($v["money"]); ?></td>
               <td><?php if($v['type']==0):?>审核中<?php endif; if($v['type']==1):?>提现成功<?php endif; if($v['type']==2):?>提现失败<?php endif;?></td>
              <td><?php echo ($v["info"]); ?></td>
              <td><?php echo ($v["time"]); ?></td>
              <td>
                <div class="button-group">
                  <a class="button border-main" href="/admin.php/Admin/Withdrawals/save/id/<?php echo ($v['id']); ?>">
                    <span class="icon-edit"></span>修改</a>
                  <a class="button border-red" href="/admin.php/Admin/Withdrawals/del/id/<?php echo ($v['id']); ?>" onclick="return del(1)">
                    <span class="icon-trash-o"></span>删除</a>
                </div>
              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          <tr>
            <td colspan="8">
              <div class="pagelist"><?php echo ($page); ?></td></tr>
        </table>
        </div>
        <div class="padding border-bottom">
          <button type="button" class="button border-green" id="checkall">
            <span class="iconfont icon-htmal5icon22"></span>全选</button>
          <button type="submit" class="button border-red" onclick="return DelSelect()">
            <span class="iconfont icon-shanchu"></span>批量删除</button>
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