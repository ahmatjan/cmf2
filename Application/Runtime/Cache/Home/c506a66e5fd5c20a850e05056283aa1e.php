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
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/master.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/zTreeStyle/zTreeStyle.css">
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/demo.css" >
<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/admin/admin.js"></script>

<div id="top" align="center" style="background-color:#ffffff;">
	<img align="center" src="<?php echo ($siteInfo['webFolder']); ?>static/images/top1.jpg" width="100%" height="147" border="0">
</div>

<div id="left" >
	<div class="sidebar">
		<ul>
			<li>
				<div class="title">您好，<?php echo ($userInfo['username']); ?> &nbsp;&nbsp;</div>
				<ul class="menu">
					<li> <a href="<?php echo ($siteInfo['webFolder']); ?>admin/logout">退出登录</a></li>
				</ul>
			</li>
			<li>
				<div class="title">文章管理</div>
				<ul class="menu">
					<li>
						<a href="<?php echo ($siteInfo['webFolder']); ?>admin/article" target="rightFrame">所有文章列表</a>
					</li>
					<li>
						<a href="<?php echo ($siteInfo['webFolder']); ?>admin/article?adder=1&status=3" target="rightFrame">我发布的文章</a>
					</li>
					<?php if($userInfo['type'] > 1): ?><li>
							<a href="<?php echo ($siteInfo['webFolder']); ?>admin/article?status=2" target="rightFrame">待审核的文章</a>
						</li><?php endif; ?>
				</ul>
			</li>
			<li>
				<div class="title">文章栏目</div>
				<ul id="articleTree" class="ztree"></ul>
			</li>
			<br>
			<li>
				<div class="title">栏目管理</div>
				<ul class="menu">
					<li>
						<a href="<?php echo ($siteInfo['webFolder']); ?>admin/folder" target="rightFrame">网站栏目管理</a>
					</li>
				</ul>
			</li>
			<li>
				<div class="title">会员管理</div>
				<ul class="menu">
					<li>
						<a href="<?php echo ($siteInfo['webFolder']); ?>admin/user" target="rightFrame">注册会员列表</a>
					</li>
					<li>
						<a href="<?php echo ($siteInfo['webFolder']); ?>admin/group" target="rightFrame">会员组设置</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="right" class="rightDiv">
	<iframe src="<?php echo ($siteInfo['webFolder']); ?>admin/article" scrolling="none" id="rightFrame" name="rightFrame"></iframe>
</div>

	</body>
</html>