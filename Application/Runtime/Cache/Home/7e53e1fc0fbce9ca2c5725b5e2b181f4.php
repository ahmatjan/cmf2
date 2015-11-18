<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo ($siteInfo['title']); ?></title>
		<link rel="stylesheet" type="text/css" href="/tour/static/css/style.css" />
<?php if(isset($cssFiles)): if(is_array($cssFiles)): $i = 0; $__LIST__ = $cssFiles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><link rel="stylesheet" type="text/css" href="/tour/static/css/<?php echo ($file); ?>" /><?php endforeach; endif; else: echo "" ;endif; endif; ?>
		<script type="text/javascript" src="/tour/static/js/jquery.min.js"></script>
		<script type="text/javascript" src="/tour/static/js/init.js"></script>
<?php if(isset($jsFiles)): if(is_array($jsFiles)): $i = 0; $__LIST__ = $jsFiles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$file): $mod = ($i % 2 );++$i;?><script type="text/javascript" src="/tour/static/js/<?php echo ($file); ?>"></script><?php endforeach; endif; else: echo "" ;endif; endif; ?>
	</head>
	<body>
<label for="smscontent">短信内容：</label><input type="text" id="smscontent" name="smscontent" /><br />
<label>手机号码</label>
<ul id="users">
<?php if(is_array($emails)): $i = 0; $__LIST__ = $emails;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$email): $mod = ($i % 2 );++$i;?><li>
<?php echo ($email['f_3']); ?>(<?php echo ($email['name']); ?>)
<input class="deluser" type="button" value="删除">
</li><?php endforeach; endif; else: echo "" ;endif; ?>
<li>
<select id="pusers">
<?php if(is_array($students)): $i = 0; $__LIST__ = $students;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$student): $mod = ($i % 2 );++$i;?><option><?php echo ($student['f_3']); ?>(<?php echo ($student['name']); ?>)</option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<input type="button" id="adduser" value="添加" />
</li>
</ul>
<div class="buttons">
	<a id="smsSub" href='javascript:void(0);'>发送</a>
</div>
	</body>
</html>