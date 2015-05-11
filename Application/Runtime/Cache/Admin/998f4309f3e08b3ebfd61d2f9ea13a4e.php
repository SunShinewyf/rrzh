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
<!-- header end -->
<div class="title">
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/>

    <h2>添加新教练</h2>
</div>

<div class="boxwrap">
    <div class="box">
        <div class="box-title">版块说明</div>
        <div class="box-content">
            <p>本板块可以添加新的教练</p>
        </div>
    </div>
</div>
<form action="/rrzh/index.php/Admin/Expert/saveFile" enctype="multipart/form-data" method="post" id="export-add">
<div class="boxwrap60">
    <div class="box">
        <div class="box-title">
            1、编辑正文（*默认14px字体，段首使用tab或4个空格）
        </div>
        <div class="box-content no-padding">
            <textarea name="edetail" id="edetail">
                <?php if(isset($detail)): echo ($Expertdetail); endif; ?>
            </textarea>
        </div>
    </div>
</div>
<div class="boxwrap40">
    <div class="box">
        <div class="box-title">
            添加新专家
        </div>
        <div class="box-content">
           
                <div class="form-group">
                    <label for="name">*教练名</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="填写教练名">
                </div>
                <div class="form-group">
                    <label for="file">选择文件</label>
                    <input type="file" id="sfile" name="sfile">
                    <p class="help-block">请务必选择360*230的图片，不超过2MB</p>
                </div>
                <button type="submit" class="btn btn-primary" id="export-subm">确认提交</button>
          
        </div>
    </div>
</div>
</form>

<!-- ================ -->
<!-- loading -->
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/rrzh./Application/Admin/Public/img/loading.gif" id="load-img"/>
                <span style="line-height: 16px;margin-left: 20px;" id="load-tips">保存中，请稍候……</span>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ============== -->
<!--editor-->
<script charset="utf-8" src="/rrzh./Application/Admin/Public/editor/kindeditor-min.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#edetail',{
            resizeType: '1',    //高度可拖动
            width: '100%',
            height: '600px',
            cssData: 'body { font-size: 14px; }',
            fillDescAfterUploadImage: 'true',
          //  uploadJson: '/rrzh/index.php/Admin/Expert/upload_json',
            afterBlur: function () { this.sync(); },
            afterCreate: function(){ $('.ke-container').css("border", "none")},
            items: [
                'source', 'preview', '|', 'undo', 'redo', 'cut', 'copy', 'paste',
                'plainpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image',
                'insertfile', 'table', 'hr', 'emoticons', 'baidumap',
                'anchor', 'link', 'unlink', '|', 'about'
            ]
        });
    });
    var SelectData = $.parseJSON('<?php echo ($sublist); ?>');
    var isRevise = "<?php echo ($isRevise); ?>", par = "<?php echo ($par); ?>", sub = "<?php echo ($sub); ?>", essay = $.parseJSON('<?php echo ($essay); ?>');/**/
    $(document).ready(CheckSelectData);
    $(document).ready(CheckRevise);
</script>
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>