<!DOCTYPE html>
<html>
<head>
<title>{$data.typename}策划_{$data.typename}公司_{$data.typename}策划价格_{$data.typename}地点 - TheOne求婚策划公司</title>
<meta name="keywords" content="{empty name="$data.keywords"}{$data.typename},{$data.typename}策划,{$data.typename}公司,{$data.typename}策划价格，{$data.typename}地点
{else}{$data.keywords}{/empty}" />
<meta name="description" content="{empty name="$data.description"}TheOne求婚策划公司重庆分公司为您提供{$data.typename}服务、{$data.typename}策划方案、{$data.typename}策划价格咨询、{$data.typename}地点推荐等服务，了解更多{$data.typename}策划多少钱及费用相关信息尽在TheOne求婚策划。
{else}{$data.description}{/empty}" />
{include file="./theme/tot/meta_m.php"}
</head>

<body>
<div id="index">
    <!--首页头部-->
    <div class="index_head">
		<div class="logo">
			<a href="/"><img src="__STATIC__/{$Think.config.website.view_style}/images/logo_0101.png"></a>
		</div>
		<!--搜索-->
		<a class="phone">
			<img src="__STATIC__/{$Think.config.website.view_style}/m/images/phone.png">
		</a>
        <!-- <div class="nav">导航</div> -->
    </div>
    <!--轮播banner-->
    <div id="index_banner">
        <div data-am-widget="slider" class="am-slider am-slider-default">
            <ul class="am-slides">
                <li><img src="__STATIC__/{$Think.config.website.view_style}/images/c1200.jpg"/></li>
                <!-- <li><a title="" href="activity_detail.html"><img src="__STATIC__/{$Think.config.website.view_style}m/images/banner4.jpg"/></a></li>
                <li><a title="" href="activity_detail.html"><img src="__STATIC__/{$Think.config.website.view_style}m/images/banner3.jpg"/></a></li>
                <li><a title="" href="activity_detail.html"><img src="__STATIC__/{$Think.config.website.view_style}m/images/banner.jpg"/></a></li> -->
            </ul>
        </div>
    </div>
    <!--栏目-->
    <div class="order_nav">
        <ul class="box_nav am-avg-sm-3">
            <li>
                <a href="/mall/" rel="nofollow">
                    <img src="__STATIC__/{$Think.config.website.view_style}/m/images/index_icon01.png"/>
                    <p>浪漫套餐</p>
                </a>
            </li>
            <li>
                <a href="/proposal/case/" rel="nofollow">
                    <img src="__STATIC__/{$Think.config.website.view_style}/m/images/index_icon02.png"/>
                    <p>成功案例</p>
                </a>
            </li>
            <li>
                <a href="/proposal/">
                    <img src="__STATIC__/{$Think.config.website.view_style}/m/images/index_icon03.png"/>
                    <p>求婚攻略</p>
                </a>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
	
	<!-- <div id="trip_list" style="width:100%;overflow:hidden;"> -->
    <!-- <div id="trip_list">
		<div class="am-tabs" data-am-tabs>
			<ul class="am-tabs-nav am-nav am-nav-tabs am-avg-sm-3">
				<li class="am-active"><a href="#tab1">热门套餐</a></li>
				<li><a href="#tab2">经济实惠</a></li>
                <li><a href="#tab3">专属浪漫</a></li>
			</ul>
			<div class="am-tabs-bd">
				<ul class="am-tab-panel am-fade am-in am-active" id="tab1">
                {dede:arclist typeid='22' row='4' titlelen='60' addfields='truepricemax,trueprice' channelid='6' keyword='热门'}
					<li class="view">
                        <a href="/[field:arcurl/]">
    						<div class="pic">
    							<img src="[field:litpic/]">
    							<div class="cont">
    								<span class="button xq">¥[field:trueprice/]起</span>
    							</div>
    							<div class="clear"></div>
    						</div>
    						<div class="con">
    							<h5>[field:title/]</h5>
    							<p>卫坡古民居翠湾果岭观唐生态园炎帝本草园洛阳粤钰青...</p>
    						</div>
                        </a>
					</li>
                {/dede:arclist}
				</ul>
				<ul class="am-tab-panel am-fade" id="tab2">
				{dede:arclist typeid='22' row='4' titlelen='60' addfields='truepricemax,trueprice' channelid='6' keyword='实惠'}
                    <li class="view">
                        <a href="/[field:arcurl/]">
                            <div class="pic">
                                <img src="[field:litpic/]">
                                <div class="cont">
                                    <span class="button xq">¥[field:trueprice/]起</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="con">
                                <h5>[field:title/]</h5>
                                <p>卫坡古民居翠湾果岭观唐生态园炎帝本草园洛阳粤钰青...</p>
                            </div>
                        </a>
                    </li>
                {/dede:arclist}
				</ul>
                <ul class="am-tab-panel am-fade" id="tab3">
                {dede:arclist typeid='22' row='4' titlelen='60' addfields='truepricemax,trueprice' channelid='6' keyword='高端'}
                    <li class="view">
                        <a href="/m[field:arcurl/]">
                            <div class="pic">
                                <img src="[field:litpic/]">
                                <div class="cont">
                                    <span class="button xq">¥[field:trueprice/]起</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="con">
                                <h5>[field:title/]</h5>
                                <p>卫坡古民居翠湾果岭观唐生态园炎帝本草园洛阳粤钰青...</p>
                            </div>
                        </a>
                    </li>
                {/dede:arclist}
                </ul>
			</div>
		</div>
	</div> -->
   
    <!--新闻资讯-->
    <div id="news_list">
        <div id="item_name">
            <img src="__STATIC__/{$Think.config.website.view_style}/m/images/index_icon08.png">
            <span>求婚攻略</span>
        </div>
        <div class="am-tabs" data-am-tabs>
            <ul class="am-tabs-nav am-nav am-nav-tabs am-avg-sm-3">
                <li class="am-active"><a href="#gl1">求婚策划</a></li>
                <li><a href="#gl2">快闪求婚</a></li>
                <li><a href="#gl3">电影院求婚</a></li>
                <li><a href="#gl4">求婚创意</a></li>
                <li><a href="#gl5">求婚方式</a></li>
                <li><a href="#gl6">求婚歌曲</a></li>
            </ul>
            <div class="am-tabs-bd">
                <ul id="gl1" class="am-tab-panel am-fade am-in am-active">
                {if condition="isset($data.list.t1.16)"}
                {volist name="$data.list.t1.16" id="vo"}{lt name="$i" value="6"}
                    <li>
                        <a class="news" href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}"/>
                            </div>
                            <div class="project_cont">
                                <h5>{$vo.title}</h5>
                            </div>
                            <div class="price">
                                <p>{$vo.pubdate}</p>
                                <span>{$vo.click}</span>
                                <i class="am-icon-eye"></i>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}{/if}
                    <div id="more">
                        <a href="/proposal/plan/">
                            <span>更多求婚策划</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl2" class="am-tab-panel am-fade">{if condition="isset($data.list.t1.40)"}
                {volist name="$data.list.t1.40" id="vo"}{lt name="$i" value="6"}
                    <li>
                        <a class="news" href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}"/>
                            </div>
                            <div class="project_cont">
                                <h5>{$vo.title}</h5>
                            </div>
                            <div class="price">
                                <p>{$vo.pubdate}</p>
                                <span>{$vo.click}</span>
                                <i class="am-icon-eye"></i>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}{/if}
                    <div id="more">
                        <a href="/proposal/kuaishan/">
                            <span>更多快闪求婚</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl3" class="am-tab-panel am-fade">{if condition="isset($data.list.t1.26)"}
                {volist name="$data.list.t1.26" id="vo"}{lt name="$i" value="6"}
                    <li>
                        <a class="news" href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}"/>
                            </div>
                            <div class="project_cont">
                                <h5>{$vo.title}</h5>
                            </div>
                            <div class="price">
                                <p>{$vo.pubdate}</p>
                                <span>{$vo.click}</span>
                                <i class="am-icon-eye"></i>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}{/if}
                    <div id="more">
                        <a href="/proposal/dianyingyuan/">
                            <span>更多电影院求婚</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl4" class="am-tab-panel am-fade">{if condition="isset($data.list.t1.17)"}
                {volist name="$data.list.t1.17" id="vo"}{lt name="$i" value="6"}
                    <li>
                        <a class="news" href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}"/>
                            </div>
                            <div class="project_cont">
                                <h5>{$vo.title}</h5>
                            </div>
                            <div class="price">
                                <p>{$vo.pubdate}</p>
                                <span>{$vo.click}</span>
                                <i class="am-icon-eye"></i>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}{/if}
                    <div id="more">
                        <a href="/proposal/originality/">
                            <span>更多求婚创意</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl5" class="am-tab-panel am-fade">{if condition="isset($data.list.t1.18)"}
                {volist name="$data.list.t1.18" id="vo"}{lt name="$i" value="6"}
                    <li>
                        <a class="news" href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}"/>
                            </div>
                            <div class="project_cont">
                                <h5>{$vo.title}</h5>
                            </div>
                            <div class="price">
                                <p>{$vo.pubdate}</p>
                                <span>{$vo.click}</span>
                                <i class="am-icon-eye"></i>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}{/if}
                    <div id="more">
                        <a href="/proposal/mode/">
                            <span>更多求婚方式</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl6" class="am-tab-panel am-fade">{if condition="isset($data.list.t1.19)"}
                {volist name="$data.list.t1.19" id="vo"}{lt name="$i" value="6"}
                    <li>
                        <a class="news" href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}"/>
                            </div>
                            <div class="project_cont">
                                <h5>{$vo.title}</h5>
                            </div>
                            <div class="price">
                                <p>{$vo.pubdate}</p>
                                <span>{$vo.click}</span>
                                <i class="am-icon-eye"></i>
                                <div class="clear"></div>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}{/if}
                    <div id="more">
                        <a href="/proposal/song/">
                            <span>更多求婚歌曲</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
{include file="./theme/tot/footer_m.php"}
<script>
    $(function () {
        $('.am-slider').flexslider({
            controlNav: true,               // Boolean: 是否创建控制点
            directionNav: false,             // Boolean: 是否创建上/下一个按钮（previous/next）
            touch: true,                    // Boolean: 允许触摸屏触摸滑动滑块
        });
    });
</script>
</body>
</html>