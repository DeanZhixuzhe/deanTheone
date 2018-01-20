<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$data.title} - {$cfg.webname}</title>
<meta name="keywords" content="{$data.keywords}" />
<meta name="description" content="{$data.description}" />
<link rel="canonical" href="{$cfg.domain}{$data.arctype.arcurl}">
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"}
<div class="body">
	<div class="breadcrumb"><a href="/">首页</a> > {$data.position} > {$data.title}</div>
	<div class="body_l">
		<div class="content">
			<h1>{$data.title}</h1>
			<div class="con_info"><span>作者：{$data.writer}</span><span>时间：{$data.pubdate}</span><span>浏览：{$data.click}</span></div>
			<div class="con_article">{$data.body}</div>
		</div>
		<div class="pt050">
			<span class="module_t_l">相关阅读</span>
			<ul class="colums2">{volist name="$data.list.t1" id="v"}{volist name="v" id="vo"}
				<li><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></li>{/volist}{/volist}
			</ul>
			<div class="cl"></div>
		</div>
		<div class="pt050">
			<span class="module_t_l">热门套餐<a href="/mall/" class="more" rel="nofollow">更多</a></span>
			<ul class="picsx_price">{volist name="$data.mallList" id="vo" offset="0" length="4"}
				<li><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"><span>{$vo.title}</span></a><p>￥{$vo.shop.trueprice}</p></li>{/volist}
				<div class="cl"></div>
			</ul>
		</div>
	</div>
	<div class="body_r">
		<div class="pt015">
			<span class="module_t_c bbn">相关栏目</span>
			<ul class="related_colums">{volist name="$data.typelist.same.1" id="vo"}
				<li><a href="{$vo.typeurl}">{$vo.typename}</a></li>
				{/volist}{volist name="$data.typelist.same.2" id="vo"}
				<li><a href="{$vo.typeurl}">{$vo.typename}</a></li>
				{/volist}
				<div class="cl"></div>
			</ul>
		</div>
		<div class="pt015">
			<span class="module_t_c">推荐套餐</span>
			<ul class="piczy_price">{volist name="$data.mallList" id="vo" offset="0" length="5"}
				<li><div class="piczy_p_l"><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></div><div class="piczy_p_r"><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow">{$vo.title}</a><p>￥{$vo.shop.trueprice}</p></div></li>{/volist}
			</ul>
		</div>
		<div class="pt015">
			<span class="module_t_c">最新求婚攻略</span>
			<ul class="colums1">{volist name="$data.list.nt1.16" id="vo" offset="0" length='2'}
				<li><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></li>{/volist}{volist name="$data.list.nt1.17" id="vo" offset="0" length='2'}
				<li><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></li>{/volist}{volist name="$data.list.nt1.18" id="vo" offset="0" length='2'}
				<li><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></li>{/volist}{volist name="$data.list.nt1.19" id="vo" offset="0" length='2'}
				<li><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></li>{/volist}{volist name="$data.list.nt1.20" id="vo" offset="0" length='2'}
				<li><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a></li>{/volist}
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
{include file="./theme/tot/footer.php"}
</body>
</html>