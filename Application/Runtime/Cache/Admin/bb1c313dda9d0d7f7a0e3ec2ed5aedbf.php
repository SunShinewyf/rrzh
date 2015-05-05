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
<!-- ================ -->
<div class="title">
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/><h2>修改个人信息</h2>
</div>
<div class="boxwrap40">
    <div class="box">
        <div class="box-title">
            修改登录密码
        </div>
        <div class="box-content">
            <form id="form-owninfo" action="/rrzh/index.php/Admin/Index/SaveOwnInfo" method="post">
                <div class="form-group">
                    <label for="curpwd">当前密码</label>
                    <input type="password" id="curpwd" class="form-control" name="curpwd" />
                </div>
                <div class="form-group">
                    <label for="pwd">新密码</label>
                    <input type="password" id="pwd" class="form-control" name="pwd" />
                </div>
                <div class="form-group">
                    <label for="pwd2">确认新密码</label>
                    <input type="password" id="pwd2" class="form-control" name="pwd2" />
                </div>
                <input type="submit" id="subm-owninfo" class="btn btn-primary" value="确认修改" />
            </form>
        </div>
    </div>
</div>
<div class="boxwrap60">
    <div class="box">
        <div class="box-title">
            版块说明
        </div>
        <div class="box-content">
            <p>你可以在本版块修改你的个人信息。</p>
            <p>当前可以修改的有：登录密码</p>
        </div>
    </div>
</div>
<!-- ================ -->
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>