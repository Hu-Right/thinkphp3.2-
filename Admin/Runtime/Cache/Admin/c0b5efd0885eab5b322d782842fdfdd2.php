<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会员团队</title> 
    <style class="csscreations">
/*Now the CSS*/
* {margin: 0; padding: 0;}
 
.tree ul {
    padding-top: 20px;
  position: relative;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}
 
.tree li {
    float: left; text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
     
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}
 
/*We will use ::before and ::after to draw the connectors*/
 
.tree li::before, .tree li::after{
    content: '';
    position: absolute; top: 0; right: 50%;
    border-top: 1px solid #ccc;
    width: 50%; height: 20px;
}
.tree li::after{
    right: auto; left: 50%;
    border-left: 1px solid #ccc;
}
 
/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
    display: none;
}
 
/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}
 
/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
    border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
    border-right: 1px solid #ccc;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}
 
/*Time to add downward connectors from parents*/
.tree ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 1px solid #ccc;
    width: 0; height: 20px;
}
 
.tree li a{
    border: 1px solid #ccc;
    padding: 5px 10px;
    text-decoration: none;
    color: #666;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    display: inline-block;
     
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
     
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}
 
/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
    background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
    border-color:  #94a0b4;
}
 
/*Thats all. I hope you enjoyed it.
Thanks :)*/
.homt{
  
    width: 150px;
    background: #F5EFEF;
    height: 100px;
    border: 1px #EFABAB solid;
    border-radius: 5px;
  color: #666;
    font-family: arial, verdana, tahoma;
   font-size: 13px;
   cursor:pointer;
}
.hometname{
    border-bottom: 1px #EFABAB solid;
    height: 23px;
    line-height: 23px;
   
}
.homettm{
  border-right: 1px #EFABAB solid;
  border-bottom: 1px #EFABAB solid;
    width: 50%;
    float: left;
   height: 23px;
   line-height: 23px;
}
.homettms{
    width: 49%;
   border-bottom: 1px #EFABAB solid;
    float: right;
   height: 23px;
    line-height: 23px;
}
.ahomettm{
  border-right: 1px #EFABAB solid;
  
    width: 50%;
    float: left;
  height: 28px;
   line-height:  28px;
}
.ahomettms{
    width: 49%;
    float: right;
  height: 28px;
    line-height: 28px;
}

</style>
</head>
<body>
<!--
We will create a family tree using just CSS(3)
The markup will be simple nested lists
-->

<div class="tree">
<?php foreach($data as $v):?>
<?php if($v['id'] == $id):?>
  <ul>
    <li>
    <a href="/admin.php/Admin/Member/Genealogy/id/<?php echo ($v['id']); ?>">
      <div class="homt">
        <div class="hometname">用户名:&nbsp;&nbsp;<?php echo $v['username']?></div>
        <div class="hometname">手机号:&nbsp;&nbsp;<?php echo $v['mobile']?></div>
        <div class="homettm">类别</div>
        <div class="homettms">
        <?php echo ($v['level']==0?'免费会员':''); ?>
        <?php echo ($v['level']==1?'普通会员':''); ?>
        <?php echo ($v['level']==2?'vip会员':''); ?>
        <?php echo ($v['level']==3?'黄金会员':''); ?>
       
        </div>
        <div class="ahomettm">余额</div>
        <div class="ahomettms"><?php echo $v['currency']?></div>
      </div>
    </a>  
      <ul> 
        <?php foreach($data as $a):?>
          <?php if($v['id'] == $a['parent_id']):?>
            <li>
              <a href="/admin.php/Admin/Member/Genealogy/id/<?php echo ($a['id']); ?>">
                <div class="homt">
                  <div class="hometname">用户名:&nbsp;&nbsp;<?php echo $a['username']?></div>
                  <div class="hometname">手机号:&nbsp;&nbsp;<?php echo $a['mobile']?></div>
                  <div class="homettm">类别</div>
                  <div class="homettms">
                  <?php echo ($a['level']==0?'免费会员':''); ?>
                  <?php echo ($a['level']==1?'普通会员':''); ?>
                  <?php echo ($a['level']==2?'vip会员':''); ?>
                  <?php echo ($a['level']==3?'黄金会员':''); ?>
               
                  </div>
                  <div class="ahomettm">余额</div>
                  <div class="ahomettms"><?php echo $a['currency']?></div>
                </div>
              </a>
              <ul>
                <?php foreach($data as $b):?>
                  <?php if($a['id'] == $b['parent_id']):?>
                    <li>
                      <a href="/admin.php/Admin/Member/Genealogy/id/<?php echo ($b['id']); ?>">
                        <div class="homt">
                          <div class="hometname">用户名:&nbsp;&nbsp;<?php echo $b['username']?></div>
                          <div class="hometname">手机号:&nbsp;&nbsp;<?php echo $b['mobile']?></div>
                          <div class="homettm">类别</div>
                          <div class="homettms">
                            <?php echo ($b['level']==0?'免费会员':''); ?>
                            <?php echo ($b['level']==1?'普通会员':''); ?>
                            <?php echo ($b['level']==2?'vip会员':''); ?>
                            <?php echo ($b['level']==3?'黄金会员':''); ?>
                          </div>
                          <div class="ahomettm">余额</div>
                          <div class="ahomettms"><?php echo $a['currency']?></div>
                        </div>
                      </a>
                      <ul>
                        <?php foreach($data as $c):?>
                          <?php if($b['id'] == $c['parent_id']):?>
                            <li>
                              <a href="/admin.php/Admin/Member/Genealogy/id/<?php echo ($c['id']); ?>">
                                <div class="homt">
                                  <div class="hometname">用户名:&nbsp;&nbsp;<?php echo $c['username']?></div>
                                  <div class="hometname">手机号:&nbsp;&nbsp;<?php echo $c['mobile']?></div>
                                  <div class="homettm">类别</div>
                                  <div class="homettms">
                                    <?php echo ($c['level']==0?'免费会员':''); ?>
                                    <?php echo ($c['level']==1?'普通会员':''); ?>
                                    <?php echo ($c['level']==2?'vip会员':''); ?>
                                    <?php echo ($c['level']==3?'黄金会员':''); ?>
                                  </div>
                                  <div class="ahomettm">余额</div>
                                  <div class="ahomettms"><?php echo $c['currency']?></div>
                                </div>
                              </a>

                            </li>
                          <?php endif;?>
                        <?php endforeach;?>
                      </ul>
                    </li>
                  <?php endif;?>
                <?php endforeach;?>
              </ul>
            </li>
          <?php endif;?>
        <?php endforeach;?>
      </ul>
    </li>
  </ul>
<?php endif;?>
<?php endforeach;?>



</div>
</body>
</html>