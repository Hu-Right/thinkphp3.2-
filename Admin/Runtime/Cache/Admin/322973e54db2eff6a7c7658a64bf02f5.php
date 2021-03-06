<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="zh-cn">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="renderer" content="webkit">

    <title>管理员列表</title>  

    <link rel="stylesheet" href="/Public/Admin/css/pintuer.css">

    <link rel="stylesheet" href="/Public/Admin/css/admin.css">

    <script src="/Public/Admin/js/jquery.js"></script>

    <script src="/Public/Admin/js/pintuer.js"></script>  

</head>

<body>



  <div class="panel admin-panel">

    <div class="panel-head"><strong class="icon-reorder"> 管理员列表</strong></div>

    <div class="padding border-bottom">

      <ul class="search">

        <li>

  <form method="get" action="">

    <button type="button" class="button border-yellow" onclick="window.location.href='/admin.php/Admin/Admin/add'"><span class="iconfont icon-tianjia"></span> 添加管理员</button>

          用户名：<input type="text" placeholder="请输入搜索关键字" name="keywords"  value="<?php echo I('get.keywords')?>" class="input" style="width:250px; line-height:17px;display:inline-block" />

		 ID：<input type="text" placeholder="请输入搜索关键字" name="id"  value="<?php echo I('get.id')?>" class="input" style="width:250px; line-height:17px;display:inline-block" />

		  <input type="submit" class="button border-main icon-search"  value="搜索">

</form>



        </li>

      </ul>

    </div>

	<form method="post" action="/admin.php/Admin/Admin/bdel">

    <table class="table table-hover text-center">

      <tr>

        <th width="120">ID</th>

        <th>管理员名称</th>       

		<th>管理员权限</th>  

		<th>添加时间</th> 

		<th>添加IP</th> 

        <th>操作</th>       

      </tr>

	<?php foreach($data as $k=>$v):?>

        <tr>

			<td>

				<input type="checkbox" name="id[]" value="<?php echo $v['id'];?>" /><?php echo $v['id'];?>

			</td>

			<td><?php echo $v['username'];?></td>

			<td><?php echo $v['role_id'];?></td>

			<td><?php echo $v['time'];?></td>

			<td><?php echo $v['ip'];?></td>

			<td>

				<div class="button-group">

					<a class="button border-main" href="/admin.php/Admin/Admin/save/id/<?php echo $v['id'];?>"><span class="iconfont icon-icon-xiugai"></span>修改</a>

					<?php if($v['id'] != 1): ?><a class="button border-red" href="/admin.php/Admin/Admin/del/id/<?php echo $v['id'];?>" onclick="return del(1)"><span class="iconfont icon-shanchu"></span> 删除</a><?php endif; ?>

				</div>

			</td>

        </tr>

	<?php endforeach;?>



      <tr>

        <td colspan="8"><div class="pagelist">

		 <?php echo ($page); ?>

		</div></td>

      </tr>

    </table>

  </div>



   <div class="padding border-bottom">



     

	 

	 <button type="button"  class="button border-green" id="checkall"><span class="iconfont icon-htmal5icon22"></span> 全选</button>

  <button type="submit" class="button border-red"><span class="iconfont icon-shanchu"></span> 批量删除</button>

		

   </div>

</form>







<script type="text/javascript">



function del(id){

	if(confirm("您确定要删除吗?")){

		

	}

}



$("#checkall").click(function(){ 

  $("input[name='id[]']").each(function(){

	  if (this.checked) {

		  this.checked = false;

	  }

	  else {

		  this.checked = true;

	  }

  });

})



function DelSelect(){

	var Checkbox=false;

	 $("input[name='id[]']").each(function(){

	  if (this.checked==true) {		

		Checkbox=true;	

	  }

	});

	if (Checkbox){

		var t=confirm("您确认要删除选中的内容吗？");

		if (t==false) return false; 		

	}

	else{

		alert("请选择您要删除的内容!");

		return false;

	}

}



</script>

</body>

</html>