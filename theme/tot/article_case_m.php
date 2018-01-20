<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{$data.title} - {$cfg.webname}</title>
<meta name="keywords" content="{$data.keywords}" />
<meta name="description" content="{$data.description}" />
{include file="./theme/tot/meta_m.php"}
</head>
<body>
<div id="header_s">
    <div class="logo">
        <a href="{$Request.domain}/"><img src="__STATIC__/{$Think.config.template.style}/images/Logo_0101.png"></a>
    </div>
    <span>案例详情</span>
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
<div id="news_detail">
    <div class="cover" style="background-image: url(http://img1.1314theone.com{$data.litpic});">
        <div class="return" data-am-sticky="{top:5}">
            <a class="" href="javascript:if(document.referrer.indexOf('1314theone')>=0){history.go(-1);}else{window.location='/';}"><i class="am-icon-angle-left"></i></a>
        </div>
        <div class="title">
            <h1>{$data.title}</h1>
            <span>{$data.pubdate}</span>
            <div class="clear"></div>
        </div>
        <div class="read">
            <img class="eye " src="__STATIC__/{$Think.config.template.style}/m/images/read.png">
            <span>{$data.click}</span>
        </div>
    </div>
    <div class="content">
        {$data.body}
    </div>
</div>
{include file="./theme/tot/footer_m.php"}
</body>
</html>