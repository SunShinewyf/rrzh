<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
    <title><?php echo ($pagetitle); ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="/rrzh./Application/Admin/Public/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/rrzh./Application/Admin/Public/css/admin.css"/>
    <style>
        body{overflow: hidden; position: relative;}
        .tf-tips{margin: 0; text-align: center;}
    </style>
</head>
<body>
<div id="pageinfo">
    <!--警告&成功-->
    <?php if(isset($pageError)): ?><div class="tf-tips error"><span class="close-tips" title="关闭"></span><?php echo ($pageError); ?></div><?php endif; ?>
    <?php if(isset($pageSuccess)): ?><div class="tf-tips success"><span class="close-tips" title="关闭"></span><?php echo ($pageSuccess); ?></div><?php endif; ?>
    <!-- ========= -->
</div>
<div id="login">
    <div class="logo"></div>
    <div class="login-top"></div>
    <form action="/rrzh/index.php/Admin/Index/SubmLogin" method="post" id="form-login">
        <div class="login-main">
            <div class="field">
                <label>管理员帐号</label>
                <input type="text" name="aname" id="aname"/>
            </div>
            <div class="field">
                <label>管理员密码</label>
                <input type="password" name="apwd" id="apwd"/>
            </div>
        </div>
        <div class="login-bottom">
            <input type="submit" id="login-subm" class="btn" value="登录"/>
        </div>
    </form>
</div>
</body>
<script type="text/javascript" src="/rrzh./Application/Admin/Public/js/jquery.js"></script>
<script type="text/javascript" src="/rrzh./Application/Admin/Public/js/admin.js"></script>
</html>