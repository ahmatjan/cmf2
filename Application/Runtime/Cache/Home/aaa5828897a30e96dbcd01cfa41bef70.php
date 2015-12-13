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

		<form action="<?php echo ($action); ?>" method="post" enctype="multipart/form-data">
			<label for="title">文章标题</label>
			<input type="text" id="title" name="title" value="<?php echo ($info['title']); ?>" />
			<br/>

			<label for="author">作者</label>
			<input type="text" id="author" name="author" value="<?php echo ($info['author']); ?>" />
			<br/>

			<label for="keywords">关键字</label>
			<input type="text" id="keywords" name="keywords" value="<?php echo ($info['keywords']); ?>" />
			<br/>

			<label for="abstract">摘要</label>
			<textarea rows="3", cols="50" id="abstract" name="abstract"><?php echo ($info['abstract']); ?></textarea>
			<br/>


			<label for="comment">备注</label>
			<textarea rows="3", cols="50" id="comment" name="comment"><?php echo ($info['comment']); ?></textarea>
			<br/>

			<label for="template">模板</label>
			<select id="template" name="template">
			<option value="article">缺省模板</option>
			</select><br />

			<label for="audit">审核</label>
			<input type="radio" id="audit0" name="audit" value="0" />不需要审核
			<input type="radio" id="audit1" name="audit" value="1" checked="checked" />需要审核
			<br />

			<label for="priority">重要度</label>
			<select id="priority" name="priority">
				<option value="1" <?php if($info['priority'] == 1): ?>selected<?php endif; ?>>一般</option>
				<option value="2" <?php if($info['priority'] == 2): ?>selected<?php endif; ?>>紧急</option>
				<option value="3" <?php if($info['priority'] == 3): ?>selected<?php endif; ?>>重要</option>
			</select>
			<br />

			<label for="folder">栏目</label>
			<select id="folder" name="folder[]" multiple="multiple">
				<?php if(is_array($folders)): $i = 0; $__LIST__ = $folders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>

			&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="group">可见组</label>
			<select id="group" name="group[]" multiple="multiple">
				<?php if(is_array($groups)): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select><br />

			<label for="content">内容</label>
			<textarea name="content" id="content" rows="6" cols="60"><?php echo ($info['content']); ?></textarea>
			<script type="text/javascript">
				//<![CDATA[
				window.CKEDITOR_BASEPATH='<?php echo ($siteInfo['webFolder']); ?>static/js/ckeditor/';
				//]]>
			</script>

			<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/ckeditor/ckeditor.js?t=B8DJ5M3"></script>
			<script type="text/javascript">
				//<![CDATA[
				CKEDITOR.replace('content', {"extraPlugins":"dedepage,multipic,addon","toolbar":[["Source","-","Templates"],["Cut","Copy","Paste","PasteText","PasteFromWord","-","Print"],["Undo","Redo","-","Find","Replace","-","SelectAll","RemoveFormat"],["ShowBlocks"],["Image","Flash","Addon"],["Maximize"],"/",["Bold","Italic","Underline","Strike","-"],["NumberedList","BulletedList","-","Outdent","Indent","Blockquote"],["JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock"],["Table","HorizontalRule","Smiley","SpecialChar"],["Link","Unlink","Anchor"],"/",["Styles","Format","Font","FontSize"],["TextColor","BGColor","MyPage","MultiPic"]],"height":450,"skin":"kama"});
				//]]>
			</script>
			<br />

			<?php if($oldAttachments): ?><div id="oldAttachments">
					<span>现有附件：</span>
					<?php if(is_array($oldAttachments)): $i = 0; $__LIST__ = $oldAttachments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
							<span><?php echo ($vo['name']); ?></span>
							<input type="hidden" name="oldAttachments[]" value="<?php echo ($vo['id']); ?>" /><a href="javascript:void(0);">×</a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div><?php endif; ?>

			<label for="attachment">附件</label>
			<input type="button" id="addAttach" name="addAttach" value="添加一个附件" /><br />
			<div id="attachments">
				<div>
					<label>&nbsp;</label>
						<input type="file" name="attachment[]" />
						<input type="text" name="filename[]" placeholder="附件名称" />
						<a href="javascript: void(0);">×</a>
				</div>
			</div>
			<br />

			<?php if($oldGroups): ?><div id="oldGroups">
					<?php if(is_array($oldGroups)): $i = 0; $__LIST__ = $oldGroups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($vo['group']); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
				</div><?php endif; ?>
			<?php if($oldFolders): ?><div id="oldFolders">
					<?php if(is_array($oldFolders)): $i = 0; $__LIST__ = $oldFolders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($vo['folder']); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
				</div><?php endif; ?>
			<input type="hidden" id="id" name="id" value="<?php echo ($info['id']); ?>" />
			<label>&nbsp;</label>
			<input type="button" class="button" id="addSub" value="确定" />
		</form>
	</div>
	</body>
</html>