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
<form action="<?php echo ($action); ?>" method="post">
<ul id="fields">
<li class="dtype">
<label for="name">名称</label>
<input type="text" id="name" name="name" />
</li>
<?php if(is_array($fields)): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><li class="dtype<?php echo ($field['display']); ?>">
<?php if($field['type'] == 0): ?><label><?php echo ($field['name']); ?></label>
<?php elseif($field['type'] == 3): ?>
<label for="f_<?php echo ($field['id']); ?>"><?php echo ($field['name']); ?></label>
<select id="f_<?php echo ($field['id']); ?>" name="f_<?php echo ($field['id']); ?>">
<?php if(is_array($options[$field['value']])): $i = 0; $__LIST__ = $options[$field['value']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><option value="<?php echo ($option['id']); ?>"><?php echo ($option['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<?php elseif($field['type'] == 4): ?>
<label for="f_<?php echo ($field['id']); ?>"><?php echo ($field['name']); ?></label>
<input type="text" id="f_<?php echo ($field['id']); ?>" name="f_<?php echo ($field['id']); ?>" />
<?php elseif($field['type'] == 5): ?>
<label for="f_<?php echo ($field['id']); ?>"><?php echo ($field['name']); ?></label>
<input type="text" class="date" id="f_<?php echo ($field['id']); ?>" name="f_<?php echo ($field['id']); ?>" />
<?php else: ?>
<label for="f_<?php echo ($field['id']); ?>"><?php echo ($field['name']); ?></label>
<input type="text" id="f_<?php echo ($field['id']); ?>" name="f_<?php echo ($field['id']); ?>" /><?php endif; ?>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
<?php if($table == 'tbl_project'): ?><li>
<label for="adder">主经办人</label>
<select id="adder" name="adder">
<?php if(is_array($adders)): $i = 0; $__LIST__ = $adders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</li>
<li>
<label for="auditer">审核人</label>
<select id="auditer" name="auditer">
<?php if(is_array($auditers)): $i = 0; $__LIST__ = $auditers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</li>
<li>
<label for="confirmer">复核人</label>
<select id="confirmer" name="confirmer">
<?php if(is_array($confirmers)): $i = 0; $__LIST__ = $confirmers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</li><?php endif; ?>
</ul>
<?php if($table == 'tbl_project'): ?><hr />
<ul id="users">
<li>
<select id="pusers">
<?php if(is_array($pusers)): $i = 0; $__LIST__ = $pusers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><option value="<?php echo ($user['id']); ?>"><?php echo ($user['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<input type="button" id="adduser" value="添加" />
</li>
</ul><?php endif; ?>
<input type="hidden" name="table" id="table" value="<?php echo ($table); ?>" />
<?php if($id): ?><input type="hidden" id="id" name="id" value="<?php echo ($id); ?>" /><?php endif; ?>
</form>
<?php if($oldData): ?><div class="oldData">
<?php if(is_array($oldData)): $i = 0; $__LIST__ = $oldData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" class="<?php echo ($key); ?>" value="<?php echo ($vo); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
</div><?php endif; ?>
<?php if($puids): ?><div class="oldUsers">
<?php if(is_array($puids)): $i = 0; $__LIST__ = $puids;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($vo['student']); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
</div><?php endif; ?>
<div class="buttons">
	<a id="addSub" href='javascript:void(0);'>提交</a>
</div>
	</body>
</html>