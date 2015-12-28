<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<body>
<?php

$url = base64_decode($_GET["url"]);

?>
<form id="dianmengcom" name="dianmengcom" method="post" action="<?php echo $url;?>">
<input type="hidden" name="" id="" style="display:none">
</form>

<script type="text/javascript"> 



function no360()
{
alert('请使用IE浏览器购买商品。商城网站检测到360浏览器，为了防止360浏览器修改商品购买链接导致网站故障，请复制网址，并更换IE浏览器进行购买操作。');
document.execCommand("stop");

window.close();
}
var f=false;


if(navigator.userAgent.toLowerCase().indexOf("360")>-1){
	f=true;
}
try{
	if(window.external&&window.external.twGetRunPath){
		var r=external.twGetRunPath();
		if(r&&r.toLowerCase().indexOf("360")>-1){
			f=true;
		}
	}
}catch(ign){
	f=false;
}



if(f){
	no360()
};


if(!f) {
	try{
	document.getElementById("goto").click();
	}catch(e){
		
	}
	try{
	document.getElementById("dianmengcom").submit();
	}catch(e){
	location.href="<?php echo $url?>";
	}
}
</script>
</body>
</html>
