<?php
namespace addons\Auto;
use think\Addons;
use app\common\util\Dir;

class Auto extends Addons

{
	/**
	 * 插件安装方法
	 * @return bool
	 */
	public function install()
	{
		return true;
	}
	/**
	 * 插件启用方法 
	 */
	public function enable()
	{
		$filenav = APP_PATH . 'extra/quickmenu.php';
		$lod_nav = '牛牛助手,auto/index';
		$nav = '牛牛助手,auto/index';
		if (file_exists($filenav)) {
			$nav_lod = config('quickmenu');
			if (in_array($nav, $nav_lod)) {
				return true;
			}
			if (in_array($lod_nav, $nav_lod)) {
				foreach ($nav_lod as $v) {
					if ($v != $lod_nav) {
						$nav_lod2[] = $v;
					}
				}
				$nav_lod = $nav_lod2;
			}
			$nav_new[] = $nav;
			$new_nav = array_merge($nav_lod, $nav_new);
			$res = mac_arr2file(APP_PATH . 'extra/quickmenu.php', $new_nav);
		}
		$filenav = APP_PATH . 'data/config/quickmenu.txt';
		if (file_exists($filenav)) {
			$nav_lod = @file_get_contents($filenav);
			if (strpos($nav_lod, $lod_nav) !== false) {
				$nav_lod = str_replace(PHP_EOL . $lod_nav, "", $nav_lod);
			}
			if (strpos($nav_lod, $nav) !== false) {
				return true;
			} else {
				$new_nav = $nav_lod . PHP_EOL . $nav;
				@fwrite(fopen($filenav, 'wb'), $new_nav);
			}
		}
		//清理缓存
		$request = controller('admin/index');
        $request->clear();
		//清理缓存
		return true;
	}
	/**
	 * 插件禁用方法
	 */
	public function disable()
	{
		$this->delquick();
		return true;
	}
	/**
	 * 删除插件文件 
	 * @return bool
	 */
	public function uninstall()
	{
		$items = [

			['dir', APP_PATH . 'admin/view/auto/'],
			['file', APP_PATH . 'api/controller/Auto.php'],
			['file', APP_PATH . 'admin/controller/Auto.php'],

		];
		foreach ($items as &$v) {
			if ($v[0] == 'dir') {
				if (is_dir($v[1])) {
					Dir::delDir($v[1]);
				}
			} else {
				if (file_exists($v[1])) {
					unlink($v[1]);
				}
			}
		}
		$this->delquick();
		//清理缓存
		$request = controller('admin/index');
        $request->clear();
		//清理缓存
		return true;
	}

	/*
	 * 卸载快捷菜单
	*/
	public function delquick()
	{
		$del_menu = '牛牛助手,auto/index';
		$filenav = APP_PATH . 'extra/quickmenu.php';
		if (file_exists($filenav)) {
			$nav_lod = config('quickmenu');
			if (in_array($del_menu, $nav_lod)) {
				foreach ($nav_lod as $v) {
					if ($v != $del_menu) {
						$new_nav[] = $v;
					}
				}
				$res = mac_arr2file(APP_PATH . 'extra/quickmenu.php', $new_nav);
			}
		}
		$filenav = APP_PATH . 'data/config/quickmenu.txt';
		if (file_exists($filenav)) {
			$nav_lod = @file_get_contents($filenav);
			if (strpos($nav_lod, $del_menu) !== false) {
				$nav_lod = str_replace(PHP_EOL . $del_menu, "", $nav_lod);
				@fwrite(fopen($filenav, 'wb'), $nav_lod);
			}
		}
		return true;
	}
}
