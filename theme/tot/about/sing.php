<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$data.title} - {cfg.webname}</title>
<meta name="keywords" content="{cfg.keywords}" />
<meta name="description" content="{cfg.description}" />
{include file="./theme/tot/meta.php"}
</head>
<body>
{include file="./theme/tot/header.php"}
<div class="body">
{include file="./theme/tot/about/about_left.php"}
    <!--右侧开始-->
    <div class="right_mian">
		<div class="title_page"><h1>{$data.title}</h1></div>
		<div class="about_con">
			{$data.body}
		</div>
    </div><!--右侧结束-->
</div>
<div class="cl"></div>
{include file="./theme/tot/footer.php"}
</body>
</html>
