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
        <li><a href="/rrzh/index.php/Admin/Expert/ExpertAdd">添加教练</a></li>
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
<!-- ====== -->
<div class="title">
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/><h2>全部文章</h2>
</div>
<div class="boxwrap40">
    <div class="box">
        <div class="box-title">
            版块说明
        </div>
        <div class="box-content">
            <p>你可以在本版块查看已发布的文章。</p>
            <p>有几个栏目，点击之后直接就是某篇文章。这样的文章其实就是“栏目描述”，一般不需要经常性修改。请联系“超级管理员”在“系统设置”->“栏目设置”下做修改。</p>
            <p>你也可以点击按钮&nbsp;<a href="/rrzh/index.php/Admin/Essay/BuildEssay" class="btn btn-primary btn-xs">写新文章</a></p>
        </div>
    </div>
</div>
<div class="boxwrap60">
    <div class="box">
        <div class="box-title">
            筛选条件
        </div>
        <div class="box-content essayfilter">
            <div class="form-group">
                <form action="/rrzh/index.php/Admin/Essay/allessay" method="get" id="essayfilter">
                <span>选项搜索：</span>
                <select name="filteby">
                    <option value="title" selected>标题：</option>
                    <option value="from">作者/来源：</option>
                    <option value="admin">上传者：</option>
                </select>
                <input type="text" name="kw"/>
                <input type="submit" class="btn btn-primary btn-xs" value="搜索" />
                </form>
            </div>
            <div class="form-group">
                <span>选择栏目：</span>
                <select id="cpar" name="cpar">
                    <option value="0" selected>先选择父栏目</option>
                    <?php if(is_array($parcol)): $i = 0; $__LIST__ = $parcol;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parcol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($parcol['code']); ?>"><?php echo ($parcol['cname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <select id="code" name="code" style="display: none;">
                    <option value="0" selected>请先选择父栏目</option>
                </select>
            </div>
            <?php if(!empty($CurFilte)): ?><p>筛选<?php echo ($CurFilte); ?>&nbsp;得到&nbsp;<strong><?php echo ($count); ?></strong>&nbsp;条结果&nbsp;&nbsp;<a href="/rrzh/index.php/Admin/Essay/allessay" class="btn btn-danger btn-xs">去除筛选</a></p><?php endif; ?>
            <span>对当前结果：</span>
            <a href="/rrzh/index.php/Admin/Essay/allessay?<?php echo ($orderUrl); ?>order=build" class="btn btn-primary btn-xs" title="按发布时间排序">按发布时间排序</a>
            <a href="/rrzh/index.php/Admin/Essay/allessay?<?php echo ($orderUrl); ?>order=read" class="btn btn-primary btn-xs" title="按阅读量排序">按阅读量排序</a>
            <a href="/rrzh/index.php/Admin/Essay/allessay?<?php echo ($orderUrl); ?>order=revise" class="btn btn-primary btn-xs" title="按最近修改排序">按最近修改排序</a>
        </div>
    </div>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">
            已发布文章
        </div>
        <div class="box-content no-padding">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>标题</th>
                    <th>作者/来源</th>
                    <th>所属栏目</th>
                    <th>阅读量</th>
                    <th>上传者/发布时间</th>
                    <th>最近修改时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo['eid']); ?></td>
                        <td>
                            <?php echo ($vo['etitle']); ?><br/>
                            <span class="operate">
                            <a href="/rrzh/index.php/Admin/Essay/BuildEssay/eid/<?php echo ($vo['eid']); ?>" class="btn btn-xs btn-warning">再编辑</a>
                            <a href="/rrzh/index.php/Admin/Essay/DeleteEssay/eid/<?php echo ($vo['eid']); ?>" class="conf-del btn btn-xs btn-danger">删除</a>
                            <a href="/rrzh/index.php/Home/Index/EssayDetail/e/<?php echo ($vo['eid']); ?>" class="btn btn-xs btn-primary" target="_blank">查看</a>
                            </span>
                        </td>
                        <td><?php echo ($vo['efrom']); ?></td>
                        <td><?php echo ($vo['code']); ?></td>
                        <td><?php echo ($vo['etimes']); ?></td>
                        <td><?php echo ($vo['aname']); ?><br/><?php echo ($vo['ebuild']); ?></td>
                        <td><?php echo ($vo['erevise']); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="page"><?php echo ($page); ?></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var SelectData = $.parseJSON('<?php echo ($sublist); ?>');
    CheckSelectData();
</script>
<!-- ============= -->
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>