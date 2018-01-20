<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
{empty name="$data.seotitle"}
	{between name="$data.sortrank" value="101,200"}{$data.typename}{/between}
	{between name="$data.sortrank" value="201,800"}{$data.typename}_{$data.typename}策划_{$data.typename}价格_{$data.typename}视频{/between}
{else}$data.seotitle{/empty} - {$cfg.webname}</title>
<meta name="keywords" content="{empty name="$data.keywords"}
	{between name="$data.sortrank" value="101,200"}{$data.typename}{/between}
	{between name="$data.sortrank" value="201,800"}{$data.typename},{$data.typename}策划,{$data.typename}价格,{$data.typename}视频,{$data.typename}方案{/between}
{else}$data.keywords{/empty}" />
<meta name="description" content="{empty name="$data.description"}
	{between name="$data.sortrank" value="101,200"}{$data.typename}{/between}
	{between name="$data.sortrank" value="201,800"}{$data.typename}攻略包括,{$data.typename}策划、{$data.typename}价格、{$data.typename}视频、{$data.typename}方案等，更多{$data.typename}多少钱、创意、布置、歌曲等信息尽在TheOne求婚策划公司。{/between}
{else}$data.description{/empty}" />
<link rel="canonical" href="{$cfg.domain}{$data.typeurl}">
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"}
<div class="body">
	<div class="breadcrumb">{$data.position}</div>
	<div class="body_l">
		<div class="pt020">
			<span class="module_t_l mbn"><h1>{$data.typename}</h1></span>
			<div class="pic_list">{volist name="$data.list" id="vo"}
				<dl>
					<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
					<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
				</dl>{/volist}
			</div>
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