<?php
include_once ("init.php");
include_once (LIB_ROOT . "Sp/View.php");
include_once (LIB_ROOT . "Sp/Pager.php");
include_once (LIB_ROOT . "Sp/Taobao/Goods.php");
include_once (LIB_ROOT . "Sp/Taobao/Shop.php");

//list-1801-0-1-10000-w!bEpA-2.html
$cache_id = 'list|' . md5(var_export($_GET, true));
$sp_view = new Sp_View('utf-8');

if (!$sp_view->isCached('list.html', $cache_id)) {
	$cid = (isset($_GET['catid']))?$_GET['catid']:0;
	$sort = (isset($_GET['sort']))?$_GET['sort']:1;
	$start_price = (isset($_GET['sp']))?$_GET['sp']:Config::get('special.start_price');
	$end_price = (isset($_GET['ep']))?$_GET['ep']:Config::get('special.end_price');
	$keyword = (isset($_GET['sq']))?$_GET['sq']:'';
	$page_no = (isset($_GET['page']))?$_GET['page']:1;
	$page_size = 36;
	
	//静态编码网址转码
	if (Config::get('special.static') == '1') {
		$keyword = htmlspecialchars(url_base64_decode($keyword));
		if ($keyword != '') {
			$encode_keyword = url_base64_encode($keyword);
			$url_format = "list-$cid-$sort-$start_price-$end_price-$encode_keyword-%d.html";
		} else {
			$url_format = "list-$cid-$sort-$start_price-$end_price-%d.html";
		}
		//$url_format = "?catid=$cid&page=%d&sq=$keyword":"?catid=$cid&page=%d";
	} else {
		if ($keyword != '') {
			$url_format = "list.php?catid=$cid&sortnum=$sort&sp=$start_price&ep=$end_price&sq=$keyword&page=%d";
		
		} else {
			$url_format = "list.php?catid=$cid&sortnum=$sort&sp=$start_price&ep=$end_price&page=%d";
		}
	}
	/*
Array ( [catid] => 1801 [sortnum] => 0 [sp] => 1 [ep] => 10000 [sq] => w!bEpA [page] => 2 ) 
*/
	
	//如果cid为0，不返回类目信息
	$parent_cats = null;
	$current_cats = null;
	if ($cid != 0) {
		$parent_cats = Sp_Taobao_Goods::getItemParentCats($cid);
		$current_cats = Sp_Taobao_Goods::getItemcats($cid);
		//print_r($parent_cats);
	}
	
	$params = array (
			'keyword'=>$keyword, 
			'page_no'=>$page_no);
	
	$goods = Sp_Taobao_Goods::getCategoryItems($cid, $page_size, Config::get('taoke.pid_short'), $params);
	
	if ($goods) {
		$pager = new Sp_Pager($goods['total_results'], $page_no, $page_size, $url_format);
		$goods = $goods['taobaoke_items']['taobaoke_item'];
	}
	
	$list['list'] = array (
			'categores'=>$parent_cats, 
			'curr_cat'=>$current_cats, 
			'goods'=>$goods, 
			'keyword'=>$keyword, 
			'pager'=>(isset($pager))?$pager:null);
	
	Config::load($list);
	//print_r(Config::get());
	$sp_view->addStyle('list.css');
	$sp_view->addStyle('pager.css');
	$sp_view->setConfig(Config::get());
	
	$sp_view->caching = false;
	//$sp_view->cache_lifetime = 86400;
//$sp_view->cache_id = $cache_id;
}
$sp_view->display("list.html", $cache_id);

