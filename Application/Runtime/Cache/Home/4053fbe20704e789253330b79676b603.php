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
			<a href="<?php echo ($siteInfo['webFolder']); ?>admin/articleAdd">增加新文章</a>
		</div>
		<table>
			<tr>
				<th>序号</th>
				<th>标题</th>
				<th>作者</th>
				<th>文章发布人</th>
				<th>修改日期</th>
				<th>提交日期</th>
				<th>发布日期</th>
				<th>最后审核人</th>
				<th>审核日期</th>
				<th>紧急重要度</th>
				<th>栏目</th>
				<th>可见用户组</th>
				<th>备注</th>
				<th>文章状态</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td>
					<?php echo ($vo['id']); ?>
				</td>
				<td>
					<a href="<?php echo ($siteInfo['webFolder']); ?>article/article?id=<?php echo ($vo['id']); ?>" target="_blank"><?php echo ($vo['title']); ?></a>
				</td>
				<td>
					<?php echo ($vo['author']); ?>
				</td>
				<td>
					<?php echo ($userMapping[$vo['adder']]); ?>
				</td>
				<td>
					<?php echo ($vo['updatetime']); ?>
				</td>
				<td>
					<?php echo ($vo['submittime']); ?>
				</td>
				<td>
					<?php echo ($vo['publishtime']); ?>
				</td>
				<td>
					<?php echo ($userMapping[$vo['auditor']]); ?>
				</td>
				<td>
					<?php echo ($vo['audittime']); ?>
				</td>
				<td>
					<?php echo ($priorityMapping[$vo['priority']]); ?>
				</td>
				<td>
					<?php
 $folders = $vo['folders']; foreach($folders as $folder) { echo "<li>"; echo $folderMapping[$folder['folder']]; echo " "; echo "</li>"; } ?>
				</td>
				<td>
					<?php
 $groups = $vo['groups']; foreach($groups as $group) { echo "<li>"; echo $groupMapping[$group['group']]; echo " "; echo "</li>"; } ?>
				</td>
				<td>
					<?php echo ($vo['comments']); ?>
				</td>
				<td>
					<?php echo ($statusMapping[$vo['status']]); ?>
				</td>
				<td>
					<input type="hidden" class="id" value="<?php echo ($vo['id']); ?>" />
					<?php
 $currentUser = $_SESSION['userInfo']['id']; if($vo['auditor'] == $currentUser && $vo['status'] == 2){ echo "<a href='javascript: void(0);' class='audit'>审核</a>"; } if($vo['adder'] == $currentUser){ switch($vo['status']){ case 1: echo " <a href='javascript: void(0);' class='addaudit'>提交审核</a>"; echo " <a href='javascript: void(0);' class='modify'>修改</a>"; break; case 2: echo " <a href='javascript: void(0);' class='deleteaudit'>撤回</a>"; break; case 3: echo " <a href='javascript: void(0);' class='deleteaudit'>撤回</a>"; break; } echo " <a href='javascript: void(0);' class='delete'>删除</a>"; } if($vo['status'] == 3 || $vo['status'] == 2){ echo " <a href='javascript: void(0);' class='seeaudit'>查看审核历史信息</a>"; } ?>
				</td><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
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
				<label for="auditor" id="auditLabel">下一位审核人</label>
				<select id="auditor" name="auditor">
					<?php if(is_array($auditors)): $i = 0; $__LIST__ = $auditors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['username']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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