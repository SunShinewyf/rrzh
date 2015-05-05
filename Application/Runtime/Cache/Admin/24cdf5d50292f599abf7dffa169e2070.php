<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($PageTitle); ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="/rrzh./Application/Admin/Public/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/rrzh./Application/Admin/Public/css/admin.css"/>
    <script type="text/javascript" src="/rrzh./Application/Admin/Public/js/jquery.js"></script>
    <script type="text/javascript" src="/rrzh./Application/Admin/Public/js/admin.js"></script>
    <script type="text/javascript" src="/rrzh./Application/Admin/Public/js/modal.js"></script>
</head>
<body>
<div id="menu-area"></div>
<div id="menu">
	<div class="logo">
		<a href="/rrzh/index.php" title="点击打开站点首页">
		<img src="/rrzh./Application/Admin/Public/img/logo-manage.png" alt="沸点工作室后台管理系统" class="fn-left"/>
		</a>
	</div>
	<div class="welc">
		<p>你好，<?php echo ($adminName); ?>！</p>
		<p>选择下列菜单进行操作</p>
	</div>
	<!-- menu -->
    <div class="menu-list">首页管理</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/Homepage/UpdateSlider">更新大图</a></li>
    </ul>
    <div class="menu-list">文章管理</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/Essay/AllEssay">所有文章</a></li>
        <li><a href="/rrzh/index.php/Admin/Essay/BuildEssay">写新文章</a></li>
    </ul>
    <div class="menu-list">专家风采</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/Expert/allExpert">教练管理</a></li>
    </ul>
    <div class="menu-list">下载中心</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/File/allFile">文件管理</a></li>
    </ul>
    <div class="menu-list">管理员空间</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/Index/UpdateOwnInfo">修改个人信息</a></li>
        <li><a href="/rrzh/index.php/Admin/Index/index">帮助信息</a></li>
    </ul>
    <div class="menu-list">系统设置</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/System/AdminList">管理员列表</a></li>
        <li><a href="/rrzh/index.php/Admin/System/SetColumn">栏目设置</a></li>
    </ul>
    <div class="menu-list">其他管理</div>
    <ul class="menu-option">
        <li><a href="/rrzh/index.php/Admin/Other/allLink">链接管理</a></li>
        <li><a href="/rrzh/index.php/Admin/Other/allInfo">公司信息管理</a></li>
    </ul>
	<!-- -->
	<div class="ope">
		<a class="tohome" href="/rrzh/index.php/Home" title="打开首页" target="_blank"></a>
		<a class="chgpwd" href="UpdateOwnInfo" title="修改密码"></a>
		<a class="logout" href="/rrzh/index.php/Admin/Index/logout" title="安全退出系统"></a>
		<div class="fn-clear"></div>
	</div>
	<div class="copyright"><p>Powered By 沸点工作室</p></div>
</div>
<div id="main"><!--这个div不要删除-->
    <div id="pageinfo">
        <!--警告&成功-->
        <?php if(isset($pageError)): ?><div class="tf-tips error"><span class="close-tips" title="关闭"></span><?php echo ($pageError); ?></div><?php endif; ?>
        <?php if(isset($pageSuccess)): ?><div class="tf-tips success"><span class="close-tips" title="关闭"></span><?php echo ($pageSuccess); ?></div><?php endif; ?>
        <!-- -->
    </div>
