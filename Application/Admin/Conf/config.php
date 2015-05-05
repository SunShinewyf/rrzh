<?php
return array(
    //'配置项'=>'配置值'
    //资源列表
    //关于模板的配置
    'TMPL_PARSE_STRING'=>array(
        '__ROOT__' => SITE_ROOT,
        '__UPLOAD__' => SITE_ROOT.'/Uploads',
        '__PUBLIC__'=> MODULE_PATH.'Public',
        '__JS__'=> __ROOT__.MODULE_PATH.'Public/js',
        '__CSS__'=> __ROOT__.MODULE_PATH.'Public/css',
        '__IMAGES__'=> __ROOT__.MODULE_PATH.'Public/img',
        '__EDITOR__'=>__ROOT__.MODULE_PATH.'Public/editor',
    ),
        '__ROOT__' => '/rrzh',
		'SHOW_PAGE_TRACE'=>true,//开启页面Trace
);
?>