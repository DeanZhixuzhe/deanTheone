<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{empty name="$data.seotitle"}{$data.typename}{else}{$data.seotitle}{/empty} - {cfg.webname}</title>
<meta name="keywords" content="{$data.keywords}" />
<meta name="description" content="{$data.description}" />
<link rel="canonical" href="{$cfg.domain}{$data.typeurl}">
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"/}
<div class="body">
	<div class="breadcrumb"><a href="/">首页</a> > {$data.position}</div>
	<div class="body_l">
		<div class="module_t_l mbn">
			<h1>求婚策划</h1><a href="/proposal/plan/" class="more" target="_blank">更多求婚策划</a>
		</div>
		<div class="pic_list">{volist name="$data.list.t1.16" id="vo" offset="0" length="6"}
			<dl>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
			</dl>{/volist}
		</div>
		<div class="module_t_l mbn">
			<h1>求婚创意</h1><a href="/proposal/originality/" class="more" target="_blank">更多求婚创意</a>
		</div>
		<div class="pic_list">{volist name="$data.list.t1.17" id="vo" offset="0" length="6"}
			<dl>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
			</dl>{/volist}
		</div>
		<div class="module_t_l mbn">
			<h1>求婚方式</h1><a href="/proposal/mode/" class="more" target="_blank">更多求婚方式</a>
		</div>
		<div class="pic_list">{volist name="$data.list.t1.18" id="vo" offset="0" length="6"}
			<dl>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
			</dl>{/volist}
		</div>
		<div class="module_t_l mbn">
			<h1>求婚歌曲</h1><a href="/proposal/song/" class="more" target="_blank">更多求婚歌曲</a>
		</div>
		<div class="pic_list">{volist name="$data.list.t1.19" id="vo" offset="0" length="6"}
			<dl>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
			</dl>{/volist}
		</div>
		<div class="module_t_l mbn">
			<h1>求婚词</h1><a href="/proposal/word/" class="more" target="_blank">更多求婚词</a>
		</div>
		<div class="pic_list">{volist name="$data.list.t1.20" id="vo" offset="0" length="6"}
			<dl>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
			</dl>{/volist}
		</div>
		<div class="module_t_l mbn">
			<h1>求婚戒指</h1><a href="/proposal/ring/" class="more" target="_blank">更多求婚戒指</a>
		</div>
		<div class="pic_list">{volist name="$data.list.t1.21" id="vo" offset="0" length="6"}
			<dl>
				<dt><a href="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></dt>
				<dd class="tit"><a href="{$vo.arctype.arcurl}" target="_blank" title="{$vo.title}">{$vo.title}</a></dd>
			</dl>{/volist}
		</div>
	</div>
	<div class="body_r">
		<div class="pt015">
			<span class="module_t_c bbn">相关栏目</span>
			<ul class="related_colums">{volist name="$data.typelist.child.1" id="vo"}
				<li><a href="{$vo.typeurl}">{$vo.typename}</a></li>
				{/volist}{volist name="$data.typelist.child.2" id="vo"}
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
	</div>
	<div class="cl"></div>
</div>
{include file="./theme/tot/footer.php"/}
</body>
</html>