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
    <link href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/simpleboot/themes/cmf/theme.min.css" rel="stylesheet">
    <link href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <script src="<?php echo ($siteInfo['webFolder']); ?>static/js/jquery.js"></script>
	<!--[if IE 7]>
	<link rel="stylesheet" href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/css/style.css" rel="stylesheet">
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
	</style>
	
		<link href="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/css/slippry/slippry.css" rel="stylesheet">
		<style>
			.caption-wraper{position: absolute;left:50%;bottom:2em;}
			.caption-wraper .caption{
			position: relative;left:-50%;
			background-color: rgba(0, 0, 0, 0.54);
			padding: 0.4em 1em;
			color:#fff;
			-webkit-border-radius: 1.2em;
			-moz-border-radius: 1.2em;
			-ms-border-radius: 1.2em;
			-o-border-radius: 1.2em;
			border-radius: 1.2em;
			}
			@media (max-width: 767px){
				.sy-box{margin: 12px -20px 0 -20px;}
				.caption-wraper{left:0;bottom: 0.4em;}
				.caption-wraper .caption{
				left: 0;
				padding: 0.2em 0.4em;
				font-size: 0.92em;
				-webkit-border-radius: 0;
				-moz-border-radius: 0;
				-ms-border-radius: 0;
				-o-border-radius: 0;
				border-radius: 0;}
			}
		</style>
	</head>
<body class="body-white nopadding">
	<div class="container tc-main">
		<div class="row">
			<div class="span6 offset3">
				<h2 class="text-center">创建账号</h2>
				<form class="form-horizontal J_ajaxForm" action="<?php echo ($siteInfo['webFolder']); ?>user/register/doregister" method="post">
					<div class="control-group">
						<label class="control-label" for="input_username">账号</label>
						<div class="controls">
							<input type="text" id="input_username" name="username" placeholder="请输入登录用户名" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_truename">真实姓名</label>
						<div class="controls">
							<input type="text" id="input_truename" name="truename" placeholder="请输入用户真实姓名" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_password">密码</label>
						<div class="controls">
							<input type="password" id="input_password" name="password" placeholder="请输入密码" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword">重复密码</label>
						<div class="controls">
							<input type="password" id="input_repassword" name="repassword" placeholder="请输入重复密码" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<button class="btn btn-primary J_ajax_submit_btn" type="button" data-wait="1500">确定注册</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	<script type="text/javascript">
	$(document).ready(function(){
		$('.J_ajax_submit_btn').click(function(){
			var userid = $.trim($('#input_username').val());
			var truename = $.trim($('#input_truename').val());
			var password = $.trim($('#input_password').val());
			var verify = $.trim($('#input_verify').val());
			if(userid == ''){
				alert('请输入用户名');
				return;
			}
			if(password == ''){
				alert('请输入密码');
				return;
			}
			if(password != $.trim($('#input_repassword').val())){
				alert('两次输入的密码不一致');
				return;
			}


			$.post('doReg', {userid: userid, truename: encodeURIComponent(truename), password: password}, function(data){
				switch(data){
					case 'success':
						alert('注册成功');
						location.href = '../index';
						break;
					default:
						alert('提交过程发生错误，请联系管理员');
				}
			})
		})		
	})
	</script>		
	</body>
</html>