<?php
date_default_timezone_set('Asia/Chongqing');

define('WEB_ROOT', dirname(__FILE__) . '/');

include_once WEB_ROOT . 'config/config.inc.php';
include_once LIB_ROOT . 'Config.php';
include_once LIB_ROOT . 'Function.php';

//TODO:删除调试
Config::set('isLoad', 0);

//初始化数据
if (Config::get('isLoad') == 0) {
	//系统配置数据
	Config::load(DATA_CURRENT . 'system_config.php');
	
	//网站页面数据
	Config::load(DATA_CURRENT . 'global_taobao_categores.php');
	Config::load(DATA_CURRENT . 'global_hot_navgation.php');
	Config::load(DATA_CURRENT . 'global_hot_keywords.php');
	Config::load(DATA_CURRENT . 'global_links.php');
	Config::load(DATA_CURRENT . 'global_main_navgation.php');
	
	Config::set('isLoad', 1);
}
