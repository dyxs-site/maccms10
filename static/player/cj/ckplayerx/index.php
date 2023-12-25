<?php
#require_once 'save/config.php';
if ($_GET['ac'] == "getdate") {
	$yzm = include ('data.php');
	if(strpos($yzm['yzm']['contextmenu'],chr(10)) !==false){
		$menu = explode(chr(10),$yzm['yzm']['contextmenu']);
		$contextmenu = [];
		foreach($menu as $v){
			if(strpos($v,',') !==false){
				$varr = explode(",",$v);
				$contextmenu[]=array(
					'title'=>$varr[0],
					'link'=>$varr[1],
				);
			}
		}
		if(!empty($contextmenu)){
			$yzm['yzm']['contextmenu'] = $contextmenu;
		}
	}else{
		if(strpos($yzm['yzm']['contextmenu'],',') !==false){
			$menu = explode(",",$yzm['yzm']['contextmenu']);
			$yzm['yzm']['contextmenu'] = array(array(
				'title'=>$menu[0],
				'link'=>$menu[1],
			));
		}
	}
	if(count($yzm['yzm']['contextmenu'])>0){
		$yzm['yzm']['contextmenu'][]=array('title'=>'关于视频','click'=>'aboutShow');
	}
	if(!empty($yzm['yzm']['ads']['pre']['list'])){
		$pre_list = [];
		foreach($yzm['yzm']['ads']['pre']['list'] as $v){
			$pre_list[] = $v;
		}
		$yzm['yzm']['ads']['pre']['list'] = $pre_list;
	}
	if(!empty($yzm['yzm']['ads']['pause']['list'])){
		$pause_list = [];
		foreach($yzm['yzm']['ads']['pause']['list'] as $v){
			$pause_list[] = $v;
		}
		$yzm['yzm']['ads']['pause']['list'] = $pause_list;
	}
	//print_R($yzm['yzm']);die;
	$user = !empty($_COOKIE['user_name'])?$_COOKIE['user_name']:'游客';
	$group_id = !empty($_COOKIE['group_id'])?$_COOKIE['group_id']:'';
	if(!empty($_COOKIE['user_id'])){
		$mysql = include '../../../../application/database.php';
		$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['password'],$mysql['database']);
		if(mysqli_connect_error()){

		}else{
			$result = $db->query("SELECT * FROM ".$mysql['prefix']."user WHERE user_id=" . $_COOKIE['user_id']);
			$row = $result->fetch_assoc();
			$group_id = $row['group_id'];
			$user = $row['user_name'];
		}
	}

	$yzm['yzm']['user'] = $user;
	$yzm['yzm']['group_id'] = $group_id;
    $json = [
       'code' => 1,
       'data' => $yzm['yzm']
    ];
	die(json_encode($json));
}