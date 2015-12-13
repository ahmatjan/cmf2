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
	<?php if($userInfo['userid'] AND $userInfo['type']): ?><div id="userpanel">
			欢迎您，<?php echo ($userInfo['truename']); ?><br />
			<a href="<?php echo ($webFolder); ?>member/modify" target="rightFrame">修改信息</a>
			<a href="<?php echo ($webFolder); ?>member/logout">退出登录</a>
		</div>
	<?php else: ?>
		<form id="logForm" name="logForm">
			<label for="username">用户名:</label>
			<input type="text" id="username" name="username" /><br />
			<label for="password">密码:</label>
			<input type="password" id="password" name="password" /><br />
			<label for="vcode">验证码:</label>
			<input type="text" class="short" id="vcode" name="vcode" />
			<img id="imgCode" src="<?php echo ($siteInfo['webFolder']); ?>code" /><br />
			<input type="button" id="logSub" class="button" name="logSub" value="提交" />
		</form><?php endif; ?>
	</body>
</html>