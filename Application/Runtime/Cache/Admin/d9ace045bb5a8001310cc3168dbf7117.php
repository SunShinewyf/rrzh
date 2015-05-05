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
    <img src="/rrzh./Application/Admin/Public/img/set-db.png"/><h2>设置栏目</h2>
</div>
<div class="boxwrap">
    <div class="box">
        <div class="box-title">
            版块说明
        </div>
        <div class="box-content">
            <p>你可以在这里更改网站中，文章栏目的设置，目前只支持二级目录。需要提醒的是，网站前端的结构已经成型，如果确实要更改，请先联系本站开发人员。</p>
            <p>栏目描述是指某栏目的文章列表上面的描述文字，不需要该描述的栏目不会有“更改”按钮。</p>
        </div>
    </div>
</div>
<div class="boxwrap60">
    <div class="box">
        <div class="box-title">
            当前栏目
        </div>
        <div class="box-content no-padding">
            <table class="table">
                <thead>
                <tr>
                    <th>栏目名称</th>
                    <th>栏目别名</th>
                    <th>父级栏目</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($cols)): $i = 0; $__LIST__ = $cols;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cols): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($cols['cname']); ?></td>
                        <td><?php echo ($cols['code']); ?></td>
                        <td><?php echo ($cols['cparent']); ?></td>
                        <td>
                            <a href="/rrzh/index.php/Admin/System/edit/code/<?php echo ($cols['code']); ?>" class="btn btn-warning btn-xs upd-col" code="<?php echo ($cols['code']); ?>">修改</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="boxwrap40">
    <div class="box">
        <div class="box-title">
         <?php if($action == 'SetColumn'): ?>添加新栏目
          <?php else: ?>
            修改栏目
        </div><?php endif; ?>
       
        <div class="box-content">
          <?php if($action != 'edit'): ?><form action="/rrzh/index.php/Admin/System/SaveColumn" method="post" id="form-column">
          <?php else: ?>
            <form action="/rrzh/index.php/Admin/System/SaveEdit" method="post" id="form-column"><?php endif; ?>
        
                <div class="form-group">
                    <label for="cname">栏目名称</label>
                    <input type="text" class="form-control" id="cname" name="cname" value="<?php echo ($result['cname']); ?>" placeholder="填写栏目名称">
                </div>
                <div class="form-group">
                    <label for="code">别名</label>
                    <input type="text" class="form-control" id="code" value="<?php echo ($result['code']); ?>" name="code" placeholder="栏目的别名">
                    <p class="help-block">请使用栏目名称的拼音缩写，不能与现有的重复</p>
                </div>
                <div class="form-group">
                    <label for="cparent">父级</label>
                    <select class="form-control" id="cparent" name="cparent">
                        <option value="0" selected>无</option>
                        <?php if(is_array($parcol)): $i = 0; $__LIST__ = $parcol;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parcol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($parcol['code']); ?>"><?php echo ($parcol['cname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <button type="botton" class="btn btn-primary" id="column-subm">确认添加</button>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ColumnDescribeModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/rrzh/index.php/Admin/System/SaveColDescribe" method="post">
            <div class="modal-body">
                <strong>栏目：</strong>
                <span id="colname"></span>
                <br/><br/>
                <textarea id="col-describe" name="describe"></textarea>
                <input type="hidden" name="code" id="code4upd" value=""/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <input type="submit" class="btn btn-primary" value="确定"/>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- loading -->
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="__STYLE__/img/loading.gif" id="load-img"/>
                <span style="line-height: 16px;margin-left: 20px;" id="load-tips">载入中，请稍候……</span>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- =================== -->
<script charset="utf-8" src="__STYLE__/editor/kindeditor-min.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#col-describe',{
            resizeType: '2',
            width: '100%',
            height: '400px',
            cssData: 'body { font-size: 14px; }',
            fillDescAfterUploadImage: 'true',
            uploadJson: '/rrzh/index.php/Essay/upload_json',
            items: [
                'source', 'undo', 'redo', 'cut', 'copy', 'paste',
                'plainpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image',
                'insertfile', 'table', 'hr', 'baidumap',
                'anchor', 'link', 'unlink', '|', 'about'
            ]
        });
    });
</script>
</div><!--这个div不要删除-->
<div class="fn-clear"></div>
</body>
</html>