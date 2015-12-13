<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo ($siteInfo['webFolder']); ?>static/css/front/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo ($siteInfo['webFolder']); ?>static/css/front/front.css" rel="stylesheet" type="text/css"/>

<div id="alone_content" class="w1000 fr">
	<div>
		<div class="rb_top2">
			<span style="line-height: 25px;margin: 0 0 0 10px;color:#ffffff;"><?php echo ($folderName); ?></span>
		</div>
		<div class="rb_mid box">
			<div class="w96" style="min-height:400px;">
				<div class="c1-body">
					<?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="c1-bline" style="padding:10px 0;">
						<div class="f-left"><img src="<?php echo ($siteInfo['webFolder']); ?>static/img/head-mark5.gif" align="middle" class="img-vm" border="0"> &nbsp;

							<a href="<?php echo ($siteInfo['webFolder']); ?>article/article?id=<?php echo ($vo['id']); ?>" title="<?php echo ($vo['title']); ?>" target="_blank">
								<span style=""><?php echo ($vo['title']); ?></span>
							</a>
						</div>
						<div class="gray f-right"><?php echo ($vo['updatetime']); ?></div>
						<div class="clear">
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>