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
<input type="hidden" id="tableName" name="tableName" value="<?php echo ($table); ?>" />
<table id="listTable">
	<colgroup>
<?php if($table == 'tbl_student'): ?><col /><?php endif; ?>
<?php if(is_array($fields)): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><col /><?php endforeach; endif; else: echo "" ;endif; ?>
		<col width="120" />
	</colgroup>
<?php if($search): ?><tr>
<?php if($table == 'tbl_student'): ?><td class="noborder"></td><?php endif; ?>
		<td class="noborder" colspan="<?php echo ($num + 1); ?>">
<form method="get" action="">
<?php if(is_array($search)): $i = 0; $__LIST__ = $search;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo['name']); ?>:
<?php if($vo['type'] == 3): ?><select id="f_<?php echo ($vo['id']); ?>" name="f_<?php echo ($vo['id']); ?>">
<?php if(is_array($types[$vo['value']])): $i = 0; $__LIST__ = $types[$vo['value']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo ($option['id']); ?>"><?php echo ($option['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<?php else: ?>
<input type="text" id="f_<?php echo ($vo['id']); ?>" name="f_<?php echo ($vo['id']); ?>" /><?php endif; endforeach; endif; else: echo "" ;endif; ?>
<input type="submit" value="搜索" />
</form>
		</td>
	</tr><?php endif; ?>
	<tr>
<?php if($table == 'tbl_student'): ?><td class="noborder"></td><?php endif; ?>
		<td class="noborder" colspan="<?php echo ($num + 1); ?>">
		</td>
		<td class="noborder">
<?php if($table == 'tbl_student'): ?><a href="javascript:void(0)" id="sendsms">发送短信</a>
			<a href="javascript:void(0)" id="export">导出记录</a><?php endif; ?>
			<a href="/tour/table/add<?php echo (substr($table,4)); ?>" target="right">添加记录</a>
		</td>
	</tr>
	<tr>
<?php if($table == 'tbl_student'): ?><th><input type="checkbox" id="selectAll" name="selectAll" /></th><?php endif; ?>
		<th>名称</th>
<?php if(is_array($fields)): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo['name']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
		<th>操作</th>
	</tr>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
<?php if($table == 'tbl_student'): ?><td><input type="checkbox" /></td><?php endif; ?>
		<td><?php echo ($vo['name']); ?></td>
<?php if(is_array($fields)): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><td>
			<?php if($field['type'] == 3): echo $options[$vo['f_' . $field['id']]];?>
			<?php else: ?>
			<?php echo $vo['f_' . $field['id']]; endif; ?>
		</td><?php endforeach; endif; else: echo "" ;endif; ?>
		<td class="action">
			<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
			<a class="modify" href="/tour/table/projectmodify?id=<?php echo ($vo['id']); ?>" target="right">修改</a>
			<a class="delete" href="javascript:void(0);">删除</a>
		</td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if($page): ?><tr>
		<td class="noborder" colspan="<?php echo ($num + 1); ?>">
			<?php echo ($page); ?>
		</td>
	</tr><?php endif; ?>
</table>
<?php if($table == 'tbl_student'): ?><form id="excelForm" target="_blank" action="/table/exportuser">
	<input type="hidden" id="ids" name="ids" />
	</form><?php endif; ?>
	</body>
</html>