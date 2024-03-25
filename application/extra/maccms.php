<?php
return array (
  'db' => 
  array (
    'type' => 'mysql',
    'path' => '',
    'server' => '127.0.0.1',
    'port' => '3306',
    'name' => 'maccms10',
    'user' => 'root',
    'pass' => 'root',
    'tablepre' => 'mac_',
    'backup_path' => './application/data/backup/database/',
    'part_size' => 20971520,
    'compress' => 1,
    'compress_level' => 4,
  ),
  'site' => 
  array (
    'site_name' => '电影先生 - dianyingxs.cc 在线 播放 观看',
    'site_url' => 'dianyingxs.cc',
    'site_wapurl' => 'dianyingxs.cc',
    'site_keywords' => '电影先生,在线播放,在线观看,百度网盘,免费视频,在线视频,预告片,dianyingxs.cc',
    'site_description' => '电影先生提供最新最快的视频分享数据-dianyingxs.cc',
    'site_icp' => '',
    'site_qq' => '',
    'site_email' => 'mail@dianyingxs.cc',
    'install_dir' => '/',
    'site_logo' => '',
    'site_waplogo' => '',
    'template_dir' => 'DYXS2',
    'html_dir' => 'html',
    'mob_status' => '0',
    'mob_template_dir' => 'DYXS2',
    'mob_html_dir' => 'html',
    'site_tj' => '<script>
    (function(){
        var curProtocol = window.location.protocol.split(\':\')[0];
        var bp = document.createElement(\'script\');
        bp.src = (curProtocol === \'https\' ? \'https://zz.bdstatic.com/linksubmit/push.js\' : \'http://push.zhanzhang.baidu.com/push.js\');
        document.getElementsByTagName("script")[0].parentNode.insertBefore(bp, document.getElementsByTagName("script")[0]);
    })();
    
    
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?f46a2caaf84b781dc103b13289d90383";
        document.getElementsByTagName("script")[0].parentNode.insertBefore(hm, document.getElementsByTagName("script")[0]);
    })();
    
    
    (function() {
        var apiUrl = "https://api.cgyx.tv:66";
        var token = "f7dd072abb9af17700b0b8a1bd8b8e1dc43e13838257436c31c30f4495aba5a79382ef3b36808ab90351f85de968be49838554c9b1e809e46631bdd330fc2189";
        var cltj = document.createElement("script");
        cltj.src = apiUrl + "/tj/tongji.js?v=1.3";
        document.getElementsByTagName("script")[0].parentNode.insertBefore(cltj, document.getElementsByTagName("script")[0]);
    })();
</script>',
    'site_status' => '1',
    'site_close_tip' => '站点暂时关闭，请稍后访问',
    'ads_dir' => 'ads',
    'mob_ads_dir' => 'ads',
  ),
  'app' => 
  array (
    'pathinfo_depr' => '/',
    'suffix' => 'html',
    'popedom_filter' => '0',
    'cache_type' => 'file',
    'cache_host' => '127.0.0.1',
    'cache_port' => '6379',
    'cache_username' => '',
    'cache_password' => '',
    'cache_flag' => 'a6bcf9aa58',
    'cache_core' => '1',
    'cache_time' => '3600',
    'cache_page' => '1',
    'cache_time_page' => '3600',
    'compress' => '1',
    'input_type' => '1',
    'ajax_page' => '0',
    'wall_filter' => '0',
    'show' => '1',
    'show_verify' => '0',
    'search' => '1',
    'search_verify' => '0',
    'search_len' => '',
    'search_timespan' => '1',
    'search_vod_rule' => 'vod_en|vod_sub|vod_tag|vod_actor|vod_director',
    'search_art_rule' => 'art_en|art_sub|art_tag',
    'vod_search_optimise' => 'frontend|collect',
    'vod_search_optimise_cache_minutes' => 20160,
    'copyright_status' => '0',
    'copyright_notice' => '该视频由于版权限制，暂不提供播放。',
    'browser_junmp' => '1',
    'page_404' => '404',
    'player_sort' => '1',
    'encrypt' => '1',
    'search_hot' => '红毯先生,低谷医生,非诚勿扰3,金手指,年会不能停！,怒潮,临时劫案,热辣滚烫,飞驰人生2,熊出没&middot;逆转时空,照明商店,潜行,第二十条',
    'art_extend_class' => '段子手,私房话,八卦精,爱生活,汽车迷,科技咖,美食家,辣妈帮',
    'vod_extend_class' => '爱情,动作,喜剧,战争,科幻,剧情,武侠,冒险,枪战,恐怖,微电影,其它',
    'vod_extend_state' => '正片,预告片,花絮',
    'vod_extend_version' => '高清版,剧场版,抢先版,OVA,TV,影院版',
    'vod_extend_area' => '大陆,香港,台湾,美国,韩国,日本,泰国,新加坡,马来西亚,印度,英国,法国,加拿大,西班牙,俄罗斯,其它',
    'vod_extend_lang' => '国语,英语,粤语,闽南语,韩语,日语,法语,德语,其它',
    'vod_extend_year' => '2021,2020,2019,2018,2017,2016,2015,2014,2013,2012,2011,2010,2009,2008,2007,2006,2005,2004,2003,2002,2001,2000',
    'vod_extend_weekday' => '一,二,三,四,五,六,日',
    'actor_extend_area' => '大陆,香港,台湾,美国,韩国,日本,泰国,新加坡,马来西亚,印度,英国,法国,加拿大,西班牙,俄罗斯,其它',
    'filter_words' => 'www,http,com,net',
    'extra_var' => '',
    'collect_timespan' => '2',
    'pagesize' => '30',
    'makesize' => '30',
    'admin_login_verify' => '0',
    'editor' => 'Ueditor',
    'lang' => 'zh-cn',
  ),
  'user' => 
  array (
    'status' => '0',
    'reg_open' => '1',
    'reg_status' => '1',
    'reg_phone_sms' => '0',
    'reg_email_sms' => '0',
    'email_white_hosts' => '',
    'email_black_hosts' => '',
    'reg_verify' => '0',
    'login_verify' => '0',
    'reg_points' => '10',
    'reg_num' => '1',
    'invite_reg_points' => '10',
    'invite_visit_points' => '1',
    'invite_visit_num' => '1',
    'reward_status' => '1',
    'reward_ratio' => '10',
    'reward_ratio_2' => '30',
    'reward_ratio_3' => '50',
    'cash_status' => '1',
    'cash_ratio' => '100',
    'cash_min' => '1',
    'trysee' => '0',
    'vod_points_type' => '1',
    'art_points_type' => '1',
    'portrait_status' => '1',
    'portrait_size' => '100x100',
    'filter_words' => 'admin,cao,sex,xxx',
  ),
  'gbook' => 
  array (
    'status' => '1',
    'audit' => '0',
    'login' => '0',
    'verify' => '1',
    'pagesize' => '20',
    'timespan' => '3',
  ),
  'comment' => 
  array (
    'status' => '1',
    'audit' => '0',
    'login' => '0',
    'verify' => '1',
    'pagesize' => '20',
    'timespan' => '3',
  ),
  'upload' => 
  array (
    'img_key' => 'baidu|douban|tvmao',
    'img_api' => '/img.php?url=',
    'thumb' => '0',
    'thumb_size' => '300x300',
    'thumb_type' => '1',
    'watermark' => '0',
    'watermark_location' => '7',
    'watermark_content' => 'dyxs.site',
    'watermark_size' => '40',
    'watermark_color' => '#FF0000',
    'protocol' => 'http',
    'mode' => 'local',
    'keep_local' => '0',
    'remoteurl' => 'http://img.test.com/',
    'api' => 
    array (
      'upyun' => 
      array (
        'bucket' => '',
        'username' => '',
        'pwd' => '',
        'url' => '',
      ),
      'uomg' => 
      array (
        'openid' => '',
        'key' => '',
        'type' => 'sogou',
      ),
      'qiniu' => 
      array (
        'bucket' => '',
        'accesskey' => '',
        'secretkey' => '',
        'url' => '',
      ),
      'ftp' => 
      array (
        'host' => '',
        'port' => '21',
        'user' => 'test',
        'pwd' => 'test',
        'path' => '/',
        'url' => '',
      ),
      'weibo' => 
      array (
        'user' => '',
        'pwd' => '',
        'size' => 'large',
        'cookie' => '',
        'time' => '1546239694',
      ),
    ),
  ),
  'interface' => 
  array (
    'status' => '0',
    'pass' => 'G75EHLCF9SD6VXPU',
    'vodtype' => '电影=电影#动作片=动作片#喜剧片=喜剧片#爱情片=爱情片#科幻片=科幻片#恐怖片=恐怖片#剧情片=剧情片#韩国剧=韩剧#日剧=日本剧',
    'arttype' => '头条=头条',
    'actortype' => '',
    'websitetype' => '',
  ),
  'pay' => 
  array (
    'min' => '10',
    'scale' => '1',
    'card' => 
    array (
      'url' => '',
    ),
    'alipay' => 
    array (
      'account' => '111',
      'appid' => '',
      'appkey' => '',
    ),
    'codepay' => 
    array (
      'appid' => '40625',
      'appkey' => '',
      'type' => '1,2',
      'act' => '0',
    ),
    'weixin' => 
    array (
      'appid' => '222',
      'mchid' => '',
      'appkey' => '',
    ),
    'zhapay' => 
    array (
      'appid' => '18039',
      'appkey' => '',
      'type' => '1,2',
      'act' => '2',
    ),
  ),
  'collect' => 
  array (
    'vod' => 
    array (
      'status' => '1',
      'hits_start' => '1',
      'hits_end' => '1000',
      'updown_start' => '1',
      'updown_end' => '1000',
      'score' => '0',
      'pic' => '0',
      'tag' => '0',
      'class_filter' => '1',
      'psename' => '1',
      'psernd' => '0',
      'psesyn' => '0',
      'pseplayer' => '0',
      'psearea' => '0',
      'pselang' => '0',
      'urlrole' => '0',
      'inrule' => ',f,g',
      'uprule' => ',a,c,d,u,v',
      'filter' => '色戒,色即是空',
      'namewords' => '第1季=第一季#第2季=第二季#第3季=第三季#第4季=第四季',
      'thesaurus' => ' =',
      'playerwords' => '',
      'areawords' => '',
      'langwords' => '',
      'words' => 'aaa#bbb#ccc#ddd#eee',
    ),
    'art' => 
    array (
      'status' => '1',
      'hits_start' => '1',
      'hits_end' => '1000',
      'updown_start' => '1',
      'updown_end' => '1000',
      'score' => '1',
      'pic' => '0',
      'tag' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'inrule' => ',b',
      'uprule' => ',a,d',
      'filter' => '无奈的人',
      'thesaurus' => '',
      'words' => '',
    ),
    'actor' => 
    array (
      'status' => '0',
      'hits_start' => '1',
      'hits_end' => '999',
      'updown_start' => '1',
      'updown_end' => '999',
      'score' => '0',
      'pic' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'uprule' => ',a,b,c',
      'filter' => '无奈的人',
      'thesaurus' => '',
      'words' => '',
      'inrule' => ',a',
    ),
    'role' => 
    array (
      'status' => '0',
      'hits_start' => '1',
      'hits_end' => '999',
      'updown_start' => '1',
      'updown_end' => '999',
      'score' => '0',
      'pic' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'uprule' => ',a,b,c',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'inrule' => ',a',
    ),
    'website' => 
    array (
      'status' => '0',
      'hits_start' => '',
      'hits_end' => '',
      'updown_start' => '',
      'updown_end' => '',
      'score' => '0',
      'pic' => '0',
      'psernd' => '0',
      'psesyn' => '0',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'inrule' => ',a',
      'uprule' => ',',
    ),
    'comment' => 
    array (
      'status' => '0',
      'updown_start' => '1',
      'updown_end' => '100',
      'psernd' => '0',
      'psesyn' => '0',
      'inrule' => ',b',
      'filter' => '',
      'thesaurus' => '',
      'words' => '',
      'uprule' => ',',
    ),
  ),
  'api' => 
  array (
    'vod' => 
    array (
      'status' => 0,
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => 'http://img.test.com/',
      'typefilter' => '',
      'datafilter' => ' vod_status=1',
      'cachetime' => '',
      'from' => '',
      'auth' => 'test.com#163.com',
    ),
    'art' => 
    array (
      'status' => 0,
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'art_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
    'actor' => 
    array (
      'status' => '0',
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'actor_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
    'role' => 
    array (
      'status' => '0',
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'role_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
    'website' => 
    array (
      'status' => '0',
      'charge' => '0',
      'pagesize' => '20',
      'imgurl' => '',
      'typefilter' => '',
      'datafilter' => 'website_status=1',
      'cachetime' => '',
      'auth' => '',
    ),
  ),
  'connect' => 
  array (
    'qq' => 
    array (
      'status' => '0',
      'key' => 'aa',
      'secret' => 'bb',
    ),
    'weixin' => 
    array (
      'status' => '0',
      'key' => 'cc',
      'secret' => 'dd',
    ),
  ),
  'weixin' => 
  array (
    'status' => '1',
    'duijie' => 'wx.test.com',
    'sousuo' => 'wx.test.com',
    'token' => 'qweqwe',
    'guanzhu' => '欢迎关注',
    'wuziyuan' => '没找到资源，请更换关键词或等待更新',
    'wuziyuanlink' => 'demo.test.com',
    'bofang' => '0',
    'msgtype' => '0',
    'gjc1' => '关键词1',
    'gjcm1' => '长城',
    'gjci1' => 'http://img.aolusb.com/im/201610/2016101222371965996.jpg',
    'gjcl1' => 'http://www.loldytt.com/Dongzuodianying/CC/',
    'gjc2' => '关键词2',
    'gjcm2' => '生化危机6',
    'gjci2' => 'http://img.aolusb.com/im/201702/20172711214866248.jpg',
    'gjcl2' => 'http://www.loldytt.com/Kehuandianying/SHWJ6ZZ/',
    'gjc3' => '关键词3',
    'gjcm3' => '湄公河行动',
    'gjci3' => 'http://img.aolusb.com/im/201608/201681719561972362.jpg',
    'gjcl3' => 'http://www.loldytt.com/Dongzuodianying/GHXD/',
    'gjc4' => '关键词4',
    'gjcm4' => '王牌逗王牌',
    'gjci4' => 'http://img.aolusb.com/im/201601/201612723554344882.jpg',
    'gjcl4' => 'http://www.loldytt.com/Xijudianying/WPDWP/',
  ),
  'view' => 
  array (
    'index' => '0',
    'map' => '0',
    'search' => '0',
    'rss' => '0',
    'label' => '0',
    'vod_type' => '0',
    'vod_show' => '0',
    'art_type' => '0',
    'art_show' => '0',
    'topic_index' => '0',
    'topic_detail' => '0',
    'vod_detail' => '0',
    'vod_play' => '0',
    'vod_down' => '0',
    'art_detail' => '0',
  ),
  'path' => 
  array (
    'topic_index' => 'topic/index',
    'topic_detail' => 'topic/{id}/index',
    'vod_type' => 'vodtypehtml/{id}/index',
    'vod_detail' => 'vodhtml/{id}/index',
    'vod_play' => 'vodplayhtml/{id}/index',
    'vod_down' => 'voddownhtml/{id}/index',
    'art_type' => 'arttypehtml/{id}/index',
    'art_detail' => 'arthtml/{id}/index',
    'page_sp' => '_',
    'suffix' => 'html',
  ),
  'rewrite' => 
  array (
    'suffix_hide' => '0',
    'route_status' => '0',
    'status' => '1',
    'encode_key' => 'abcdefg',
    'encode_len' => '6',
    'vod_id' => '0',
    'art_id' => '0',
    'type_id' => '0',
    'topic_id' => '0',
    'actor_id' => '0',
    'role_id' => '0',
    'website_id' => '0',
    'route' => 'map   => map/index
rss/index   => rss/index
rss/baidu => rss/baidu
rss/google => rss/google
rss/sogou => rss/sogou
rss/so => rss/so
rss/bing => rss/bing
rss/sm => rss/sm

index-<page?>   => index/index

gbook-<page?>   => gbook/index
gbook$   => gbook/index

topic-<page?>   => topic/index
topic$  => topic/index
topicdetail-<id>   => topic/detail

actor-<page?>   => actor/index
actor$ => actor/index
actordetail-<id>   => actor/detail
actorshow/<area?>-<blood?>-<by?>-<letter?>-<level?>-<order?>-<page?>-<sex?>-<starsign?>   => actor/show

role-<page?>   => role/index
role$ => role/index
roledetail-<id>   => role/detail
roleshow/<by?>-<letter?>-<level?>-<order?>-<page?>-<rid?>   => role/show


vodtype/<id>-<page?>   => vod/type
vodtype/<id>   => vod/type
voddetail/<id>   => vod/detail
vodrss-<id>   => vod/rss
vodplay/<id>-<sid>-<nid>   => vod/play
voddown/<id>-<sid>-<nid>   => vod/down
vodshow/<id>-<area?>-<by?>-<class?>-<lang?>-<letter?>-<level?>-<order?>-<page?>-<state?>-<tag?>-<year?>   => vod/show
vodsearch/<wd?>-<actor?>-<area?>-<by?>-<class?>-<director?>-<lang?>-<letter?>-<level?>-<order?>-<page?>-<state?>-<tag?>-<year?>   => vod/search
vodplot/<id>-<page?>   => vod/plot
vodplot/<id>   => vod/plot


arttype/<id>-<page?>   => art/type
arttype/<id>   => art/type
artshow-<id>   => art/show
artdetail-<id>-<page?>   => art/detail
artdetail-<id>   => art/detail
artrss-<id>-<page>   => art/rss
artshow/<id>-<by?>-<class?>-<level?>-<letter?>-<order?>-<page?>-<tag?>   => art/show
artsearch/<wd?>-<by?>-<class?>-<level?>-<letter?>-<order?>-<page?>-<tag?>   => art/search

label-<file> => label/index

plotdetail/<id>-<page?>   => plot/plot
plotdetail/<id>   => plot/detail',
  ),
  'email' => 
  array (
    'type' => 'Phpmailer',
    'time' => '5',
    'nick' => 'test',
    'test' => 'test@qq.com',
    'tpl' => 
    array (
      'test_title' => '【{$maccms.site_name}】测试邮件标题',
      'test_body' => '【{$maccms.site_name}】当您看到这封邮件说明邮件配置正确了！感谢支持开源程序！',
      'user_reg_title' => '【{$maccms.site_name}】的会员您好，请认真阅读邮件正文并按要求操作完成注册',
      'user_reg_body' => '【{$maccms.site_name}】的会员您好，注册验证码为：{$code}，请在{$time}分钟内完成验证。',
      'user_bind_title' => '【{$maccms.site_name}】的会员您好，请认真阅读邮件正文并按要求操作完成绑定',
      'user_bind_body' => '【{$maccms.site_name}】的会员您好，绑定验证码为：{$code}，请在{$time}分钟内完成验证。',
      'user_findpass_title' => '【{$maccms.site_name}】的会员您好，请认真阅读邮件正文并按要求操作完成找回',
      'user_findpass_body' => '【{$maccms.site_name}】的会员您好，找回验证码为：{$code}，请在{$time}分钟内完成验证。',
    ),
    'phpmailer' => 
    array (
      'host' => 'smtp.qq.com',
      'port' => '587',
      'secure' => 'tsl',
      'username' => 'test@qq.com',
      'password' => 'test',
    ),
  ),
  'play' => 
  array (
    'width' => '100%',
    'height' => '100%',
    'widthmob' => '100%',
    'heightmob' => '100%',
    'widthpop' => '0',
    'heightpop' => '600',
    'second' => '5',
    'prestrain' => '//dianyingxs.cc/static/player/prestrain.html',
    'buffer' => '//dianyingxs.cc/static/player/loading.html',
    'parse' => '',
    'autofull' => '0',
    'showtop' => '1',
    'showlist' => '1',
    'flag' => '0',
    'colors' => '000000,F6F6F6,F6F6F6,333333,666666,FFFFF,FF0000,2c2c2c,ffffff,a3a3a3,2c2c2c,adadad,adadad,48486c,fcfcfc',
  ),
  'sms' => 
  array (
    'type' => '',
    'sign' => '我的网站',
    'tpl_code_reg' => 'SMS_144850895',
    'tpl_code_bind' => 'SMS_144940283',
    'tpl_code_findpass' => 'SMS_144851023',
    'aliyun' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
    'qcloud' => 
    array (
      'appid' => '',
      'appkey' => '',
    ),
  ),
  'extra' => 
  array (
  ),
  'seo' => 
  array (
    'vod' => 
    array (
      'name' => '电影先生',
      'key' => '电影先生,短视频,搞笑视频,视频分享,免费视频,在线视频,预告片',
      'des' => '电影先生提供最新最快的视频分享数据',
    ),
    'art' => 
    array (
      'name' => '电影先生-文章首页',
      'key' => '电影先生,新闻资讯,娱乐新闻,八卦娱乐,狗仔队,重大事件',
      'des' => '电影先生提供最新最快的新闻资讯',
    ),
    'actor' => 
    array (
      'name' => '电影先生-演员首页',
      'key' => '电影先生,大陆明星,港台明星,日韩明星,欧美明星,最火明星',
      'des' => '电影先生明星个人信息介绍',
    ),
    'role' => 
    array (
      'name' => '电影先生-角色首页',
      'key' => '电影先生,电影角色,电视剧角色,动漫角色,综艺角色',
      'des' => '电影先生角色人物介绍',
    ),
    'plot' => 
    array (
      'name' => '电影先生-剧情首页',
      'key' => '电影先生,剧情连载,剧情更新,剧情前瞻,剧情完结',
      'des' => '电影先生提供最新的剧情信息',
    ),
    'website' => 
    array (
      'name' => '电影先生',
      'key' => '电影先生',
      'des' => '电影先生',
    ),
  ),
  'urlsend' => 
  array (
    'baidu' => 
    array (
      'token' => '4HEUmovpAwl15I1M',
    ),
    'baidufast' => 
    array (
      'token' => '4HEUmovpAwl15I1M',
    ),
  ),
);