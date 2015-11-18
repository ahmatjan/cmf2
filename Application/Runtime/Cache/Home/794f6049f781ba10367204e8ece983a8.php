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
	<table id="optionTable">
		<colgroup>
			<col />
			<col />
			<col />
			<col width="180" />
		</colgroup>
		<thead>
			<tr>
				<th>名称</th>
				<th>类型</th>
				<th>引用</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo['name']); ?></td>
				<td><?php echo ($types[$vo['type']]); ?></td>
				<td><?php echo ($vo['count']); ?></td>
				<td class="action">
					<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
					<a href="javascript:void(0);" class="modify">修改</a>
					<?php if($vo['count'] == 0): ?><a href="javascript:void(0);" class="delete">删除</a><?php endif; ?>
					<a href="/tour/sys/auditoption?audit=<?php echo ($vo['id']); ?>" target="right">查看内容</a>
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
							<label for="type">类型：</label>
							<select id="type" name="type">
<?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>							
							</select>
						</li>
						<li>
							<input type="hidden" id="type" name="type" value="<?php echo ($type); ?>" />
							<input type="button" value="添加" id="addSub" name="addSub" />
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
	</body>
</html>