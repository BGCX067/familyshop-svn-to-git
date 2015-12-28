<?php
if (!defined('WEB_ROOT'))
	exit('not allow access');

$hosts = explode('.', $_SERVER['HTTP_HOST']);
$hosts = array_reverse($hosts);

define('SP_HOST', 'www.' .$hosts[1] . '.' . $hosts[0]);
define('API_CACHE_ROOT', WEB_ROOT . 'cache/apicache/');
define('CONF_ROOT', WEB_ROOT . 'config/');
define('CACHE_ROOT', WEB_ROOT . 'cache/');
define('SKIN_ROOT', WEB_ROOT . 'template/');
define('DATA_CURRENT', WEB_ROOT . 'cache/' . SP_HOST . '/data/');
define('LIB_ROOT', WEB_ROOT . 'libs/');
//define('VIEW_SKIN_CURRENT', 'default');


//远程更新接口和密码
define('API_URL', DATA_CURRENT . 'Api.php');
define('API_PASSWORD', 'libs');

//模版定义
define('SMARTY_DIR', LIB_ROOT . 'third/smarty-3.0.8/libs/');
//defined('VIEW_TEMPLATE_DIR') || define('VIEW_TEMPLATE_DIR', SKIN_ROOT . 'default/' );
define('VIEW_COMPILE_DIR', CACHE_ROOT . 'view/tpl_c');
define('VIEW_CACHE_DIR', CACHE_ROOT . 'view/cache');
//define('VIEW_CACHE_LIFETIME', 1440 );
//define('VIEW_CACHE_ENABLE', !_PS_DEBUG );
define('VIEW_CONFIG_DIR', CONF_ROOT);
define('VIEW_SKINS_ROOT', SKIN_ROOT);
define('VIEW_SKINS_AVAILABLE', 'default'); // default skin1 skin2
define('VIEW_SKIN_DEFAULT', 'default');

// urls
define('SP_URL_HOME', 'http://' . SP_HOST . '/');
define('SP_URL_STO', SP_URL_HOME . 'template/' . VIEW_SKIN_DEFAULT . '/sto/');
define('SP_URL_CSS', SP_URL_STO . 'c/');
define('SP_URL_IMG', SP_URL_STO . 'i/');
define('SP_URL_JS', SP_URL_STO . 'j/');
