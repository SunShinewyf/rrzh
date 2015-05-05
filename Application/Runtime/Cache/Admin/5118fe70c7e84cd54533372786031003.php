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
<!-- ============== -->
<div class="title">
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/><h2>管理员列表</h2>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">版块说明</div>
        <div class="box-content">
            <p>本系统管理员分为3级：“普通管理员”、“系统管理员”以及“root管理员”；访问本模块需要“超级管理员”权限。</p>
            <p>本页面的左侧列出的是本系统当前存在的管理员（不显示你自己），如果你是root，还能看到所有的root管理员；</p>
            <p>右侧是添加管理员需要填写的表单；</p>
            <p>·【删除管理员】你只能更改由你添加的“普通管理员”；root管理员才能对所有管理员进行操作；</p>
            <p>·【添加管理员】你只能添加“普通管理员”；如果你是root管理员，还可以添加“超级管理员”；</p>
        </div>
    </div>
</div>
<div class="boxwrap60">
    <div class="box">
        <div class="box-title">
            所有管理员
        </div>
        <div class="box-content no-padding">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>昵称</th>
                    <th>权限</th>
                    <th>备注信息</th>
                    <th>添加者/时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($admins)): $i = 0; $__LIST__ = $admins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo['aid']); ?></td>
                        <td>
                            <?php echo ($vo['aname']); ?>
                            <?php if(($vo['AllowOperate']) == "true"): ?><div class="operate">
                                <a href="/rrzh/index.php/Admin/System/DeleteAdmin/id/<?php echo ($vo['aid']); ?>" class="conf-del btn btn-xs btn-danger">删除</a>
                            </div><?php endif; ?>
                        </td>
                        <td><?php echo ($vo['auth']); ?></td>
                        <td><?php echo ($vo['amsg']); ?></td>
                        <td><?php echo ($vo['abuildby']); ?><br/><?php echo ($vo['abuild']); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="boxwrap40">
    <div class="box">
        <div class="box-title">
            添加新管理员
        </div>
        <div class="box-content">
            <form action="/rrzh/index.php/Admin/System/BuildAdmin" method="post" id="form-admin">
                <div class="form-group">
                    <label for="name">*称呼</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="pwd">*初始密码</label>
                    <input type="text" class="form-control" id="pwd" name="pwd">
                </div>
                <div class="form-group">
                    <label for="auth">*权限</label>
                    <?php if(($IamRoot) == "true"): ?><select class="form-control" id="auth" name="auth">
                            <option value="<?php echo ($ordinary); ?>" selected>普通管理员</option>
                            <option value="<?php echo ($super); ?>">超级管理员</option>
                        </select>
                    <?php else: ?>
                        <select class="form-control" id="auth" name="auth" disabled="disabled">
                            <option value="<?php echo ($ordinary); ?>" selected>普通管理员</option>
                        </select><?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="msg">备注信息</label>
                    <input type="text" class="form-control" id="msg" name="msg">
                </div>
                <input type="submit" class="btn btn-primary" id="admin-subm" value="确认添加"/>
            </form>
        </div>
    </div>
</div>
<!-- ============== -->
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>