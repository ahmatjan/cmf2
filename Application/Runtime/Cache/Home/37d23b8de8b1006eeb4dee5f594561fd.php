<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title><?php echo ($article['title']); ?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="" http-equiv="keywords">
	<meta content="" http-equiv="description">
	<script src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo ($siteInfo['webFolder']); ?>static/css/front/front.js" type="text/javascript"></script>
	<link href="<?php echo ($siteInfo['webFolder']); ?>static/css/front/layout.css" type="text/css" rel="stylesheet">
</head>
<body>

<div id="main">
	<div class="page2 box">
		<div class="w740 fl">
			<div class="rb_top3">
				<span style="line-height: 25px;margin: 0 0 0 10px;color:#ffffff;"><?php echo ($folderName); ?></span>
			</div>
			<div class="rb_mid box">
				<div class="w96">
					<div class="line2"><?php echo ($article['title']); ?></div>
					<div class="msgbar">发布时间： <?php echo ($article['updatetime']); ?> &nbsp; 作者：<?php echo ($article['author']); ?> &nbsp; 浏览次数：<?php echo ($article['click']); ?></div>

                    <div class="summary"><strong><?php echo ($article['abstract']); ?></strong> </div>

					<!--  -->
					<div class="content"><p>&nbsp;<span class="Apple-style-span" style="line-height: 22px; font-family: Simsun; font-size: 14px"> </span>
					</p>
						<p>&nbsp;</p>
						<p><?php echo ($article['content']); ?></p>

						<br>
						附件：
						<br>
						<?php if(is_array($attachments)): $i = 0; $__LIST__ = $attachments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['img']): ?><p>
									<img src="<?php echo ($siteInfo['webFolder']); echo ($vo['attachment']); ?>" alt="<?php echo ($vo['name']); ?>" />
								</p>
								<?php else: ?>
								<p style="line-height: 16px;">
									<br>
									<img style="vertical-align: middle; margin-right: 2px;" src="<?php echo ($siteInfo['webFolder']); ?>static/js/ueditor/dialogs/attachment/fileTypeImages/icon_txt.gif"/>
									<a style="font-size:12px; color:#0066cc;" href="<?php echo ($siteInfo['webFolder']); echo ($vo['attachment']); ?>" title="<?php echo ($vo['name']); ?>"><?php echo ($vo['name']); ?></a>
								</p><?php endif; endforeach; endif; else: echo "" ;endif; ?>

					<div class="pagebar"></div>
					<!--<div class="tags"><strong>Tags：</strong>  本文暂无Tags！ </div>
                    <div class="other box">
						<ul>
							<li><strong>上一篇：</strong><a href="#"></a></li>
							<li><strong>下一篇：</strong><a href="#"></a></li>
						</ul>
					</div>
					-->
				</div>
				<!--网友评论_Begin--> <!--网友评论_End--></div>
			<div class="rb_low"></div>
		</div>
	</div>
</div>
</body>
</html>