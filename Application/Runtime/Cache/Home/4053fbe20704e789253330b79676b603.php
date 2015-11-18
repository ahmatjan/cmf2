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
			<input type="button" id="addFolder" name="addFolder" value="添加文章" onclick="location.href='articleAdd';" />
			文章管理
		</div>
		<table style="min-width: 700px;">
			<tr>
				<th>标题</th>
				<th width="80">作者</th>
				<th width="80">状态</th>
				<th width="160">操作</th>
			</tr>
			<?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($vo['title']); ?></td>
				<td><?php echo ($vo['userid']); ?></td>
				<td><?php echo ($statuses[$vo['status']]); ?></td>
				<td>
				<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
				<?php
 if($vo['auditer'] == $_SESSION['userInfo']['userid'] && $vo['status'] == 1){ echo " <a href='javascript: void(0);' class='audit'>审核</a>"; } if($vo['adder'] == $_SESSION['userInfo']['userid']){ switch($vo['status']){ case 0: echo " <a href='javascript: void(0);' class='addaudit'>提交审核</a>"; echo " <a href='javascript: void(0);' class='modify'>修改</a>"; break; case 1: break; case 3: echo " <a href='javascript: void(0);' class='deleteaudit'>取消审核</a>"; break; } echo " <a href='javascript: void(0);' class='delete'>删除</a>"; } if($vo['status'] == 3){ echo " <a href='javascript: void(0);' class='seeaudit'>查看审核</a>"; } ?>
				</td><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	</div>
	<div id="auditDiv" class="popDiv">
		<form action="managearticle" method="post">
		<div id="rltDiv">
			<label for="rlt">审核结果:</label>
			<input type="radio" id="rlt0" name="rlt" value="0" />不通过
			<input type="radio" id="rlt1" name="rlt" value="1" checked="checked" />通过<br />
			<label for="comment">附言:</label>
			<textarea id="comment" name="comment"></textarea>
		</div>
		<div id="nextAudit">
		<label for="auditer" id="auditLabel">下一位审核人</label>
		<select id="auditer" name="auditer">
		<?php if(is_array($admins)): $i = 0; $__LIST__ = $admins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['userid']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		</div>
		<input type="hidden" id="artid" name="artid" />
		<input type="hidden" id="audittype" name="audittype" />
		<label>&nbsp;</label><input type="button" id="auditSub" value="提交" />
		</form>
		<div class="close">×</div>
	</div>
	<div id="seeauditDiv" class="popDiv">
		<ul>
		</ul>
		<div class="close">×</div>
	</div>
	</body>
</html>