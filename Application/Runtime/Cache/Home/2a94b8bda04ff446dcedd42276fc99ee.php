<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
		<title>国际交流合作中心信息管理平台 国际交流合作中心信息管理平台</title>
		<meta name="keywords" content="" />
		<meta name="description" content="创建人">
		<meta name="author" content="ThinkCMF">
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<!-- Set render engine for 360 browser -->
    	<meta name="renderer" content="webkit">
   		<!-- No Baidu Siteapp-->
    	<meta http-equiv="Cache-Control" content="no-siteapp"/>
    	<!-- HTML5 shim for IE8 support of HTML5 elements -->
    	<!--[if lt IE 9]>
      		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<![endif]-->
		<link rel="icon" href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/images/favicon.ico" type="image/x-icon">
    	<!--[if IE 7]>
			<link rel="stylesheet" href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
		<![endif]-->
		<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/style.css" />
		<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/init.js"></script>
</head>
<body>

<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/master.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/zTreeStyle/zTreeStyle.css">
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/demo.css" >
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/front/g.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ($siteInfo['webFolder']); ?>static/css/front/css.css"  />

<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/front/tree.js"></script>
<script type="text/javascript" src="<?php echo ($siteInfo['webFolder']); ?>static/js/front/selectbox.js"></script>

<script type="text/javascript"> $(document).ready(function() {$('#mySle').selectbox();});</script>
<div id="top" class="front_top">
</div>
<div class="searchbox">
    <div class="searchZone clearfix">
        <form action="<?php echo ($siteInfo['webFolder']); ?>article/advSearch" target="rightFrame">
            <fieldset>
                <label>
                    <input type="text" class="text" name="keyword" onblur="if(this.value==''){this.value='请输入关键字';this.style.color='#aaa'}" onfocus="if(this.value=='请输入关键字'){this.value='';this.style.color='#333'}" value="请输入关键字" />
                </label>
                <div class="left">
                    <select style="display: none;" name="mySle" id="mySle">
                        <option selected="selected" value="0">搜索标题</option>
                        <option value="1">搜索关键字</option>
                        <option value="2">搜索作者</option>
                        <option value="3">搜索摘要</option>
                        <option value="4">搜索内容</option>
                        <option value="5">搜索目录</option>
                        <option value="6">搜索附件</option>
                        <option value="7">搜索表格</option>
                    </select>
                </div>
                <label>
                    <button type="submit">搜索</button>
                </label>
            </fieldset>
        </form>
    </div>
</div>

<?php
 $user = $_SESSION['userInfo']; $userid = $_SESSION['userInfo']['id']; $username = $_SESSION['userInfo']['username']; ?>
<div id="left" >
    <div class="sidebar fleft">
        <ul>
            <li>
                <?php if($username != ''): ?><div class="title">您好，<?php echo ($username); ?> &nbsp;&nbsp;</div>
                    <ul class="menu">
                        <li> <a href="<?php echo ($siteInfo['webFolder']); ?>user/logout">退出登录</a></li>
                        <li> <a href="<?php echo ($siteInfo['webFolder']); ?>user/modify">修改信息</a></li>
                    </ul>
                <?php else: ?>
                    <div class="title">您好，游客 &nbsp;&nbsp;</div>
                    <br>
                    <ul class="menu">
                        <form method="post" action="<?php echo ($siteInfo['webFolder']); ?>user/doLogin">
                            <label for="username">用户名:</label>
                            <input type="text" id="username" name="username"> <br>
                            <label for="password">密码:&nbsp;&nbsp;&nbsp;</label>
                            <input type="password" id="password" name="password"> <br>
                            <input type="submit" name="登录">
                        </form>
                        <li> <a href="<?php echo ($siteInfo['webFolder']); ?>user/reg">注册用户</a></li>
                    </ul><?php endif; ?>
            </li>
            <li>
                <div class="title">文章栏目</div>
                <ul id="articleTree" class="ztree"></ul>
            </li>
            <br>
        </ul>
    </div>
</div>
<div id="right" class="rightDiv">
    <iframe  src="<?php echo ($siteInfo['webFolder']); ?>article/folder" scrolling="none" id="rightFrame" name="rightFrame">
    </iframe>
</div>

	</body>
</html>