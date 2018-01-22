<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$data.typename}策划_{$data.typename}公司_{$data.typename}策划价格_{$data.typename}地点 - TheOne求婚策划公司</title>
<meta name="keywords" content="{empty name="$data.keywords"}{$data.typename},{$data.typename}策划,{$data.typename}公司,{$data.typename}策划价格，{$data.typename}地点
{else}{$data.keywords}{/empty}" />
<meta name="description" content="{empty name="$data.description"}TheOne求婚策划公司重庆分公司为您提供{$data.typename}服务、{$data.typename}策划方案、{$data.typename}策划价格咨询、{$data.typename}地点推荐等服务，了解更多{$data.typename}策划多少钱及费用相关信息尽在TheOne求婚策划。
{else}{$data.description}{/empty}" />
<link rel="canonical" href="{$cfg.domain}{$data.typeurl}">
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"}
<div class="banner">
	<video autoplay="true" loop="true" ><source src="http://img1.1314theone.com/TheOne01.mp4" type="video/mp4"></video>
	<div class="info">
		<p>为她呈现你独一无二的爱</p>
		<span>专业定制求婚策划</span>
		<a href="tencent://message/?uin=3547038718&Site=qq&Menu=yes" rel="nofollow" target="_blank">定制求婚</a>
	</div>
</div>
<div class="body">
	<div class="module_t_i">{$data.area}精品案例</div>{if condition="isset($data.list.t1.14)"}
	<div class="pic_i_big">{volist name="$data.list.t1.14" id="vo" offset="0" length='3'}
		<a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com/{$vo.litpic}/thumb1" title="{$vo.title}" /><span>{$vo.title}</span></a>{/volist}
	</div>{/if}
	<div class="module_t_i">服务流程</div>
	<div class="fuwu">
		<dl>
			<dt>录入信息</dt>
			<dd>支付定金</dd>
		</dl>
		<dl>
			<dt>定制方案</dt>
			<dd>浪漫档案</dd>
		</dl>
		<dl>
			<dt>确定方案</dt>
			<dd>支付预付款</dd>
		</dl>
		<dl>
			<dt>浪漫筹备</dt>
			<dd>造梦准备</dd>
		</dl>
		<dl>
			<dt>现场求婚</dt>
			<dd>用心说爱</dd>
		</dl>
	</div>

	<div class="module_t_i">客户评价反馈</div>
	<div class="feedback">
		<ul>{volist name="$data.fakefeedback" id="vo"}
			<li><img src="http://img1.1314theone.com{$vo.litpic}"><span>'{$vo.username}'</span><p>{$vo.body}</p></li>
		{/volist}
		</ul>
	</div>
	
	<div class="pt50t">
		{if condition="isset($data.list.t1.16)"}
		<ul class="grid">
			<h2>{$data.area}求婚策划</h2><em>{$data.areaus} Proposal Plan</em>
			{volist name="$data.list.t1.16" id="vo"}{lt name="$i" value="4"}
			<li><div class="piczy_l"><a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}" /></a></div><div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><p>{$vo.description}</p></div>{/lt}</li>
			{/volist}
		</ul>{/if}
		{if condition="isset($data.list.t1.17)"}
		<ul class="grid gridbg2">
			<h2>{$data.area}求婚创意</h2><em>{$data.areaus} Proposal Declaration</em>
			{volist name="$data.list.t1.17" id="vo"}{lt name="$i" value="4"}
			<li><div class="piczy_l"><a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}" /></a></div><div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><p>{$vo.description}</p></div>{/lt}</li>
			{/volist}
		</ul>{/if}
		{if condition="isset($data.list.t1.18)"}
		<ul class="grid">
			<h2>{$data.area}求婚方式</h2><em>{$data.areaus} Proposal Mode</em>
			{volist name="$data.list.t1.18" id="vo"}{lt name="$i" value="4"}
			<li><div class="piczy_l"><a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}" /></a></div><div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><p>{$vo.description}</p></div>{/lt}</li>
			{/volist}
		</ul>{/if}
		{if condition="isset($data.list.t1.20)"}
		<ul class="grid gridbg2">
			<h2>{$data.area}求婚词</h2><em>{$data.areaus} Proposal Word</em>
			{volist name="$data.list.t1.20" id="vo"}{lt name="$i" value="4"}
			<li><div class="piczy_l"><a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}" /></a></div><div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><p>{$vo.description}</p></div>{/lt}</li>
			{/volist}
		</ul>{/if}
		{if condition="isset($data.list.t1.19)"}
		<ul class="grid">
			<h2>{$data.area}求婚歌曲</h2><em>{$data.areaus} Proposal Song</em>
			{volist name="$data.list.t1.19" id="vo"}{lt name="$i" value="4"}
			<li><div class="piczy_l"><a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}" /></a></div><div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><p>{$vo.description}</p></div>{/lt}</li>
			{/volist}
		</ul>{/if}
		{if condition="isset($data.list.t1.21)"}
		<ul class="grid gridbg2">
			<h2>{$data.area}求婚戒指</h2><em>{$data.areaus} Proposal Ring</em>
			{volist name="$data.list.t1.21" id="vo"}{lt name="$i" value="4"}
			<li><div class="piczy_l"><a href="{$vo.arctype.arcurl}" title="{$vo.title}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}" /></a></div><div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><p>{$vo.description}</p></div>{/lt}</li>
			{/volist}
		</ul>{/if}
		<div class="cl"></div>
	</div>
</div>
{include file="./theme/tot/footer.php"}
</body>
</html>