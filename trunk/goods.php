<?php
include_once ("init.php");
include_once (LIB_ROOT . "Sp/View.php");
include_once (LIB_ROOT . "Sp/Taobao/Goods.php");
include_once (LIB_ROOT . "Sp/Taobao/Shop.php");
include_once (LIB_ROOT . "Sp/Taobao/Taobaoke.php");

$sp_view = new Sp_View('utf-8');
$cache_id = 'goods|' . md5(var_export($_GET, true));
if (!$sp_view->isCached('goods.html', $cache_id)) {
	$num_iid = (isset($_GET['iid']))?$_GET['iid']:$sp_view->out_404(true);
	
	/*
	$categores = Sp_Taobao_Shop::getCategoes('康美健食品专营店');
	print_r($categores);
	die();
	*/
	
	//取商品详情
	$goods_detail = Sp_Taobao_Goods::getItemDetail($num_iid);
	//淘宝客点击url
	$url = Sp_Taobao_Taobaoke::getItemConvert($num_iid, Config::get('taoke.pid_short'));
	
	$cid = $goods_detail["item"]['cid'];
	$props = $goods_detail["item"]['props'];
	
	//商品属性
	$props = Sp_Taobao_Goods::getItemPropValues($cid, $props);
	
	//商品分类信息
	$catgory = Sp_Taobao_Goods::getItemcats($cid);
	//当前分类的推荐商品
	$cat_goods = Sp_Taobao_Goods::getCategoryItems($cid, 40, Config::get('taoke.pid_short'));
	
	//从40个商品中随机取8个
	shuffle($cat_goods['taobaoke_items']['taobaoke_item']);
	$cat_goods['taobaoke_items']['taobaoke_item'] = array_slice($cat_goods['taobaoke_items']['taobaoke_item'], 0, 8);
	
	//商品的评价信息
	$rates = Sp_Taobao_Goods::getItemsTraderates($goods_detail['item']['num_iid'], $goods_detail['item']['nick']);
	if ($rates['total_results'] > 0) {
		$rates = $rates['trade_rates']['trade_rate'];
	} else {
		$rates = null;
	}
	
	$goods["goods"] = array (
			"item"=>$goods_detail['item'], 
			"cat_items"=>$cat_goods['taobaoke_items']['taobaoke_item'], 
			"taobaoke"=>$url["taobaoke_items"]["taobaoke_item"], 
			"props"=>$props, 
			"category"=>$catgory, 
			"rates"=>$rates);
	
	Config::load($goods);
	$sp_view->setConfig(Config::get());
	$sp_view->addStyle('goods.css');
	$sp_view->setTitle($goods_detail['item']['title']);
	$sp_view->caching = true;
	$sp_view->cache_lifetime = 86400;
	$sp_view->cache_id = $cache_id;
}

$sp_view->display("goods.html", $cache_id);
