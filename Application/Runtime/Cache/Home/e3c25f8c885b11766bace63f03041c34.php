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
	<table id="fieldTable">
		<colgroup>
			<col />
			<col />
			<col />
			<col width="100" />
			<col width="100" />
			<col width="100" />
			<col width="180" />
		</colgroup>
		<thead>
			<tr>
				<td class="noborder" colspan="7">
					<a href="/tour/sys/fields?table=tbl_project">项目表</a>
					<a href="/tour/sys/fields?table=tbl_student">学员表</a>
				</td>
			</tr>
			<tr>
				<th>排序</th>
				<th>名称</th>
				<th>类型</th>
				<th>外观</th>
				<th>查询字段</th>
				<th>列表字段</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo['order']); ?></td>
				<td><?php echo ($vo['name']); ?></td>
				<td><?php echo ($types[$vo['type']]); if($vo['type'] == 1): ?>(<?php echo ($vo['value']); ?>)<?php else: if($vo['type'] == 3): ?>(<?php echo ($type2[$vo['value']]); ?>)<?php endif; endif; ?></td>
				<td><?php echo ($appearance[$vo['display']]); ?></td>
				<td><?php if($vo['search'] == 0): ?>否<?php else: ?>是<?php endif; ?></td>
				<td><?php if($vo['inlist'] == 0): ?>否<?php else: ?>是<?php endif; ?></td>
				<td class="action">
					<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
					<a href="javascript:void(0);" class="modify">修改</a>
					<a href="javascript:void(0);" class="delete">删除</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<tr>
				<td class="noborder" colspan="7">
					<ul class="add">
						<li>
							<label for="name">名称：</label>
							<input type="text" id="name" name="name" />
						</li>
						<li>
							<label for="type">类型：</label>
							<select name="type" id="type">
<?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($type); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</li>
						<li id="valueLi" class="hidden">
							<label for="value">长度：</label>
							<input type="number" size="4" style="width: 60px;" class="value" min="1" max="1000" value="20" />(1-1000)
						</li>
						<li id="typeLi" class="hidden">
							<label for="value">选择内容：</label>
							<select class="value">
<?php if(is_array($typeList)): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?>(<?php echo ($vo['content']); ?>)</option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</li>
						<li>
							<label for="display">显示方式：</label>
							<select id="display" name="display">
<?php if(is_array($appearance)): $i = 0; $__LIST__ = $appearance;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</li>
						<li>
							<label for="search">查询字段：</label>
							<input type="radio" value="0" id="search0" name="search" checked />否
							<input type="radio" value="1" id="search1" name="search" />是
						</li>
						<li>
							<label for="inlist">列表字段：</label>
							<input type="radio" value="0" id="inlist0" name="inlist" checked />否
							<input type="radio" value="1" id="inlist1" name="inlist" />是
						</li>
						<li>
							<input type="hidden" id="table" name="table" value="<?php echo ($table); ?>" />
							<input type="button" value="添加" id="addSub" name="addSub" />
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
	</body>
</html>