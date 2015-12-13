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
<link href="<?php echo ($siteInfo['webFolder']); ?>static/css/front.css" rel="stylesheet">
	<div class="rightDiv">
		<div class="title">
			<a href="<?php echo ($siteInfo['webFolder']); ?>admin/userAdd">增加新用户</a>
		</div>
		<table>
			<tr>
				<th>用户名</th>
				<th>性别</th>
				<th>工作单位</th>
				<th>部门</th>
				<th>职务</th>
				<th>邮箱</th>
				<th>联系方式</th>
				<th>真实姓名</th>
				<th>级别</th>
				<th>所属会员组</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td>&nbsp;<?php echo ($vo['username']); ?></td>
				<td>&nbsp;<?php echo ($vo['sex']); ?></td>
				<td>&nbsp;<?php echo ($vo['company']); ?></td>
				<td>&nbsp;<?php echo ($vo['department']); ?></td>
				<td>&nbsp;<?php echo ($vo['job']); ?></td>
				<td>&nbsp;<?php echo ($vo['email']); ?></td>
				<td>&nbsp;<?php echo ($vo['contact']); ?></td>
				<td>&nbsp;<?php echo ($vo['truename']); ?></td>
				<td>&nbsp;<?php echo ($types[$vo['type']]); ?></td>
				<td>&nbsp;<?php echo ($vo['groupname']); ?></td>
				<td>&nbsp;
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/userModify?id=<?php echo ($vo['id']); ?>">更改</a>
				<a href="<?php echo ($siteInfo['webFolder']); ?>admin/delUser?id=<?php echo ($vo['id']); ?>">删除</a>
				<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	</body>
</html>