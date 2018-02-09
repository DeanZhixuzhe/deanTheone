<!DOCTYPE html>
<html>
<head>
	<title>在浏览器中打开完成支付</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php echo $jump; ?>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
	*{margin:0;padding:0;}
    html,body,div,ul,li,p,span,em{margin: 0;}
    ul,ol{list-style:none;}
    body{font-family: "Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;background: #f0eff5;}
	.alipay_ext{position: absolute; top: 0; left: 0; opacity: .8; width: 100%;height: 100%; background: #000;z-index: 999; overflow: hidden; display: block;}
    .alipay_ext ul{width: 80%; margin: 20% auto; z-index: 1000;}
    .alipay_ext li{color: #fff; height: 35px; line-height: 35px; font-size: 20px; margin-bottom: 15px; overflow: hidden; position: relative;}
    .alipay_ext li em{border-radius: 50%; font-style: normal; font-size: 18px; padding: 5px 10px; background: #ff0000; margin-right: 10px; text-align: center; overflow: hidden;}
    .alipay_ext li img{height: 25px; position: absolute; bottom: 5px; padding: 0 3px; background-color: #000;}
    .alipay_ext .jiant{position: absolute; top: 10px; right: 10px; height: 15%; width: 25%}
</style>
</head>
<body>
	<div class="alipay_ext" id="alipay_ext">
        <img src="/static/images/pay/short-arrow.png" class="jiant">
        <ul>
            <?php echo $data; ?>
        </ul>
    </div>
</body>
</html>