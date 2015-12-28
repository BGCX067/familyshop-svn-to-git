<?php
include_once ("init.php");
include_once (LIB_ROOT . "Sp/View.php");
include_once (LIB_ROOT . "Sp/Taobao/Goods.php");

/*
//$a = Sp_Data::get('index');

//$a = array('keywords'=>$a);
Config::load(DATA_CURRENT . 'index_temp.php');


//for($i=1;$i<5;$i++){
//	$a[] = Config::get('brandarray'.$i);
//}
$a['sales'] = Config::get('huodongarray');
print_r($a);
//$new_file = DATA_CURRENT . 'index_temp.php';
$new_file = DATA_CURRENT . 'index_hot_sales.php';
file_put_contents($new_file, '<?php return ' . var_export($a, true) . ';');

die();
*/

//装载页面数据
Config::load(DATA_CURRENT . 'index_hot_categores.php');
Config::load(DATA_CURRENT . 'index_hot_focus.php');
Config::load(DATA_CURRENT . 'index_hot_brands.php');
Config::load(DATA_CURRENT . 'index_hot_sales.php');
Config::load(DATA_CURRENT . 'index_categores.php');

//TODO 改为从数据文件中读取默认值
foreach(Config::get('index_categores') as $key=>$category) {
	$goods = Sp_Taobao_Goods::getCategoryItems($category['catid'], 40, Config::get('taoke.pid_short'));
	//从40个商品中随机取8个
	shuffle($goods['taobaoke_items']['taobaoke_item']);
	$goods['taobaoke_items']['taobaoke_item'] = array_slice($goods['taobaoke_items']['taobaoke_item'], 0, 8);
	
	$category = array_merge($category, $goods);
	Config::set('index_categores.' . $key, $category);
}

$sp_view = new Sp_View('utf-8');
$sp_view->addStyle('index.css');
//$sp_view->setTitle("测试");
$sp_view->setConfig(Config::get());
$sp_view->display("index.html");

//$url = "http://more.handlino.com/sentences.json?n=10&corpus=";
//$result = file_get_contents($url);
//print_r(json_decode($result));