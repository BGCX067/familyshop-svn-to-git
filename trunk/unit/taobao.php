<?php
include_once ("../init.php");
include_once ("../libs/Sp/Taobao.php");

/**
 * 淘宝api单元测试
 */

$params = array (
		'cid'=>16, 
		'page_size'=>10);

//taoapi("taobao.taobaoke.items.get", $params);


$params = array (
		'num_iid'=>5042041951);
//taoapi("taobao.item.get", $params);


$params = array (
		'num_iids'=>135317208, 
		'pid'=>'10057597');
//taoapi("taobao.taobaoke.items.convert", $params);


$params = array (
		'nick'=>'康美健食品专营店', 
		'page_size'=>'10');
//taoapi("taobao.products.get", $params);


$params = array (
		'num_iids'=>135317208, 
		'pid'=>'10057597');
//taoapi("taobao.item.skus.get", $params);


$params = array (
		'cids'=>'50011993');
taoapi("taobao.itemcats.get", $params);

function taoapi($method, $params) {
	$sp_taobao = Sp_Taobao::factory($method);
	$sp_taobao->assign($params);
	$ret = $sp_taobao->getData($params);
	print_r($ret);
	return $ret;
}


 