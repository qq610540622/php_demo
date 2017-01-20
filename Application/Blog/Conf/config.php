<?php
return array(
    
    'VAR_PAGE'=>'page',
    'VAR_CATEGORY'=>'category',
    'DEFAULT_PAGE_SIZE'=>10,
    
    //'配置项'=>'配置值'
    'URL_MODEL' => 2,
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'DEFAULT_CONTROLLER'    =>  'index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'layout',
    'HTML_CACHE_ON'     =>    false, // 开启静态缓存
    'TMPL_CACHE_ON' => false,
    'ACTION_CACHE_ON'  => false,  // 默认关闭Action 缓存
    'TMPL_CACHE_TIME'       =>  10,         // 模板缓存有效期 0 为永久，(以数字为值，单位:秒)
    
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'blog',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'blog_',    // 数据库表前缀
    
    'REDIS_HOST'                =>  'localhost',          // 密码
    'REDIS_PORT'               =>  '6379',        // 端口
    'REDIS_AUTH'             =>  '',    // 数据库表前缀
    'DATA_CACHE_TIMEOUT'    =>20
);