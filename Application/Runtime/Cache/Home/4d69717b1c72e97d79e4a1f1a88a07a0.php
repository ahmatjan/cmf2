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
	<table id="selectTable">
		<colgroup>
			<col />
			<col />
			<col width="180" />
		</colgroup>
		<thead>
			<tr>
				<th>类型</th>
				<th>引用</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><span><?php echo ($vo['name']); ?></span><br />
				(<em><?php echo ($vo['content']); ?></em>)</td>
				<td><?php if($vo['tables'] == ''): ?>无<?php else: echo ($vo['tables']); endif; ?></td>
				<td class="action">
					<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
					<a href="javascript:void(0);" class="modify">修改</a>
					<?php if($vo['tables'] == ''): ?><a href="javascript:void(0);" class="delete">删除</a><?php endif; ?>
					<a href="/tour/Sys/options?type=<?php echo ($vo['id']); ?>" target="right">查看内容</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<tr>
				<td colspan="4" class="noborder">				
					<ul class="add">
						<li>
							<label for="name">名称：</label>
							<input type="text" id="name" name="name" />
						</li>
						<li>
							<label for="content">备注：</label>
							<input type="text" id="content" name="content" />
						</li>
						<li>
							<input type="button" value="添加" id="addSub" name="addSub" />
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
	</body>
</html>