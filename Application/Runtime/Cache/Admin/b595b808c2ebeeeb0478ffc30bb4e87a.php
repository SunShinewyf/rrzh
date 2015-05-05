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
<!-- ==================== -->
<div class="title">
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/><h2>欢迎使用&nbsp;Feidian·Manager&nbsp;V1.0</h2>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">
            欢迎
        </div>
        <div class="box-content">
            <p>你好！欢迎使用Feidian·Manager管理“武汉生态学会官方网站”！</p>
            <p><strong><?php echo (session('adminName')); ?></strong>是你当前登录的用户名。如果你是第一次登录你的帐号，请点击&nbsp;<a href="/rrzh/index.php/Admin/Index/UpdateOwnInfo" class="btn btn-primary btn-xs">更改初始密码</a></p>
            <p>你在本系统的管理权限是：<strong><?php echo ($Iam); ?></strong></p>
        </div>
    </div>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">
            系统使用说明
        </div>
        <div class="box-content">
            <p>本系统所有功能请参考左侧菜单，点击菜单将进入对应的管理页面。各个页面都有相应的版块说明，描述了该板块的内容、功能以及使用方法。</p>
            <p>本系统实行分级管理，管理员分为root管理员、超级管理员、普通管理员。不同等级的管理员可以使用的功能有所不同。如果你是root管理员或者超级管理员，可以进入“管理员列表”和“栏目设置”以及“公司链接管理”和“公司信息管理”页面而普通管理员则没有权限看到这些信息。查看具体的管理员分级信息。</p>
        </div>
    </div>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">
            关于本系统
        </div>
        <div class="box-content">
            <p>沸点工作室·站点管理系统&nbsp;Feidian·Manager&nbsp;V1.0</p>
            <p>本系统由施浩宏开发，版权归华中农业大学理学院沸点工作室所有。</p>
            <p>如果您在使用过程中遇到什么问题，或者出现漏洞、错误，请联系我，或者沸点工作室。</p>
            <p>QQ：734459639&nbsp;&nbsp;&nbsp;&nbsp;E-mail：734459639@qq.com</p>
            <p>沸点工作室地址：逸夫楼A405</p>
        </div>
    </div>
</div>
<!-- =================== -->
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>