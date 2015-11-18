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
<ul id="tabs">
	<li class="now"><a href="javascript:void(0);" class="audits">审核</a></li>
</ul>
<form id="auditForm" action="/audit/doaudit" method="post">
<input type="hidden" id="pid" name="pid" value="<?php echo ($pid); ?>" />
<input type="hidden" id="aid" name="aid" value="<?php echo ($aid); ?>" />
<ul id="audits">
<?php if(is_array($audits)): $i = 0; $__LIST__ = $audits;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$audit): $mod = ($i % 2 );++$i;?><li class="audit<?php echo ($audit['type']); ?>">
	<label for="audit_<?php echo ($audit['id']); ?>"><?php echo ($audit['name']); ?></label>
	<?php if($audit['type'] == 0): ?><a href="javascript:void(0);" class="audit"></a>
	<a href="javascript:void(0);" class="confirm"></a>
	<input type="text" id="audit_<?php echo ($audit['id']); ?>" name="value[]" value="<?php echo ($audit['value']); ?>" class="value" />
	<input type="hidden" class="id" name="id[]" value="<?php echo ($audit['id']); ?>" />
	<input type="hidden" class="isaudit" value="<?php echo ($audit['isaudit']); ?>" />
	<input type="hidden" class="isconfirm" value="<?php echo ($audit['isconfirm']); ?>" />
	<a target="_blank" class="download" href="javascript: void(0);"></a>
	<?php else: ?>
	<input type="hidden" class="id" name="id[]" value="<?php echo ($audit['id']); ?>" />
	<input type="hidden" class="value" name="value[]" value="<?php echo ($audit['value']); ?>" /><?php endif; ?>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php if($pusers): ?><ul id="users">
<?php if(is_array($pusers)): $i = 0; $__LIST__ = $pusers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
<label for="user_<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></label>
<a href="javascript:void(0);" class="audit"></a>
<a href="javascript:void(0);" class="confirm"></a>
<input type="text" id="user_<?php echo ($vo['id']); ?>" value="" class="value" />
<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
<input type="hidden" class="isaudit" value="<?php echo ($audit['isaudit']); ?>" />
<input type="hidden" class="isconfirm" value="<?php echo ($audit['isconfirm']); ?>" />
<a target="_blank" class="download" href="javascript: void(0);"></a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul><?php endif; ?>
</form>
<div class="c">
	<input type="button" id="auditSub" name="auditSub" value="保存" />
</div>
<div id="uploadDiv">
	<input type="file" id="uploadFile" name="uploadFile" />
</div>
	</body>
</html>