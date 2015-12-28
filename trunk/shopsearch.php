<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once 'inc/source_shopsearch.php'; ?>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $q."店铺榜-".$sitetitle?></title>
<meta name="keywords" content="<?php echo $q."店铺榜,".$sitetitle?>" />
<meta name="description" content="<?php echo "您所查看的是".$q."店铺榜,".$sitetitle."提醒您，使用支付宝交易，先收货后付款！"?>" />
<link rel="Shortcut Icon" href="favicon.ico">
<link rel="Bookmark" href="favicon.ico">
<script src="js/base64.js"></script>
<script src="js/function.js"></script>
<link href="css/<?php echo $style?>_all.css" rel="stylesheet" type="text/css" />
<link href="css/<?php echo $style?>_list.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function addfavor(url,title) {
    if(confirm("网站名称："+title+"\n网址："+url+"\n确定添加收藏?")){
        var ua = navigator.userAgent.toLowerCase();
        if(ua.indexOf("msie 8")>-1){
            external.AddToFavoritesBar(url,title,'');//IE8
        }else{
            try {
                window.external.addFavorite(url, title);
            } catch(e) {
                try {
                    window.sidebar.addPanel(title, url, "");//firefox
                } catch(e) {
                    alert("加入收藏失败，请使用Ctrl+D进行添加");
                }
            }
        }
    }
    return false;
}
</script>
</head>
<body>
<?php include("template/"."$style"."/shopsearch.php");?>
</body>
</html>