<?php
namespace app\admin\controller;
use think\Db;

class Player extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

	public function ckplayerx3()
	{
		$confing = ROOT_PATH .'static/player/cj/ckplayerx/data.php';
		if (Request()->isPost()) {
			$param = input();
			if(empty($param['yzm'])){
				return $this->error('参数错误！');
			}
			$param['yzm']['group'] = 0;
			$pre_list = [];
			$i=1;
			foreach($param['yzm']['ads']['pre']['list'] as $v){
				$pre_list[$i] = $v;
				$i++;
			}
			$param['yzm']['ads']['pre']['list'] = $pre_list;
			$pause_list = [];
			$j=1;
			foreach($param['yzm']['ads']['pause']['list'] as $v){
				$pause_list[$j] = $v;
				$j++;
			}
			$param['yzm']['ads']['pause']['list'] = $pause_list;
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
        $this->assign('title','Ckplayerx3播放器设置');
        return $this->fetch('admin@player/ckplayerx3');		
	}


}
