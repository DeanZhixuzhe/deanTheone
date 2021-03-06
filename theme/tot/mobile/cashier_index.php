<!DOCTYPE html>
<html>
	<head>
	<title>订单支付</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.8.2/jquery.min.js"></script>
<style>
    *{
        margin:0;
        padding:0;
    }
    html,body,div,ul,li,p,span,em{margin: 0;}
    ul,ol{list-style:none;}
    body{
        font-family: "Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
        background: #f0eff5;
    }
    .hidden{display:none;}
    
    #main{width:100%;margin:0 auto;font-size:14px; z-index: 10;}
    .red-star{color:#f00;width:10px;display:inline-block;}
    .null-star{color:#fff;}
    
    #btn-dd{margin: 20px;text-align: center;}
    .new-btn-login-sp{padding: 1px;display: inline-block;width: 75%;}
    .new-btn-login {background-color: #02aaf1;color: #FFFFFF;font-weight: bold;border: none; width: 100%;height: 40px;border-radius: 5px;font-size: 20px;}
    .new-btn-login-sp a{background-color: #02aaf1;color: #FFFFFF;font-weight: bold;border: none; width: 100%;height: 40px;border-radius: 5px;font-size: 20px; text-decoration: none;}

    .one_line{ display: block; height: 1px; border: 0; border-top: 1px solid #eeeeee; width: 100%;margin-left: 20px; margin: 5px 0;}
    
    #body{background: #fff; padding: 20px 0;}
    .hide{display: none !important;}
    .paymode{background: #fff;margin-top: 10px;width: 100%;display: block;overflow: hidden;}
    .paymode label{width: 100%;margin: 5px 0 5px 20px;display: block;}
    .paymode label input{height: 60px; line-height: 60px; margin-left: 10px; overflow: hidden;}
    .paymode label img{width:205px; height:50px; }
    .paymode h2{width: 100%; background: #f0eff5; padding: 15px 0 15px 20px; font-size: 1.2em;}
    .paymode h4{width: 100%; background: #f0eff5; padding: 15px 0 15px 20px; cursor: pointer;}
    .footer {display: none;width:100%;text-align: center;background-color:#fff}
    .footer img{border: 0;margin: 0; width: 100%;}
    .header {width:100%;margin:0 auto;text-align: center;background-color:#fff}
    .header img{width: 100%;}
    .tabs_tit{width: 320px; height: 40px; margin: auto; clear: both; margin-left: 20px;}
    .tabs_tit li{float: left; padding: 5px 10px; cursor: pointer; }
    .tabs_tit li.hover{background: #ff5a00; color: #fff;}
    .on{display: block !important;}
    .miaoshu{width: 80%; margin: 20px auto; text-align: center;}
    .miaoshu img{width: 100%;}
    .jine{width: 80%; margin: 10px auto; text-align: center; font-size: 18px;}
    .jine input{border: 0; font-size: 26px; color: #ff6500; font-weight: bold; width: 75px;}
    .ddid{width: 80%; margin: 10px auto; text-align: center; font-size: 16px; color: #666;}
    .ddid input{border: 0; font-size: 16px; color: #666;}
    .spname{width: 80%; margin: 10px auto; text-align: center;}
    .spname input{border: 0; font-size: 16px; color: #666;}
    .content{margin-top:20px;background: #fff;}
    .content dt{width:100px;display:inline-block;float: left;margin-left: 20px; text-align:right;color: #666;font-size: 15px;margin-top: 8px;}
    .content dd{margin-left:120px;margin-bottom:5px;}
    .content dd input {width: 85%;height: 28px;border: 0;-webkit-border-radius: 0;-webkit-appearance: none; font-size: 15px;}
    
</style>
</head>
<body>
    <div id="main">
        <form action="{:url('index/Cashier/pay')}" method="get" name="payment" id="payment">
            <div id="body">
                <div class="miaoshu">
                    <img src="__STATIC__/{$Think.config.website.view_style}/images/pay/miaoshu_m.png">
                </div>
                <div class="jine">
                    待付金额：￥<input id="WIDtotal_fee" name="total_fee" value="{$data.trueprice}" readonly="ture"/>
                </div>
                <div class="ddid">
                    订单编号：<input id="WIDout_trade_no" name="out_trade_no" value="{$data.out_trade_no}" readonly="ture" />
                </div>
                <div class="spname">
                    <input id="WIDsubject" name="subject" value="{$data.title}" readonly="ture"/>
                </div>
                <dl class="content">
                    <input id="WIDbody" name="body" value="" hidden="" readonly="ture" />
                    <input type="hidden" name="show_url" value="{$Think.request.url}">
                </dl>
            </div>
            <div class="paymode">
                <h2>选择支付方式</h2>
                <label><img src="__STATIC__/{$Think.config.website.view_style}/images/pay/wechat_m.png"><input type="radio" name="pingtai" value="wechat" checked="checked" ></label>
			</div>
            <div class="paymode">
                <h4>更多支付方式</h4>
                <div class="hide">
                    <label><img src="__STATIC__/{$Think.config.website.view_style}/images/pay/alipay_m.png"><input type="radio" name="pingtai" value="alipay" ></label>
                </div>
            </div>
            <div id="btn-dd">
                <span class="new-btn-login-sp">
                    <input type="hidden" name="terminal" value="wap" >
                    <button class="new-btn-login" type="submit" style="text-align:center;">确 认</button>
                </span>
            </div>
		</form>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $(".paymode h4").click(function(){
            if($(this).parent().find("div").hasClass("hide")){
                $(this).parent().find("div").removeClass("hide");
            }else{
                $(this).parent().find("div").addClass("hide");
            }
        });
    });
</script>
</html>