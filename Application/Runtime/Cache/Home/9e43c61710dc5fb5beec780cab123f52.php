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
		<div class="title">
			<a href="<?php echo ($siteInfo['webFolder']); ?>admin/groupAdd">增加会员组</a>
		</div>
		<table>
			<tr>
				<th>会员组编号</th>
				<th>会员组名称</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td>
					<span><?php echo ($vo['id']); ?></span>
				</td>
				<td>
					<span><?php echo ($vo['name']); ?></span>
				</td>
				<td>
					<a class="delSub" href="javascript: void(0);">删除</a>
					<a href="groupModify?id=<?php echo ($vo['id']); ?>">更改</a>
					<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
					<div class="c"></div>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
	</body>
</html>