<?php
namespace app\admin\controller;
use think\Db;

class Aliplayer extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

	public function set()
	{
		$confing = ROOT_PATH .'static/player/cj/aliplayer/data.php';
		if (Request()->isPost()) {
			$param = input();
			if(empty($param['yzm'])){
				return $this->error('参数错误！');
			}
			$param['yzm']['group'] = 0;
			$res = mac_arr2file($confing, $param);
			if($res===false){
				return $this->error('保存配置失败！请检查['.$confing.']文件写入权限！');
			}
			return $this->success('保存配置成功');
		}
		$group = model('Group')->getCache();
		$data = include $confing;
        $this->assign('yzm',$data['yzm']);
		$this->assign('group',$group);
        $this->assign('title','Aliplayer播放器设置');
        return $this->fetch('admin@player/aliplayer');		
	}

}
