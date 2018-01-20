<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$data.typename} - {$cfg.webname}</title>
<meta name="keywords" content="{$data.keywords}" />
<meta name="description" content="{$data.description}" />
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"}
<div class="body">
	<div class="breadcrumb"><a href="/">首页</a> > {$data.position}</div>
	<div class="body_l">
		<div class="shop_list">{volist name="$data.list" id="vo"}
			<dl>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></dd>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="pri"><em>￥3000起</em><span><a href="tencent://message/?uin=3547038718&Site=qq&Menu=yes" rel="nofollow">预定</a></span></dd>
			</dl>{/volist}
		</div>
		<div><ul class="pages">{$data.page}</ul></div>
	</div>
	<div class="body_r">
		<div class="pt015">
			<span class="module_t_c">推荐套餐</span>
			<ul class="piczy_price">{volist name="$data.mallList" id="vo" offset="0" length="5"}
				<li><div class="piczy_p_l"><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></div><div class="piczy_p_r"><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow">{$vo.title}</a><p>￥{$vo.shop.trueprice}</p></div></li>{/volist}
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
{include file="./theme/tot/footer.php"}
</body>
</html>