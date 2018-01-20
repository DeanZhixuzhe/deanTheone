<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
{include file="./theme/tot/meta_m.php"}
</head>
<body>
<div id="header">
    <a class="return" href="javascript:if(document.referrer.indexOf('1314theone')>=0){history.go(-1);}else{window.location='/';}"><i class="am-icon-angle-left"></i></a>
    <h1>{$data.typename}</h1>
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

<div id="trip_list">
    <div class="hei30"></div>
    <ul>{volist name="$data.list" id="vo"}
        <li class="view">
            <a href="{$vo.arctype.arcurl}">
                <div class="pic">
                    <img src="http://img1.1314theone.com{$vo.litpic}">
                    <div class="clear"></div>
                </div>
                <div class="con">
                    <h5>{$vo.title}</h5>
                    <p>{$vo.description}...</p>
                </div>
            </a>
        </li>{/volist}
    </ul>
    <ul class="pagina">{$data.page}</ul>
</div>
{include file="./theme/tot/footer_m.php"}
</body>
</html>