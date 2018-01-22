<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>TheOne求婚策划_浪漫求婚_快闪求婚_电影院求婚 - {$cfg.webname}</title>
<meta name="keywords" content="求婚策划,浪漫求婚,求婚策划公司,快闪求婚,电影院求婚" />
<meta name="description" content="TheOne求婚策划公司为您提供专业的求婚策划服务，专注于浪漫求婚、快闪求婚、电影院求婚、餐厅咖啡厅求婚等多种求婚方式，还有求婚策划价格咨询、求婚策划地点推荐等专业服务。" />
{include file="./theme/tot/meta_m.php"}
</head>
<body>
<div id="index">
    <!--首页头部-->
    <div class="index_head">
		<div class="logo">
			<a href="http:/m.1314theone.com/"><img src="__STATIC__/{$Think.config.website.view_style}/images/Logo_0101.png"></a>
		</div>
        <div class="nav">
            <div class="tit">导航 <span class="am-icon-caret-down"></span></div>
            <div class="con">
                <ul class="am-avg-sm-3">
                    <li><a href="/">首页</a></li>
                    <li><a href="/mall/">浪漫套餐</a></li>
                    <li><a href="/proposal/case/">浪漫案例</a></li>
                    <li><a href="/proposal/">求婚攻略</a></li>
                    <li><a href="/proposal/plan/">求婚策划</a></li>
                    <li><a href="/proposal/originality/">求婚创意</a></li>
                    <li><a href="/proposal/mode/">求婚方式</a></li>
                    <li><a href="/proposal/song/">求婚歌曲</a></li>
                    <li><a href="/proposal/ring/">求婚戒指</a></li>
                    <li><a href="/proposal/word/">求婚词</a></li>
                    <li><a href="/proposal/kuaishan/">快闪求婚</a></li>
                    <li><a href="/proposal/dianyingyuan/">电影院求婚</a></li>
                    <li><a href="/proposal/ktv/">KTV求婚</a></li>
                    <li><a href="/proposal/kafeiting/">咖啡厅求婚</a></li>
                    <li><a href="/proposal/canting/">餐厅求婚</a></li>
                </ul>
            </div>
            <div class="head_mask"></div>
        </div>
    </div>
    <!--轮播banner-->
    <div class="banner">
        <!-- <embed src="/upload/video/TheOne01.mp4" loop="true" autostart="true" controls="console"></embed> -->
        <video autoplay="true" poster="/upload/image/TheOne01.mp4_20180122_154722.843.jpg" loop="true" preload="metadata"><source src="http://img1.1314theone.com/TheOne01.mp4" type="video/mp4"></video>
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
	<div>
           
    </div>
    <!-- <div id="trip_list">{literal}
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
                        <a href="{$vo.arctype.arcurl}">
    						<div class="pic">
    							<img src="http://img1.1314theone.com{$vo.litpic}">
    							<div class="cont">
    								<span class="button xq">¥[field:trueprice/]起</span>
    							</div>
    							<div class="clear"></div>
    						</div>
    						<div class="con">
    							<h5>{$vo.title}</h5>
    							<p></p>
    						</div>
                        </a>
					</li>
                {/lt}{/volist}
				</ul>
				<ul class="am-tab-panel am-fade" id="tab2">
				{dede:arclist typeid='22' row='4' titlelen='60' addfields='truepricemax,trueprice' channelid='6' keyword='实惠'}
                    <li class="view">
                        <a href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}">
                                <div class="cont">
                                    <span class="button xq">¥[field:trueprice/]起</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="con">
                                <h5>{$vo.title}</h5>
                                <p></p>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}
				</ul>
                <ul class="am-tab-panel am-fade" id="tab3">
                {dede:arclist typeid='22' row='4' titlelen='60' addfields='truepricemax,trueprice' channelid='6' keyword='高端'}
                    <li class="view">
                        <a href="{$vo.arctype.arcurl}">
                            <div class="pic">
                                <img src="http://img1.1314theone.com{$vo.litpic}">
                                <div class="cont">
                                    <span class="button xq">¥[field:trueprice/]起</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="con">
                                <h5>{$vo.title}</h5>
                                <p></p>
                            </div>
                        </a>
                    </li>
                {/lt}{/volist}
                </ul>
			</div>
		</div>{/literal}
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
                {/lt}{/volist}
                    <div id="more">
                        <a href="/proposal/plan/">
                            <span>更多求婚策划</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl2" class="am-tab-panel am-fade">
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
                {/lt}{/volist}
                    <div id="more">
                        <a href="/proposal/kuaishan/">
                            <span>更多快闪求婚</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl3" class="am-tab-panel am-fade">
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
                {/lt}{/volist}
                    <div id="more">
                        <a href="/proposal/dianyingyuan/">
                            <span>更多电影院求婚</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl4" class="am-tab-panel am-fade">
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
                {/lt}{/volist}
                    <div id="more">
                        <a href="/proposal/originality/">
                            <span>更多求婚创意</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl5" class="am-tab-panel am-fade">
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
                {/lt}{/volist}
                    <div id="more">
                        <a href="/proposal/mode/">
                            <span>更多求婚方式</span>
                            <i class="am-icon-angle-right"></i>
                        </a>
                    </div>
                </ul>
                <ul id="gl6" class="am-tab-panel am-fade">
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
                {/lt}{/volist}
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
        $('.index_head .tit').click(function(e){
            if ($('.index_head .con').hasClass('conshow')) {
                $('.index_head .con').removeClass('conshow');
                $('.head_mask').css('display','none');
            }else {
                $('.index_head .con').addClass('conshow');
                $('.head_mask').css('display','block');
            }
            e.stopPropagation();
        });
        $('.index_head .con').click(function(e){
            e.stopPropagation();
        });
        $('.head_mask').click(function(e){
            $('.index_head .con').removeClass('conshow');
            $('.head_mask').css('display','none');
        });
        
    });
</script>
</body>
</html>
