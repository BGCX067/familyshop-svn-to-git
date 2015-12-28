<?php
include_once ("init.php");
include_once (LIB_ROOT . "Sp/View.php");
include_once (LIB_ROOT . "Sp/Taobao/Goods.php");
include_once (LIB_ROOT . "Sp/Taobao/Shop.php");
include_once (LIB_ROOT . "Sp/Taobao/Taobaoke.php");

$sp_view = new Sp_View('utf-8');
$nick = (isset($_GET['nick']))?$_GET['nick']:$sp_view->out_404(true);

//静态编码网址转码
if (Config::get('special.static') == '1') {
	$nick = htmlspecialchars(url_base64_decode($nick));
}

//$goods = Sp_Taobao_Shop::getCategoes($nick,0,1,10);
//print_r($goods);


//商铺信息
$shop_info = Sp_Taobao_Shop::getShopinfo($nick);
if (isset($shop_info['shop'])) {
	$info = Sp_Taobao_Taobaoke::getShopsConvert($shop_info['shop']['sid'], Config::get('taoke.pid_short'));
	$click_url = $info['taobaoke_shops']['taobaoke_shop']['click_url'];
	$shop_info['shop']['click_url'] = $click_url;
}

//商店商品分类信息
$goods = Sp_Taobao_Goods::getShopItems($nick, null, 1, 1);

//按分类产品数量倒序
$category = $goods['item_search']['item_categories']['item_category'];
$category = array_sort($category, 'count', 'desc');

//最多取8个分类的商品，并且每个分类下的产品数量要大于4
$step = (count($category) < 8)?count($category):8;
$category = array_slice($category, 0, $step);

$catids = "";
foreach($category as $key=>$value) {
	if ($value['count'] > 4) {
		$catids .= $value['category_id'] . ',';
	}
}

$category = Sp_Taobao_Goods::getItemcats($catids);
if (!is_array(@$category[0])) {
	$cat[] = $category;
	$category = $cat;
}

//取每个分类的商品
foreach($category as $key=>$value) {
	$goods = Sp_Taobao_Goods::getShopItems($nick, $value['cid'], 1, 40);
	//从40个商品中随机取8个
	shuffle($goods['item_search']['items']['item']);
	$goods['item_search']['items']['item'] = array_slice($goods['item_search']['items']['item'], 0, 8);
	$category[$key]['items'] = $goods['item_search']['items']['item'];
}

$shop["shop"] = array (
		'items'=>$category, 
		'info'=>$shop_info['shop']);
//print_r($shop);
Config::load($shop);

$sp_view->setConfig(Config::get());
$sp_view->addStyle('shop.css');
$sp_view->setTitle(strip_tags($shop_info['shop']['title']));
//print_r($sp_view);
$sp_view->display("shop.html");
