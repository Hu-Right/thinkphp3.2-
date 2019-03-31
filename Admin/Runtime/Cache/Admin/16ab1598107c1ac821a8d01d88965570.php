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
        <strong class="iconfont icon-liebiao">任务中心</strong></div>
        
        <div class="padding border-bottom">

            <ul class="search">
    
              <li>
    
                <form method="post" action="">
    
                  <button type="button" class="button border-yellow" onclick="window.location.href='/admin.php/Admin/Member/tadds'">
    
                    <span class="iconfont icon-tianjia"></span>添加</button>
    
                </form>
    
              </li>
    
            </ul>
    
          </div>

        <!-- <a href="/admin.php/Admin/Withdrawals/daochu"><strong class="icon-reorder" style="float: right;margin-top: -30px;">导出今日Excel</strong></div></a>
  <a href="/admin.php/Admin/Withdrawals/daochus"><strong class="icon-reorder" style="float: right;margin-right: 150px;margin-top: -30px;">导出本月所有记录</strong></div></a> -->
      <form method="post" action="/admin.php/Admin/Member/bdels" enctype="multipart/form-data">
        <table class="table table-hover text-center">
          <tr>
            <th width="120">id</th>
            <th>任务名称</th>
            <th>文案内容</th>
            <th>附件图片</th>
            <th>是否禁用</th>    
            <th>开始时间</th>
            <th>操作</th>
          </tr>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
              <td>
                <input type="checkbox" name="id[]" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["id"]); ?></td>
              <td><?php echo ($v["cname"]); ?></td>
              <td><?php echo ($v["content"]); ?></td>
              <td><img style="width: 50px;" src="<?php echo ($v["logo"]); ?>" /></td>
              <td> 
                  <?php if(($v["status"]) == "1"): ?>是<?php else: ?>否<?php endif; ?>
           </td>

                <td><?php echo (date("Y-m-d H:i:s",$v["btime"])); ?></td>
              <td>
                <div class="button-group">
                  <a class="button border-main" href="/admin.php/Admin/Member/tsave/id/<?php echo ($v['id']); ?>">
                    <span class="icon-edit"></span>修改</a>
                  <a class="button border-red" href="/admin.php/Admin/Member/tdel/id/<?php echo ($v['id']); ?>" onclick="return del(1)">
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