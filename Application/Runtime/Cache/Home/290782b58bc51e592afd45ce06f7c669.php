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
		<br>
		<label for="username">用户登录名</label>
		<input type="text" id="username" name="username" value="" /><br />

		<label for="password">用户密码</label>
		<input type="password" id="password" name="password" /><br />

		<label for="confirm">确认密码</label>
		<input type="password" id="confirm" name="confirm" /><br />

		<label for="sex">性别</label>
		<select id="sex" name="sex">
			<option value="男" selected>男</option>
			<option value="女">女</option>
		</select>

		<br/>

		<label for="company">工作单位</label>
		<input type="text" id="company" name="company" value="" /><br />

		<label for="department">部门</label>
		<input type="text" id="department" name="department" value="" /><br />

		<label for="job">职务</label>
		<input type="text" id="job" name="job" value="" /><br />

		<label for="email">邮箱</label>
		<input type="text" id="email" name="email" value="" /><br />

		<label for="contact">联系方式</label>
		<input type="text" id="contact" name="contact" value="" /><br />

		<label for="truename">真实姓名</label>
		<input type="text" id="truename" name="truename" value="" /><br />

		<label for="type">会员级别</label>
		<select id="type" name="type">
			<?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type['id']); ?>"><?php echo ($type['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select><br />

		<label for="group">所属会员组</label>
		<select id="group" name="group" multiple="multiple">
			<?php if(is_array($groups)): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($group['id']); ?>"><?php echo ($group['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select><br />



		<input type="hidden" id="id" name="id" value="" />
		<input type="button" class="button" id="addSub" value="确定" />

	</div>
	</body>
</html>