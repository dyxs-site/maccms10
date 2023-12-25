<?php 
return [
    '后台密码' => '',
    'tips' => [
        'time' => '6',
        'color' => '#fb7299',
        'text' => '请文明发送弹幕,不要相信博彩广告',
    ],
    '防窥' => '0',
    '数据库' => [            // 注意=>前后都有一个空格。务必保留，不然出错  
        '类型' => 'sqlite',   //支持类型：mysql,sqlite 
        '方式' => 'pdo',        // 无需更改，只支持pdo模式
        '地址' => 'dmku.db',           //数据库名地址，mysql可以设置为'localhost',sqlite设置为数据库文件名,保存在save目录
        '用户名' => '',                //数据库名用户名 
        '密码' => '',                 //数据库名密码 
        '名称' => '',                 //数据库名称
       '端口' => 3306,
    ],
    'is_cdn' => 0,  //是否用了cdn
    '限制时间' => 60, //单位s
    '限制次数' => 20, //在限制时间内可以发送多少条弹幕
    '允许url' => [],  //跨域  格式['https://abc.com','http://cba.com']   要加协议
    '安装' => 1,
];
