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
	<div class="rightDiv">
		<label for="nick">昵称</label>
		<input type="text" id="nick" name="nick" value="<?php echo ($info['nick']); ?>" /><br />
		<label for="truename">真实姓名</label>
		<input type="text" id="truename" name="truename" value="<?php echo ($info['truename']); ?>" /><br />
		<label for="password">修改密码</label>
		<input type="password" id="password" name="password" />（如果不修改密码，请将此空留空）<br />
		<label for="confirm">确认密码</label>
		<input type="password" id="confirm" name="confirm" /><br />
		<label for="type">会员级别</label>
		<select id="type" name="type">
		<?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type['id']); ?>" <?php if($type['id'] == $info['type']): ?>selected<?php endif; ?>><?php echo ($type['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select><br />
		<label for="group">所属会员组</label>
		<select id="group" name="group" multiple="multiple">
		<?php if(is_array($groups)): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($group['id']); ?>" <?php if(in_array($group['id'], $info['groups'])) echo ' selected';?>><?php echo ($group['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select><br />
		<input type="hidden" id="id" name="id" value="<?php echo ($info['id']); ?>" />
		<input type="button" class="button" id="addSub" value="确定" />
		<div id="oldGroup">
		<?php if(is_array($info['group'])): $i = 0; $__LIST__ = $info['group'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($vo['id']); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	</body>
</html>