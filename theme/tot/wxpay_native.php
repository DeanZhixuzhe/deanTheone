<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>TheOne在线支付</title>
    <style type="text/css">
        .wechat_pay{width: 980px; height: 430px; margin: 30px auto; background: url(/static/tot/images/pay/wechat_pay.png);}
        .wechat_pay img{width: 270px; height: 270px; margin-left: 140px; margin-top: 40px;}
    </style>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
    <div class="wechat_pay"><img alt="TheOne在线支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data={$data.code_url}"/></div>
</body>
<script type="text/javascript">
function pay_status(){
    var orderid = "{$out_trade_no}";
    
    $.ajax({
        type:"post",
        url:"{:url('index/Cashier/wxpayAjax')}",
        data:{'order_id':orderid},
        success:function(data){
            if(data == '1'){
                window.clearInterval(int);
                setTimeout(function(){
                    window.location.href="{:url('index/Cashier/notice',['result' => 'success'])}";
                },500);
            }else if(data == '2'){
                window.clearInterval(int);
                setTimeout(function(){
                    window.location.href="{:url('index/Cashier/notice',['result' => 'fail'])}";
                },500);
            }
        },
        error:function(){
            window.clearInterval(int);
            window.location.href="{:url('index/Cashier/notice',['result' => 'fail'])}";
        }
    });
}
var int = setInterval(function(){pay_status()},2000);
</script>
</html>