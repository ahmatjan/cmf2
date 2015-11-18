<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo ($siteInfo['title']); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/style.css" />
<?php if(isset($cssFiles)): if(is_array($cssFiles)): $i = 0; $__LIST__ = $cssFiles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/<?php echo ($file); ?>" /><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/init.js"></script>
<?php if(isset($jsFiles)): if(is_array($jsFiles)): $i = 0; $__LIST__ = $jsFiles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/<?php echo ($file); ?>"></script><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</head>
	<body>
<div id="left">
<div>
您好，<?php echo ($userInfo['nick']); ?> <a href="<?php echo ($siteInfo['webFolder']); ?>user/logout">退出登录</a>
<ul>
	<li>
		<a href="javascript:void(0);">文章管理</a>
		<ul>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/article" target="rightFrame">所有文章列表</a>
			</li>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/article?adder=1" target="rightFrame">我发布的文章</a>
			</li>
			<?php if($userInfo['type'] > 1): ?><li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/article?status=1" target="rightFrame">待审核的文章</a>
			</li><?php endif; ?>
		</ul>
		<?php echo ($treeStr); ?>
	</li>
	<li>
		<a href="javascript:void(0);">栏目管理</a>
		<ul>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/folder" target="rightFrame">网站栏目管理</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="javascript:void(0);">会员管理</a>
		<ul>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/user" target="rightFrame">注册会员列表</a>
			</li>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/group" target="rightFrame">会员组设置</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="javascript:void(0);">系统管理</a>
		<ul>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/type" target="rightFrame">管理员组管理</a>
			</li>
			<li>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/admin" target="rightFrame">系统用户管理</a>
			</li>
		</ul>
	</li>
</ul>
</div>	
</div>
<div id="right">
	<iframe src="<?php echo ($siteInfo['webFolder']); ?>admin/article" scrolling="none" id="rightFrame" name="rightFrame"></iframe>
</div>

	</body>
</html>