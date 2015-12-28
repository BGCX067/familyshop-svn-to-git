<?php
$url = $_GET["url"];
$url = base64_decode($url);
?>
<form id="dianmengcom" name="dianmengcom" method="post" action="<?php echo $url ?>">
<input type="submit" name="" id="" style="display:none">
</form>
<script type="text/javascript"> 
document.getElementById("dianmengcom").submit();
</script>