<?php

namespace app\admin\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use app\common\util\PclZip;
use app\common\util\Dir;

include './addons/auto/func.php';
class Auto extends Base
{

    public function __construct()
    {
        parent::__construct();
    }
    // 初始化
    public function initialize()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $isTable = db()->query('SHOW TABLES LIKE ' . "'" . $tableName . "'");
        if (!$isTable) {
            $sql = "CREATE TABLE `{$tableName}` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` varchar(64) DEFAULT NULL COMMENT '资源站名称',
                  `old` varchar(150) DEFAULT NULL COMMENT '老域名',
                  `new` varchar(150) DEFAULT NULL COMMENT '新域名',
                  `type` varchar(32) DEFAULT NULL COMMENT '类型',
                  `runtime` datetime DEFAULT NULL COMMENT '运行时间',
                  `updatesql` longtext NOT NULL,
                  PRIMARY KEY (`id`),
                 KEY `old` (`old`,`new`,`type`),
                 KEY `runtime` (`runtime`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            $zxjg = db()->query($sql);
            //建立索引提升效率 可以注释掉 
            $indextable = $pre . "vod";
            $sql2 = "ALTER TABLE `{$indextable}` ADD INDEX `vod_play_from` (`vod_play_from`);";
            $ressql2 = db()->query($sql2);
        } else {
            return 0;
        }
    }
    // 首页
    public function index()
    {
        $param = input();
        $this->initialize(); //初始化创建数据库 
        $requesturl = config("autoconf")['url'];
        $ssl = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $ssl = 'https://';
        }
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $macuri=$requesturl . '/?api.html';
        $res=mac_curl_get($macuri);
        //$res = https_request($requesturl . '/?api.html', '', '', 1500, 3);
        $arrres = auto_json_decode($res);
        $imglist = $arrres['imglist'];
        $apilist = $arrres['apilist'];
        $v10list = $arrres['v10list'];
        $themelist = $arrres['themelist']; //plugin
        $pluginlist = $arrres['pluginlist'];
        require('./addons/auto/config/config.php');
        $version = $arrres['code'];
        $not = $arrres['info'];
        $sql = "SELECT COUNT(*) FROM $tableName ";
        $whereimg = ' WHERE type="图片" ';
        $whereplay = ' WHERE type="播放" ';
        $sqli = $sql . $whereimg;
        $imgc = db()->query($sqli);
        $imgcount = $imgc[0]['COUNT(*)'];
        $sqlp = $sql . $whereplay;
        $playc = db()->query($sqlp);
        $playcount = $playc[0]['COUNT(*)'];
        if ($playcount >= $arrres['play']) {
            $playcode = "播放地址 无需替换";
        } else {
            $playcode = "播放地址请及时替换以免影响用户正常播放";
        }
        if ($imgcount >= $arrres['img']) {
            $imgcode = "图片地址 无需替换";
        } else {
            $imgcode = "图片地址请及时替换以免影响页面美观";
        }
        $hostversion = config("autoconf")['version'];
        $this->assign('hostversion', $hostversion);
        $this->assign('version', $version);
        $this->assign('playcode', $playcode);
        $this->assign('imgcode', $imgcode);
        $this->assign('ssl', $ssl);
        $this->assign('rq', $rq);
        $this->assign('not', $not);
        $this->assign('apilist', $apilist);
        $this->assign('v10list', $v10list);
        $this->assign('imglist', $imglist);
        $this->assign('themelist', $themelist);
        $this->assign('pluginlist', $pluginlist); 
        return $this->fetch('admin@/auto/index');
    }
    public function addplay()
    {
        $param = input();
        $name = $param['name'];
        $apiinfo = $param['apiinfo'];
        $playurl = $param['playurl'];
        $player = array(
            'status' => '1',
            'from' => "$apiinfo",
            'show' => $name,
            'des' => $name,
            'target' => '_self',
            'ps' => '1',
            'parse' => $playurl,
            'sort' => '10000',
            'tip' => '无需安装任何插件',
        );
        $file = './application/extra/vodplayer.php';
        $vodlist = require($file);
        $vodlist[$apiinfo] = $player;
        file_replace_var($file, $vodlist);
        $code = "MacPlayer.Html='<iframe width=\"100%\" height=\"'+MacPlayer.Height+'\" src=\"" . $playurl . "'+MacPlayer.PlayUrl+'\" frameborder=\"0\" allowfullscreen=\"true\" border=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>';MacPlayer.Show();";
        $js = fwrite(fopen("./static/player/" . $apiinfo . ".js", "wb"), $code);
        return $this->success('添加采集源-播放器完成', 'auto/index');
    }
    public function addapi()
    {
        
        $param = input();
        $pre = config('database.prefix');
        $tableName = $pre . "collect";
        $name = $param['name'];
        $apiurl = $param['apiurl'];
        $res = Db::table($tableName)->insert(['collect_name' => $name, 'collect_url' => $apiurl, 'collect_type' => 2, 'collect_mid' => 1]);
        return $this->success('添加采集源完成');
    }
    public function theme()
    {
        echo "请联系客服获取";
        exit;
        /*$param = input();
        session_start();
        $arr = array($_SESSION);
        if (empty($arr['0']['think']['admin_auth'])) {
            echo "未登录";
            exit;
        }
        $v= $param['token'];
        $rq = config("autoconf")['url'];
        $post=array(
            'token'=>$v,
            );
        $res = https_request($rq . '/?theme.html', $post, '', 1500, 3);
        $arrlist = auto_json_decode($res);
        echo $this->fetch("admin@public/head");
		echo "<div class='update'><h1>正在下载模板文件,请稍后......</h1><textarea rows=\"10\" class='layui-textarea' readonly>正在下载模板压缩包...\n";
		ob_flush();
		flush();
		sleep(1);
		$save_path =ROOT_PATH . "application/data/update/". $v .".zip";
		$downurl=$arrlist['down'];
		$zip = mac_curl_get($downurl);
		@fwrite(@fopen($save_path, "wb"), $zip);
		if (!is_file($save_path)) {
			echo "下载模板失败，请重试...\n";
			exit;
		}
		if (filesize($save_path) < 1) {
			@unlink($save_path);
			echo "下载模板失败，请重试...\n";
			exit;
		}
		echo "下载模板完毕...\n";
		echo "正在处理模板的文件...\n";
		ob_flush();
		flush();
		sleep(1);
		$zipfile = new PclZip();
		$zipfile->PclZip($save_path);
		if (!$zipfile->extract(PCLZIP_OPT_PATH, '', PCLZIP_OPT_REPLACE_NEWER)) {
			echo $zipfile->error_string . "\n";
			echo "升级失败，请检查系统目录及文件权限！" . "\n";
			exit;
		}
		@unlink($save_path);
		$this->_cache_clear();
		echo "更新数据缓存文件...\n";
		echo "模板下载完成 请在系统设置中启用...";
		ob_flush();
		flush();
		echo "</textarea></div>";
		echo "<script type=\"text/javascript\">layui.use([\"jquery\",\"layer\"],function(){var layer=layui.layer,\$=layui.jquery;setTimeout(function(){var index=parent.layer.getFrameIndex(window.name);parent.location.reload();parent.layer.close(index)},\"6000\")});</script>";
        */
    }

    public function plugin()
    {
        $param = input();
        $v = $param['token'];
        $rq = config("autoconf")['url'];
        $post = array(
            'token' => $v,
        );
        $res = https_request($rq . '/?plugin.html', $post, '', 1500, 3);
        $arrlist = auto_json_decode($res);
        echo $this->fetch("admin@public/head");
        echo "<div class='update'><h1>正在下载插件文件,请稍后......</h1><textarea rows=\"10\" class='layui-textarea' readonly>正在下载插件压缩包...\n";
        ob_flush();
        flush();
        sleep(1);
        $save_path = ROOT_PATH . "application/data/update/" . $v . ".zip";
        $downurl = $arrlist['down'];
        $zip = mac_curl_get($downurl);
        @fwrite(@fopen($save_path, "wb"), $zip);
        if (!is_file($save_path)) {
            echo "下载插件失败，请重试...\n";
            exit;
        }
        if (filesize($save_path) < 1) {
            @unlink($save_path);
            echo "下载插件失败，请重试...\n";
            exit;
        }
        echo "下载插件完毕...\n";
        echo "正在处理插件的文件...\n";
        ob_flush();
        flush();
        sleep(1);
        $zipfile = new PclZip();
        $zipfile->PclZip($save_path);
        if (!$zipfile->extract(PCLZIP_OPT_PATH, '', PCLZIP_OPT_REPLACE_NEWER)) {
            echo $zipfile->error_string . "\n";
            echo "升级失败，请检查系统目录及文件权限！" . "\n";
            exit;
        }
        @unlink($save_path);
        $this->_cache_clear();
        echo "更新数据缓存文件...\n";
        echo "插件下载完成 请在系统设置中启用...";
        ob_flush();
        flush();
        echo "</textarea></div>";
        echo "<script type=\"text/javascript\">layui.use([\"jquery\",\"layer\"],function(){var layer=layui.layer,\$=layui.jquery;setTimeout(function(){var index=parent.layer.getFrameIndex(window.name);parent.location.reload();parent.layer.close(index)},\"6000\")});</script>";
    }
    public function update()
    {
        $param = input(); 
        $v = $param['to']; 
        $rq = config("autoconf")['url'] . '/update/';
        echo $this->fetch("admin@public/head");
        echo "<div class='update'><h1>在线升级中,请稍后......</h1><textarea rows=\"10\" class='layui-textarea' readonly>正在下载升级文件包...\n";
        ob_flush();
        flush();
        sleep(1);
        $save_path = ROOT_PATH . "application/data/update/" . $v . ".zip";
        $downurl = $rq . $v . ".zip";
        $zip = mac_curl_get($downurl);
        @fwrite(@fopen($save_path, "wb"), $zip);
        if (!is_file($save_path)) {
            echo "下载升级包失败，请重试...\n";
            exit;
        }
        if (filesize($save_path) < 1) {
            @unlink($save_path);
            echo "下载升级包失败，请重试...\n";
            exit;
        }
        echo "下载升级包完毕...\n";
        echo "正在处理升级包的文件...\n";
        ob_flush();
        flush();
        sleep(1);
        $zipfile = new PclZip();
        $zipfile->PclZip($save_path);
        if (!$zipfile->extract(PCLZIP_OPT_PATH, '', PCLZIP_OPT_REPLACE_NEWER)) {
            echo $zipfile->error_string . "\n";
            echo "升级失败，请检查系统目录及文件权限！" . "\n";
            exit;
        }
        @unlink($save_path);
        $this->_cache_clear();
        echo "更新数据缓存文件...\n";
        echo "插件升级完毕...";
        echo "请及时更新API设置token密钥，以恢复默认";
        ob_flush();
        flush();
        echo "</textarea></div>";
        echo "<script type=\"text/javascript\">layui.use([\"jquery\",\"layer\"],function(){var layer=layui.layer,\$=layui.jquery;setTimeout(function(){var index=parent.layer.getFrameIndex(window.name);parent.location.reload();parent.layer.close(index)},\"6000\")});</script>";
    }
    public function help()
    {
        $param = input();
        $v = $param['id'];
        if ($v == '') {
            return $this->success('无文件id 即将返回', 'auto/index');
        }
        $ssl = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $ssl = 'https://';
        }
        $requesturl = config("autoconf")['url']; 
        $resd = mac_curl_get($requesturl . '/?help.html&id='.$v); 
        $datelist = auto_json_decode($resd);
        $res = mac_curl_get($requesturl . '/?api.html');
        $arrres = auto_json_decode($res);
        $imglist = $arrres['imglist'];
        $apilist = $arrres['apilist'];
        $v10list = $arrres['v10list'];
        $themelist = $arrres['themelist']; //plugin
        $pluginlist = $arrres['pluginlist'];
        $not = $arrres['info'];
        require('./addons/auto/config/config.php');
        $this->assign('hostversion', $hostversion);
        $this->assign('version', $version);
        $this->assign('playcode', $playcode);
        $this->assign('imgcode', $imgcode);
        $this->assign('ssl', $ssl);
        $this->assign('rq', $rq);
        $this->assign('not', $not);
        $this->assign('apilist', $apilist);
        $this->assign('v10list', $v10list);
        $this->assign('imglist', $imglist);
        $this->assign('themelist', $themelist);
        $this->assign('pluginlist', $pluginlist);
        $this->assign('datelist', $datelist);
        //print_r($datelist);
        return $this->fetch('admin@/auto/info');
    }

    // 日志

    public function log()
    {
        $param = input();
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $page = $param['page'];
        $limit = $param['limit'];
        if ($page == '' or $page <= 1) {
            $page = 0;
        } else {
            $page = ($page - 1) * $limit;
        }
        if ($limit == '' or $limit <= 1) {
            $limit = 6;
        }
        $this->assign('page', $param['page']);
        $this->assign('limit', $param['limit']);

        $sql = "SELECT * FROM $tableName ";

        $where = ' WHERE 1=1 ';
        if (!empty($param['wd'])) {
            $this->assign('wd', $param['wd']);
            $where = $where . " AND name LIKE '%" . $param['wd'] . "%' ";
        }
        if (!empty($param['kstime']) && !empty($param['jstime'])) {
            $this->assign('kstime', $param['kstime']);
            $this->assign('jstime', $param['jstime']);
            $where = $where . " AND runtime >= '" . $param['kstime'] . ' 00:00:00' . "' AND runtime <= '" . $param['jstime'] . " 23:59:59'";
        }
        $sql = $sql . $where . " LIMIT " . $page . "," . $limit;
        $list = db()->query($sql);

        $sql = "SELECT COUNT(*) FROM $tableName ";
        $sql = $sql . $where;
        $jg = db()->query($sql);
        $count = $jg[0]['COUNT(*)'];
        $this->assign('list', $list);
        $this->assign('title', '日志列表');
        $this->assign('count', $count);
        return $this->fetch('admin@/auto/log');
    }
    // 删除日志
    public function dellog()
    {
        $param = input();
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $id = input('id');
        if ($id != '') {
            $where = [];
            $where['id'] = $id;
            $res = Db::table($tableName)->where($where)->delete();
            if ($res != 1) {
                return $this->error('删除失败，请重试!');
            }
            return $this->success('删除成功!');
        } else {

            $res = db()->execute("TRUNCATE $tableName;");
            if ($res != 0) {
                return $this->error('清空失败，请重试!');
            }
            return $this->success('清空成功!');
        }
    }
    public function autotype(){
        $param = input();
        $cjflag = input('cjflag');
        $cjurl = input('cjurl');
        $nname = input('cname');
        $name = input('name');
        $cjmd5 = md5($cjflag);
        $apiinfo = $param['apiinfo'];
        $playurl = $param['playurl'];
        $apires=mac_curl_get($cjurl);
        $apilist = auto_json_decode($apires)['class'];
        $type_list = model('Type')->getCache('type_list'); 
        $arrlist = arrlist_key_values($apilist, 'type_id', 'type_name');
        $typelist = arrlist_key_values($type_list, 'type_name', 'type_id');
        $config = config('bind');
        foreach ($arrlist as $key => $value) {
            if (!empty($typelist[$value])) {
                $col = $apiinfo."_".$key;
                $val = $typelist[$value]; 
                $config[$col] = intval($val);
            }
        }
        $res = mac_arr2file( APP_PATH .'extra/bind.php', $config);
        $list = config('timming');
        $list[$cjflag] = array(
            '__token__' => $cjmd5,
            'id' =>$cjflag,
            'status' => '1',
            'name' => $cjflag,
            'des' => '当日采集：' . $name . '【' . $nname . '】',
            'file' => 'collect',
            'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
            'weeks' => '1,2,3,4,5,6,0',
            'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
             
        );
        $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
        $player = array(
            'status' => '1',
            'from' => "$apiinfo",
            'show' => $name,
            'des' => $name,
            'target' => '_self',
            'ps' => '1',
            'parse' => $playurl,
            'sort' => '10000',
            'tip' => '无需安装任何插件',
        );
        $file = './application/extra/vodplayer.php';
        $vodlist = require($file);
        $vodlist[$apiinfo] = $player;
        file_replace_var($file, $vodlist);
        $code = "MacPlayer.Html='<iframe width=\"100%\" height=\"'+MacPlayer.Height+'\" src=\"" . $playurl . "'+MacPlayer.PlayUrl+'\" frameborder=\"0\" allowfullscreen=\"true\" border=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>';MacPlayer.Show();";
        $js = fwrite(fopen("./static/player/" . $apiinfo . ".js", "wb"), $code);
        $msg = "一键添加解析/自动分类(未创建不绑定)/定时任务成功";
        return $this->success($msg, 'auto/index');
    }
    public function addt()
    {
        $param = input();
        $cjflag = input('cjflag');
        $cjurl = input('cjurl');
        $nname = input('cname');
        $name = input('name');
        $cjmd5 = md5($cjflag);
        $list = config('timming');
        $list[$cjflag] = array(
            '__token__' => $cjmd5,
            'status' => '1',
            'id' =>$cjflag,
            'name' => $cjflag,
            'des' => '当日采集：' . $name . '【' . $nname . '】',
            'file' => 'collect',
            'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
            'weeks' => '1,2,3,4,5,6,0',
            'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
            'runtime' => time(),
        );
        $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
        $msg = "添加定时任务成功 请再宝塔中设置计划任务 访问 你的域名/api.php/timming/index.html?enforce=1&name=$name";
        return $this->success($msg, 'auto/index');
    }
    public function img()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        $rq = config("autoconf")['url'];

        $res = https_request($rq . '/?update-img.html', '', '', 1500, 3);
        $arrlist = auto_json_decode($res);
        //提高执行效率 先查询数据库 判断是否存在该资源   
        $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
        $res = db()->query($sql1);
        $arr = arrlist_values($res, 'vod_play_from');
        $arr = array_filter_empty($arr);
        foreach ($arr as $key => $value) {
            $vod_play_from_list = explode('$$$', $value);
            $rplist = arrlist_cond_orderby($arrlist, array('typename' => $vod_play_from_list['0']), array('upday' => -1), 1, 100);
            if (!empty($rplist)) {
                foreach ($rplist as $k => $v) {
                    $new = $v['new'];
                    $old = $v['old'];
                    $type = $v['typename'];
                    $sitename = $v['sitename'];
                    if (!empty($new)) {
                        $where['old'] = $old;
                        $where['new'] = $new;
                        $where['name'] = $sitename;
                        $infos = Db::table($tableName)->where($where)->find();
                        if (!$infos) {
                            $sql = 'UPDATE ' . $pre . 'vod SET vod_pic=REPLACE(vod_pic, "' . $old . '", "' . $new . '")';
                            $upres = Db::execute($sql);
                            if ($upres == 0) {
                                $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "图片", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                            } else {
                                $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "图片", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                            }
                        }
                    }
                }
            }
        }
        return $this->success('图片地址替换成功!', 'auto/index');
    }
    public function uri()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        $rq = config("autoconf")['url'];
        $res = mac_curl_get($rq . '/?vod.html');
        $arrlist = auto_json_decode($res);
        //提高执行效率 先查询数据库 判断是否存在该资源   
        $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
        $res = db()->query($sql1);
        $arr = arrlist_values($res, 'vod_play_from');
        $arr = array_filter_empty($arr);
        foreach ($arr as $key => $value) {
            $vod_play_from_list = explode('$$$', $value);
            $rplist = arrlist_cond_orderby($arrlist, array('typename' => $vod_play_from_list['0']), array('upday' => -1), 1, 100);
            if (!empty($rplist)) {
                foreach ($rplist as $k => $v) {
                    $new = $v['new'];
                    $old = $v['old'];
                    $type = $v['typename'];
                    $sitename = $v['sitename'];
                    $vodname = $v['vod_name'];
                    if (!empty($new)) {
                        $where['old'] = $old;
                        $where['new'] = $new;
                        $where['name'] = $sitename . $vodname;
                        $infos = Db::table($tableName)->where($where)->find();
                        if (!$infos) {
                            $sql = 'UPDATE ' . $pre . 'vod SET vod_play_url=REPLACE(vod_play_url, "' . $old . '", "' . $new . '") where vod_name="' . $vodname . '"';
                            $upres = Db::execute($sql);
                            if ($upres == 0) {
                                $res = Db::table($tableName)->insert(['name' => $sitename . $vodname, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                            } else {
                                $res = Db::table($tableName)->insert(['name' => $sitename . $vodname, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                            }
                        }
                    }
                }
            }
        }
        return $this->success('详细播放地址替换成功!', 'auto/index');
    }
    public function play()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        $rq = config("autoconf")['url'];
        $res = mac_curl_get($rq . '/?update-play.html'); 
        //$res = https_request($rq . '/?update-play.html', '', '', 1500, 3);
        $arrlist = auto_json_decode($res);
        //提高执行效率 先查询数据库 判断是否存在该资源   
        $sql1 = 'SELECT DISTINCT vod_play_from FROM ' . $pre . 'vod';
        $res = db()->query($sql1);
        $arr = arrlist_values($res, 'vod_play_from');
        $arr = array_filter_empty($arr);
        foreach ($arr as $key => $value) {
            $vod_play_from_list = explode('$$$', $value);
            $rplist = arrlist_cond_orderby($arrlist, array('typename' => $vod_play_from_list['0']), array('upday' => -1), 1, 100);
            if (!empty($rplist)) {
                foreach ($rplist as $k => $v) {
                    $new = $v['new'];
                    $old = $v['old'];
                    $type = $v['typename'];
                    $sitename = $v['sitename'];
                    if (!empty($new)) {
                        $where['old'] = $old;
                        $where['new'] = $new;
                        $where['name'] = $sitename;
                        $infos = Db::table($tableName)->where($where)->find();
                        if (!$infos) {
                            $sql = 'UPDATE ' . $pre . 'vod SET vod_play_url=REPLACE(vod_play_url, "' . $old . '", "' . $new . '")';
                            $upres = Db::execute($sql);
                            if ($upres == 0) {
                                $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                            } else {
                                $res = Db::table($tableName)->insert(['name' => $sitename, 'old' => $old, 'new' => $new, 'type' => "播放", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "请勿删除-本次替换数量" . $upres . "执行语句为:" . $sql]);
                            }
                        }
                    }
                }
            }
        }
        return $this->success('播放地址替换成功!', 'auto/index');
    }
    public function url()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        $rq = config("autoconf")['url'];
        $res = mac_curl_get($rq . '/?update-api.html');
        $arrlist = auto_json_decode($res);
        $list = config('vodplayer');
        foreach ($arrlist as $key => $value) {
            $apifrom = $value['apiinfo'];
            $name = $value['name'];
            $parse = $value['play'];
            if (!empty($list[$apifrom])) {
                $hostparse = $list[$apifrom]['parse'];
                if ($hostparse != $apifrom) {
                    $list[$apifrom] = array(
                        'status' => '1',
                        'from' => $apifrom,
                        'show' => $name,
                        'des' => $name,
                        'target' => '_self',
                        'ps' => '1',
                        'parse' => $parse,
                        'sort' => '10000',
                        'tip' => '无需安装任何插件',
                    );
                    $code = "MacPlayer.Html='<iframe width=\"100%\" height=\"'+MacPlayer.Height+'\" src=\"" . $parse . "'+MacPlayer.PlayUrl+'\" frameborder=\"0\" allowfullscreen=\"true\" border=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>';MacPlayer.Show();";
                    $js = fwrite(fopen("./static/player/" . $apifrom . ".js", "wb"), $code);
                    $resrep = mac_arr2file(APP_PATH . 'extra/vodplayer.php', $list);
                    $res = Db::table($tableName)->insert(['name' => $name, 'old' => $hostparse, 'new' => $parse, 'type' => "解析", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "Nosql--记录替换"]);
                }
            }
        }
        return $this->success('解析地址替换成功!', 'auto/index');
    }
    public function api()
    {
        $pre = config('database.prefix');
        $tableName = $pre . "autolog";
        $param = input();
        $rq = config("autoconf")['url'];
        $res = mac_curl_get($rq . '/?update-api.html');
        $arrlist = auto_json_decode($res);
        $list = config('timming');
        foreach ($arrlist as $key => $value) {
            $nname = $value['newname'];
            $cname = $value['cname'];
            $name = $value['name'];
            $cjflag = $value['apiinfo'];
            $cjurl = $value['api'];
            $cjmd5 = md5($cjflag);
            if (!empty($list[$cjflag])) {
                $hosturl = $list[$cjflag]['param'];
                parse_str($hosturl, $params);
                $hostapi = $params['cjurl'];
                if ($hostapi != $cjurl) {
                    $list[$cjflag] = array(
                        '__token__' => $cjmd5,
                        'status' => '1',
                        'id' =>$cjflag,
                        'name' => $cjflag,
                        'des' => '当日采集：' . $name . '【' . $nname . '】',
                        'file' => 'collect',
                        'param' => 'ac=cj&h=24&cjflag=' . $cjflag . '&cjurl=' . $cjurl,
                        'weeks' => '1,2,3,4,5,6,0',
                        'hours' => '00,01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23',
                        'runtime' => time(),
                    );
                    $res = mac_arr2file(APP_PATH . 'extra/timming.php', $list);
                    $res = Db::table($tableName)->insert(['name' => $name, 'old' => $hostapi, 'new' => $cjurl, 'type' => "API", 'runtime' => date('Y-m-d H:i:s'), 'updatesql' => "Nosql--记录替换"]);
                }
            }
        }
        return $this->success('定时任务-API地址替换成功!', 'auto/index');
    }
}