<!-- ================== -->
<div class="title">
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/><h2>更新大图</h2>
</div>
<div class="boxwrap60">
    <div class="box">
        <div class="box-title">
            版块说明
        </div>
        <div class="box-content">
            <p>你可以在本板块更新首页的幻灯片图片。</p>
            <p>&nbsp;&nbsp;下面的“当前大图”是此时正展示在首页上的大图，要删除某张图，请把鼠标移到该图所在行，点击“删除”按钮即可；右侧的“添加新图”，顾名思义，选择本地的图片，并填写所需的内容，提交后新的大图将展示在首页上。</p>
            <p>&nbsp;&nbsp;-选择文件：请选择本地的图片，一般的图片格式都没问题。建议使用360*230的图片，在上传前可以进行适当的调整和美化，以达到更好的效果，必须；</p>
            <p>&nbsp;&nbsp;-简单描述：将会显示在首页图片的下方，相当于图片的标题，告诉浏览者这张图片的主题。不填写则不会显示内容；</p>
            <p>&nbsp;&nbsp;-链接指向：该图片指向的网址，浏览者点击该大图时将跳转的页面。不填写则点击不会有跳转，请务必填写正确的网址.</p>
        </div>
    </div>
</div>
<div class="boxwrap40">
    <div class="box">
        <div class="box-title">
            添加新图
        </div>
        <div class="box-content">
            <form action="/rrzh/index.php/Admin/Homepage/SaveSlider" method="post" id="picture-add" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="sfile">选择文件</label>
                    <input type="file" id="sfile" name="sfile">
                    <p class="help-block">请务必选择360*230的图片，不超过2MB</p>
                </div>
                <div class="form-group">
                    <label for="scaption">简单描述</label>
                    <input type="text" class="form-control" id="scaption" name="scaption" placeholder="简单描述">
                </div>
                 <div class="form-group">
                    <label for="cpar">*选择所属栏目</label>
                    <select class="form-control" id="cpar" name="cpar">
                        <option value="0">先选择父级栏目</option>
                        <?php if(is_array($parcol)): $i = 0; $__LIST__ = $parcol;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parcol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($parcol['code']); ?>"><?php echo ($parcol['cname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <p class="help-block">选择父栏目后，选择子栏目</p>
                    <select class="form-control" id="code" name="code" style="display: none;">
                        <option value="0" selected>请先选择父栏目</option>
                    </select>
                </div>
                <button type="submit"  id="pic-subm" class="btn btn-primary">确认提交</button>
            </form>
        </div>
    </div>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">
            当前大图
        </div>
        <div class="box-content no-padding">
            <table class="table">
                <thead>
                    <tr>
                        <th>文件名</th>
                        <th>描述</th>
                        <th>对应的模块名</th>
                        <th>上传者/上传时间</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($sliderItem)): $i = 0; $__LIST__ = $sliderItem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td>
                                <?php echo ($vo['pname']); ?><br/>
                                <span class="operate">
                                    <a href="/rrzh/index.php/Admin/Homepage/deleteSlider/pid/<?php echo ($vo['pid']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('确认要删除吗？');">删除</a>
                                <a href="SITE_ROOT/Uploads/slider/<?php echo ($vo['sname']); ?>" class="btn btn-info btn-xs" target="_blank">查看</a>
                                </span>
                            </td>
                            <td><?php echo ($vo['pinfo']); ?></td>
                            <td><?php echo ($vo['Column']['cname']); ?></td>
                            <td><?php echo ($vo['pfrom']); ?><br/><?php echo ($vo['ptime']); ?></td>
                           
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                 <tr class="content">
                <!--<td colspan="3" bgcolor="#FFFFFF">&nbsp;<?php echo ($page); ?></td>-->
                    <td colspan="3" bgcolor="#FFFFFF"><div class="pages">
                            <?php echo ($page); ?>
                    </div></td>  
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- ========================= -->
<script type="text/javascript">
    var SelectData = $.parseJSON('<?php echo ($sublist); ?>');
    var ParData = $.parseJSON('<?php echo ($ParColumn); ?>');
    var isRevise = "<?php echo ($isRevise); ?>", par = "<?php echo ($par); ?>", sub = "<?php echo ($sub); ?>", essay = $.parseJSON('<?php echo ($essay); ?>');/**/
    $(document).ready(CheckSelectData);
    $(document).ready(CheckRevise);


</script>
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>