<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>数据库在线备份下载和还原</title>
       
        <link rel="stylesheet" type="text/css" href="/Public/Admin/bak/common.css" />

    </head>
    <body>
   
            <div class="demo">
                <table class="table_parameters" border="0" cellSpacing="0" cellPadding="0" width="100%">
                    <tbody>
                        <tr class="tr_head">
                            <th width="40px">序号</th>
                            <th>文件名</th>
                            <th width="150px">备份时间</th>
                            <th width="130px">文件大小</th>
                            <th width="100px">操作</th>

                        </tr>
                        <?php if(!empty($lists)): if(is_array($lists)): foreach($lists as $key=>$row): if($key > 1): ?><tr>
                                        <td><?php echo ($key-1); ?></td>
                                        <td style="text-align: left"><a href="<?php echo U('Bak/index',array('Action'=>'download','file'=>$row));?>"><?php echo ($row); ?></a></td>
                                        <td><?php echo (getfiletime($row,$datadir)); ?></td>
                                        <td><?php echo (getfilesize($row,$datadir)); ?></td>
                                        <td>
                                            <a href="<?php echo U('Bak/index',array('Action'=>'download','file'=>$row));?>">下载</a>
                                            <a onclick="return confirm('确定将数据库还原到当前备份吗？')"href="<?php echo U('Bak/index',array('Action'=>'RL','File'=>$row));?>">还原</a>
                                            <a onclick="return confirm('确定删除该备份文件吗？')"href="<?php echo U('Bak/index',array('Action'=>'Del','File'=>$row));?>">删除</a>
                                        </td>
                                    </tr><?php endif; endforeach; endif; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7">没有找到相关数据。</td>
                            </tr><?php endif; ?>
                    </tbody>
                </table>
                <p>     
                    <a class="btn" type="button" onClick="location.href = '/admin.php/Admin/Bak/index/Action/backup'">备份添加</a>
                </p>
            </div>
   
        <script type="text/javascript" src="http://www.sucaihuo.com/Public/js/other/jquery.js"></script> 
      
    </body>
</html>