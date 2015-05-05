<?php
return array(
    

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数
	/*数据库相关配置*/
    'DB_TYPE'   => 'mysql',//数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'rrzh', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'rz_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集

      /* 文档模型配置 (文档模型核心配置，请勿更改) */
    'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),
);
