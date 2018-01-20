<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{$data.typename} - {$cfg.webname}</title>
<meta name="keywords" content="{$data.keywords}" />
<meta name="description" content="{$data.description}" />`
{include file="./theme/tot/meta_m.php"}
</head>
<body>
<div id="header">
    <a class="return" href="javascript:if(document.referrer.indexOf('1314theone')>=0){history.go(-1);}else{window.location='/';}"><i class="am-icon-angle-left"></i></a>
    <h1>{$data.typename}</h1>
</div>
<div id="trip_list">
	<div class="hei30"></div>
    <ul>{volist name="$data.list" id="vo"}
		<li class="view">
            <a href="{$vo.arctype.arcurl}">
                <div class="pic">
                    <img src="http://img1.1314theone.com{$vo.litpic}">
                    <div class="cont">
						<span class="price">￥<em></em>起</span>
					</div>
                    <div class="clear"></div>
                </div>
                <div class="con">
                    <h5>{$vo.title}</h5>
                    <p>{$vo.description}...</p>
                </div>
            </a>
        </li>{/volist}
	</ul>
    <div id="none">
        没有更多了
    </div>
</div>
{include file="./theme/tot/footer_m.php"}
</body>
</html>