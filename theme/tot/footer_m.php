<div class="foot_h"></div>
<div id="footer">
    <ul class="am-avg-sm-4">
        <li class="active">
            <a href="{$Request.domain}">
                <img src="__STATIC__/tot/m/images/icon-footer01-a.png"/>
                <p>首页</p>
            </a>
        </li>
        <li>
            <a href="/mall/" rel="nofollow">
                <img src="__STATIC__/tot/m/images/icon-footer2-a.png"/>
                <p>商城</p>
            </a>
        </li>
        <li>
            <a href="mqqwpa://im/chat?chat_type=wpa&uin=3547038718&version=1&src_type=web&web_src=1314theone.com" rel="nofollow" target="_blank" rel="nofollow">
                <img src="__STATIC__/tot/m/images/icon-footer2-a.png"/>
                <p>定制</p>
            </a>
        </li>
        <li class="am-dropdown am-dropdown-up" data-am-dropdown>
            <a rel="nofollow" class="am-dropdown-toggle">
                <img src="__STATIC__/tot/m/images/icon-footer2-a.png"/>
                <p>客服</p>
            </a>
            <div class="am-dropdown-content foot_kf">
                <a href="mqqwpa://im/chat?chat_type=wpa&uin=3547038718&version=1&src_type=web&web_src=1314theone.com" rel="nofollow" target="_blank">QQ咨询</a>
                <a href="javascript:;" id="weixin">微信咨询</a>
                <a href="tel:17353237074" rel="nofollow">电话咨询</a>
            </div>
        </li>
    </ul>
    <div class="wxsb">
        <p>微信中长按图片识别二维码</p>
        <img src="__STATIC__/tot/images/wechat@linda_1.jpg">
        <p>或者复制微信号加好友</p>
        <span>theonelangman</span>
    </div>
    <div class="foot_mask"></div>
</div>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?b852b11b2eba5cc8858312816b5106eb";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111774359-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111774359-1');
</script>
<script type="text/javascript">
    $(function() {
        $('#weixin').click(function(e){
            if ($('.wxsb').hasClass('wxshow')) {
                $('.wxsb').removeClass('wxshow');
                $('.foot_mask').css('display','none');
            }else {
                $('.wxsb').addClass('wxshow');
                $('.foot_mask').css('display','block');
            }
            e.stopPropagation();
        });
        $('.wxsb').click(function(e){
            e.stopPropagation();
        });
        $('.foot_mask').click(function(e){
            $('.wxsb').removeClass('wxshow');
            $('.foot_mask').css('display','none');
        });

        $('#header .tit').click(function(e){
            if ($('#header .con').hasClass('conshow')) {
                $('#header .con').removeClass('conshow');
                $('.head_mask').css('display','none');
            }else {
                $('#header .con').addClass('conshow');
                $('.head_mask').css('display','block');
            }
            e.stopPropagation();
        });
        $('#header .con').click(function(e){
            e.stopPropagation();
        });
        $('.head_mask').click(function(e){
            $('#header .con').removeClass('conshow');
            $('.head_mask').css('display','none');
        });

        $('#header_s .tit').click(function(e){
            if ($('#header_s .con').hasClass('conshow')) {
                $('#header_s .con').removeClass('conshow');
                $('.head_mask').css('display','none');
            }else {
                $('#header_s .con').addClass('conshow');
                $('.head_mask').css('display','block');
            }
            e.stopPropagation();
        });
        $('#header_s .con').click(function(e){
            e.stopPropagation();
        });
        $('.head_mask').click(function(e){
            $('#header_s .con').removeClass('conshow');
            $('.head_mask').css('display','none');
        });
    });
</script>