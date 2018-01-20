<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
{empty name="$data.seotitle"}
	{between name="$data.sortrank" value="1,50"}{$data.typename}{/between}
	{between name="$data.sortrank" value="51,100"}{$data.typename}_{$data.typename}策划_{$data.typename}价格_{$data.typename}视频{/between}
{else}$data.seotitle{/empty} - {$cfg.webname}</title>
<meta name="keywords" content="{empty name="$data.keywords"}
	{between name="$data.sortrank" value="1,50"}{$data.typename}{/between}
	{between name="$data.sortrank" value="51,100"}{$data.typename},{$data.typename}策划,{$data.typename}价格,{$data.typename}视频{/between}
{else}$data.keywords{/empty}" />
<meta name="description" content="{empty name="$data.description"}
	{between name="$data.sortrank" value="1,50"}{$data.typename}{/between}
	{between name="$data.sortrank" value="51,100"}{$data.typename}攻略包括,{$data.typename}策划、{$data.typename}价格、{$data.typename}视频、{$data.typename}方案等，更多{$data.typename}多少钱、创意、布置、歌曲等信息尽在TheOne求婚策划公司。{/between}
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
			<ul class="piczy_list">{volist name="$data.list" id="vo"}
				<li>
					<div class="piczy_l"><a hrfe="{$vo.arctype.arcurl}" target="_blank"><img src="http://img1.1314theone.com{$vo.litpic}" title="{$vo.title}"></a></div>
					<div class="piczy_r"><a href="{$vo.arctype.arcurl}" target="_blank">{$vo.title}</a><span>时间：{$vo.pubdate} 浏览：{$vo.click}</span><p>{$vo.description}...</p></p></div>
				</li>{/volist}
			</ul>
		</div>
		<div><ul class="pages">{$data.page}</ul></div>
	</div>
	<div class="body_r">
		<div class="pt015">
			<span class="module_t_c bbn">相关栏目</span>
			<ul class="related_colums">
				{dede:type}
					[field:id runphp="yes"]
						global $dsql;
						$reid = $dsql->GetOne("SELECT reid,sortrank FROM dede_arctype WHERE id LIKE '%@me%' ");
						if($reid['sortrank'] < 50){
							$where = "sortrank < 50";
						}
						if($reid['sortrank'] > 50 AND $reid['sortrank'] < 100){
							$where = "sortrank > 50 AND sortrank < 100";
						}
						if($reid['sortrank'] > 100 AND $reid['sortrank'] < 150){
							$where = "sortrank > 100 AND sortrank < 150";
						}
						if($reid['sortrank'] > 900){
							$where = "sortrank < 50";
						}
						if($reid['reid'] != 0){
							$dsql->Execute('mbidss',"SELECT id FROM dede_arctype WHERE reid LIKE '%$reid[reid]%' AND id NOT IN(27) AND $where");
						}else{
							$dsql->Execute('mbidss',"SELECT id FROM dede_arctype WHERE reid LIKE '%@me%' AND id NOT IN(27) AND $where");
						}
						while ($mbid = $dsql->GetArray('mbidss')) {
        					$mbids .= $mbid['id'] . ',';
        				}
        				$mbidsnew = substr($mbids,0,strlen($mbdis)-1);
        				if ($mbids !='') {
        					$sql = "SELECT typename,typedir FROM dede_arctype WHERE id IN ($mbidsnew) ORDER BY sortrank ASC";
							$dsql->Execute('me', $sql);
							while ($row = $dsql->GetArray('me')) {
								$s .= '<li><a href="' . str_replace('{cmspath}','',$row['typedir']) . '/">' . $row['typename'] . '</a></li>';
        					}
        				}
        				@me = $s;
					[/field:id]
				{/dede:type}
				<div class="cl"></div>
			</ul>
		</div>
		<div class="pt015">
			<span class="module_t_c">推荐套餐</span>
			<ul class="piczy_price">{dede:arclist limit='0,8' channelid='6' addfields='trueprice,truepricemax' typeid='22'}
				<li><div class="piczy_p_l"><a href="[field:arcurl/]"><img src="http://img1.1314theone.com[field:litpic/]" title="[field:title/]"></a></div><div class="piczy_p_r"><a href="">[field:title/]</a><p>¥[field:trueprice/][field:truepricemax runphp="yes"]if(empty(@me)){@me="";}else{@me=" - ".@me;}[/field:truepricemax]</p></div></li>
				{/dede:arclist}
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
{dede:include filename="footer.htm"/}
</body>
</html>