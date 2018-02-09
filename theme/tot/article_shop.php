<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$data.title} - {$cfg.webname}</title>
<meta name="keywords" content="{$data.keywords}" />
<meta name="description" content="{$data.description}" />
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"}
<div class="body">
	<div class="breadcrumb"><a href="/">首页</a> > {$data.position}</div>
	<div class="as_head">
	<form action="{:url('index/Cashier/index')}" class="payform" method="get" target="_blank" name="payment" id="payment">
		<div class="le"><img src="http://img1.1314theone.com{$data.litpic}"></div>
		<div class="ri">
			<h1>{$data.title}</h1>
			<p class="price">¥{$data.addon.trueprice}起</p>
			<p class="title">适合场景：</p>
			<p>{$data.addon.defined3}</p>
			<p class="title">开通地区：</p>
			<p>全国各大省份地区（包含港澳台）、日韩、东南亚、欧美</p>
			
			{notempty name="$data.addon.defined1"}
				<p class="title">优惠活动：</p>
				<p>{$data.addon.defined1}</p>
				<input type="hidden" name="discounts" value="{$data.addon.defined1}">
			{/notempty}
			<div class="btn">
				<input type="hidden" name="title" value="{$data.title}">
				<input type="hidden" name="litpic" value="{$data.litpic}">
				<input type="hidden" name="trueprice" value="{$data.addon.trueprice}">
				{elt name="$data.addon.trueprice" value="3000"}
				<input type="submit" class="nowpay" value ="立即购买">
				{else}
				<a href="tencent://message/?uin=3547038718&Site=qq&Menu=yes" rel="nofollow">立即预定</a>
				<a href="tencent://message/?uin=3547038718&Site=qq&Menu=yes" rel="nofollow">在线咨询</a>
				{/elt}
			</div>
		</div>
	</form>
	</div>
	<div class="blank20"></div>
	<div class="i-steps">
		<div class="one">服务流程</div>
		<div class="two">
			<dl>
				<dt>1</dt>
				<dd><p>初步确定</p><p>浪漫框架</p></dd>
			</dl>
			<dl>
				<dt>2</dt>
				<dd><p>下单预定</p><p>支付定金</p></dd>
			</dl>
			<dl>
				<dt>3</dt>
				<dd><p>填写</p><p>浪漫档案表</p></dd>
			</dl>
			<dl>
				<dt>4</dt>
				<dd><p>拟定详细</p><p>策划方案</p></dd>
			</dl>
			<dl>
				<dt>5</dt>
				<dd><p>确认方案</p><p>付预付款</p></dd>
			</dl>
			<dl>
				<dt>6</dt>
				<dd><p>统筹协调</p><p>准备浪漫</p></dd>
			</dl>
			<dl>
				<dt>7</dt>
				<dd><p>现场彩排</p><p>支付尾款</p></dd>
			</dl>
			<dl>
				<dt>8</dt>
				<dd><p>享受</p><p>浪漫求婚</p></dd>
			</dl>
		</div>
	</div>
	<div class="blank20"></div>
	<div class="body_l">
		<div class="as_nav">
			<ul>
				<li class="active">套餐介绍</li>
				<li>套餐明细</li>
				<li>人员服务</li>
				<li>疑问解答</li>
				<li>客户评价</li>
			</ul>
		</div>
		<div class="as_content">
			<div class="as_title"><span>主题诠释</span></div>
			<div class="as_con">{$data.addon.defined1}</div>
			<div class="as_title"><span>场景布置</span></div>
			<div class="as_con">{$data.addon.body}</div>
			{notempty name="$data.addon.defined4"}
				<div class="as_title"><span>服务明细</span></div><div class="as_detailed"><dl class="header"><dt>服务项目</dt><dd>服务介绍</dd></dl>{$data.addon.defined4}</div>
			{/notempty}
			
			<div class="as_title"><span>人员 AND 服务</span></div>
			<div class="as_per">
				<dl>
					<dt><img src="__STATIC__/tot/images/zyry3.png"></dt>
					<dd class="title">专业浪漫策划师</dd>
					<dd>专业浪漫策划师根据男女主角的爱情故事定制独一无二，专属的浪漫惊喜方案。精心定制个性化浪漫惊喜流程及细节，一对一提供相关服务咨询及建议。</dd>
				</dl>
				<dl>
					<dt><img src="__STATIC__/tot/images/zyry4.png"></dt>
					<dd class="title">专业浪漫统筹师</dd>
					<dd>专业浪漫统筹师负责浪漫惊喜活动前的彩排工作，提供浪漫惊喜现场的管家式服务，营造浪漫惊喜氛围。她不是主持，却胜似主持。通过她的服务让你们尽情享受浪漫和祝福！</dd>
				</dl>
				<dl>
					<dt><img src="__STATIC__/tot/images/zyry1.png"></dt>
					<dd class="title">专业浪漫督导</dd>
					<dd>为您提供现场指导意见，统筹协调音乐、灯光、道具、人员等；把控浪漫惊喜活动的各个环节，从大场景到小细节都不马虎；其他活动现场各种突发情况的灵活处理，维持浪漫活动现场秩序，保障活动的顺畅完美进行。</dd>
				</dl>
				<dl>
					<dt><img src="__STATIC__/tot/images/zyry2.png"></dt>
					<dd class="title">专业AE执行人员</dd>
					<dd>负责浪漫惊喜前场地的测量、考察、协调；根据浪漫现场实际情况做出个性化和专业化安排；物料的前期采购，个性化物品的制作设计及现场搬运，浪漫场景搭建，求婚后现场拆场等工作，做好活动的后勤保障工作。</dd>
				</dl>
			</div>
			<div class="as_title"><span>惊喜流程设计</span></div>
			<div class="as_process">
				<dl>
					<dt><img src="__STATIC__/tot/images/type_nav.png"></dt>
					<dd>
						<span>「引导式方案」</span>
						<p>如果你的Ta是一个简单纯真、谨慎小心的人，那我们向您推荐浪漫的引导式方案。此方案注重的是：在活动环节中，对Ta领略惊喜的过程展开浪漫而又神秘的引导。跟着我们设计的节奏，一定会让Ta最大限度地享受浪漫和惊喜！</p>
					</dd>
				</dl>
				<dl>
					<dd>
						<span>「线索式方案」</span>
						<p>如果你的Ta特别聪明，敏感而富有“侦探”头脑，你的一举一动老是逃不过Ta的“法眼”，那么最适合你们的应该就是线索式惊喜方案了。带有一点烧脑环节的流程，让Ta全程参与并享受着你为Ta准备的浪漫，才是最有意义的惊喜！</p>
					</dd>
					<dt class="r"><img src="__STATIC__/tot/images/type_tip.png"></dt>
				</dl>
				<dl>
					<dt><img src="__STATIC__/tot/images/type_surprise.png"></dt>
					<dd>
						<span>「惊喜式方案」</span>
						<p>如果你的Ta喜欢歪国人的创意、期待不按照常理出牌的浪漫惊喜，那么你一定要为Ta准备一场惊喜式的活动方案。所有Ta无法想象的剧情，我们为你做出了完美的搭配与组合，绝对的surprise！</p>
					</dd>
				</dl>
			</div>
			<div class="as_title"><span>疑问解答</span></div>
			<div class="as_title"><span>客户评价</span></div>
			<div class="shoppl">
          		<ul>{volist name="$data.fakecomment" id="vo"}
          			<li><div class="pltx"><img src="http://img1.1314theone.com{$vo.litpic}"><p>{$vo.title}</p></div><div class="plxq"><span><img src="/images/shop/star.png"><em>策划：好</em><em>创意：好</em><em>布置：好</em><em>服务：好</em><em>拍摄：好</em></span>{$vo.body}</div></li>{/volist}
          		</ul>
        	</div>
		</div>
	</div>
	<div class="body_r">
		<div class="pt015">
			<span class="module_t_c">推荐套餐</span>
			<ul class="piczy_price">{volist name="$data.mallList" id="vo" offset="0" length="4"}
				<li><div class="piczy_p_l"><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></div><div class="piczy_p_r"><a href="{$vo.arctype.arcurl}" target="_blank" rel="nofollow">{$vo.title}</a><p>￥{$vo.shop.trueprice}</p></div></li>{/volist}
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
{include file="./theme/tot/footer.php"}
</body>
</html>