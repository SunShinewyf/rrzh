<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
   <head>
     <title>人人众合</title>
     <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
     <link rel="stylesheet" type="text/css" href="/rrzh/Public/Css/home.css"/>
    <script type="text/javascript" src="/rrzh/Public/Js/jquery.js"></script>
     
   </head>
   <body>
 <div id="header">
   <div class="logo"></div>
   <div class="nav">
     <ul id="supnav">
      <li><a href="/rrzh/index.php/Home/Index/Index">首页</a></li>
         <?php if(is_array($Parcols)): $i = 0; $__LIST__ = $Parcols;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/rrzh/index.php/Home/Index/EssayList/code/<?php echo ($vo["code"]); ?>"><?php echo ($vo['cname']); ?></a>
              <ul class="drop">
                  <?php if(is_array($Subcols)): $i = 0; $__LIST__ = $Subcols;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i; if($vo['code'] == $li['cparent']): ?><li><a href="/rrzh/index.php/Home/Index/Essaylist/code/<?php echo ($li['code']); ?>"><?php echo ($li['cname']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </ul>
           </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    </div>
  </div>
 <div id="slide">
    <a id=prev class="prevBtn qq" href="javascript:void(0)"></a>
  	<a id=next class="nextBtn qq" href="javascript:void(0)"></a>
	<div id=js class="js">
		<div class="box01">
			<img onClick="location.href=''"  src="/rrzh/Public/Images/static/8.png">
			<img onClick="location.href=''"  style="DISPLAY: none" src="/rrzh/Public/Images/static/2.png"> 
			<img onClick="location.href=''" style="DISPLAY: none"  src="/rrzh/Public/Images/static/4a.png">
			<img onClick="location.href=''" style="DISPLAY: none"  src="/rrzh/Public/Images/static/5.png"> 
			<img onClick="location.href=''" style="DISPLAY: none" src="/rrzh/Public/Images/static/7.png">	
		</div>
		<div class="bg"></div>
		<div id=jsNav class=jsNav>	
			<a class="trigger imgSelected" href="javascript:void(0)">1</a>
			<a class="trigger" href="javascript:void(0)">2</a>
			<a class="trigger" href="javascript:void(0)">3</a>
			<a class="trigger" href="javascript:void(0)">4</a>
			<a class="trigger" href="javascript:void(0)">5</a>		
		</div>
	</div>
     </div>



<div id="container">
	 <div class="main-left">
          <div class="parts">
               <h1><?php echo ($ParCol['cname']); ?></h1>
               <div class="content">
                <ul class="list">
                <?php if(is_array($SubCols)): $i = 0; $__LIST__ = $SubCols;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Su): $mod = ($i % 2 );++$i;?><li><a href="/rrzh/index.php/Home/Index/Essaylist/code/<?php echo ($Su['code']); ?>"><?php echo ($Su['cname']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
               </div>
           </div>
       
           <div class="parts">
               <h1>联系我们</h1>
               <div class="content">
                <p1>公司：<?php echo ($Infolist['0']['iname']); ?></p1>
                <p1>联系人：<?php echo ($Infolist['0']['icontactor']); ?></p1>
                <p1>电话：<?php echo ($Infolist['0']['iphone']); ?></p1>
                <p1>QQ：<?php echo ($Infolist['0']['iqq']); ?></p1>
                <p1>邮箱：<?php echo ($Infolist['0']['iemail']); ?></p1>
                <p1>地址：<?php echo ($Infolist['0']['iaddress']); ?></p1>
               </div>
           </div>
           
            <div class="parts" style="margin-bottom:30px;">
               <h1>友情链接</h1>
               <div class="content">
                <ul class="list">
                 <?php if(is_array($Linklist)): $i = 0; $__LIST__ = $Linklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lk): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($lk["lurl"]); ?>"><?php echo ($lk["lname"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
               </div>
           </div>
        
        </div>
    <div class="main-right">
         <div class="detail">
                <div class="title">
                  <?php if($parent == '0'): ?>当前位置&nbsp;:&nbsp;<a href="/rrzh/index.php/Home/Index/Index">首页</a> >> <a href="/rrzh/index.php/Home/Index/Essaylist/code/<?php echo ($CurCol['code']); ?>"><?php echo ($CurCol['cname']); ?></a>
                  <?php else: ?>
                   当前位置&nbsp;:&nbsp;<a href="/rrzh/index.php/Home/Index/Index">首页</a> >> <a href="/rrzh/index.php/Home/Index/Essaylist/code/<?php echo ($ParCol['code']); ?>"><?php echo ($ParCol['cname']); ?></a> >> <a href="/rrzh/index.php/Home/Index/Essaylist/code/<?php echo ($CurCol['code']); ?>"><?php echo ($CurCol['cname']); ?></a><?php endif; ?>  
                </div>
                <hr>
                <ul class="title-detail">
                    <?php if(is_array($select)): $i = 0; $__LIST__ = $select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li class="style2"><a href="/rrzh/index.php/Home/Index/EssayDetail/e/<?php echo ($li['eid']); ?>"><?php echo (subtext($li['etitle'],22)); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo ($li['erevise']); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
               <div class="pages">
                        <?php echo ($page); ?>
                </div>


         </div>

    </div>


</div>
<div id="footer">
     <p>Powerby SunShine &nbsp;&nbsp;&nbsp 鄂ICP备15002472号-1</p>
    <p>CopyRight©2015 版权所有：SunShine</p>

</div>
<script type="text/javascript" src="/rrzh/Public/Js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".area").hover(function(){
	  $(this).find(".qq").show(80);}
	  ,function(){
		$(this).find(".qq").hide(80);
	});
});
</script>
<script type="text/javascript" src="/rrzh/Public/Js/js.js"></script>
<script type="text/javascript" src="/rrzh/Public/Js/home.js"></script>

</body>
</html>