<?php
/**
 * 数据接口
 * 
 * 把post上来的数据保存到指定的data目录下的指定文件
 * 
 * @author:dayuer@gmail.com
 */
include_once 'init.php';

$data = (isset($_POST['data']))?$_POST['data']:die();
$tsc = (isset($_POST['tsc']))?$_POST['tsc']:die();

//校验数据指纹
$data = base64_decode($data);
$_tsc = md5(md5($data) . API_PASSWORD);

if($_tsc != $tsc){
	die('data error.');
}

$data = unserialize($data);

$filename = $data['filename'];
$content = unserialize($data['content']);

$data_file = DATA_CURRENT . $filename;
file_put_contents($data_file, '<?php return ' . var_export($content, true) . ';');

