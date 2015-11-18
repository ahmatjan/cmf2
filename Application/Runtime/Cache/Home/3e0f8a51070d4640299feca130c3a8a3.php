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
<body class="body-white">
<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
     <div class="container">
       <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a>
       <div class="nav-collapse collapse" id="main-menu">
       	<ul id=""  class="nav">
		<li   class=''   id= 'menu-item-1'><a href='<?php echo ($siteInfo['webFolder']); ?>' target=''>首页</a></li>
		<?php if(is_array($topFolder)): $i = 0; $__LIST__ = $topFolder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li   class=''   id= 'menu-item-<?php echo ($index + 3); ?>'><a href='<?php echo ($siteInfo['webFolder']); ?>article/folder?id=<?php echo ($vo['id']); ?>' target=''><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<ul class="nav pull-right" id="main-menu-user">
			<li class="dropdown user login">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	            <img src="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx//Public/images/headicon.png" class="headicon"/>
	            <span class="user-nicename"></span><b class="caret"></b></a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo ($siteInfo['webFolder']); ?>user/center"><i class="fa fa-user"></i> &nbsp;修改个人信息</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo ($siteInfo['webFolder']); ?>user/logout"><i class="fa fa-sign-out"></i> &nbsp;退出</a></li>
	            </ul>
          	</li>
          	<li class="dropdown user offline">
	            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
	           		<img src="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx//Public/images/headicon.png" class="headicon"/>登录<b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu pull-right">
	               <li><a href="<?php echo ($siteInfo['webFolder']); ?>user/login"><i class="fa fa-sign-in"></i> &nbsp;登录</a></li>
	               <li class="divider"></li>
	               <li><a href="<?php echo ($siteInfo['webFolder']); ?>user/reg"><i class="fa fa-user"></i> &nbsp;注册</a></li>
	            </ul>
          	</li>
		</ul>
		<!--<div class="pull-right">
        	<form method="post" class="form-inline" action="<?php echo ($siteInfo['webFolder']); ?>portal/search/index" style="margin:18px 0;">
				 <input type="text" class="" placeholder="Search" name="keyword" value=""/>
				 <input type="submit" class="btn btn-info" value="Go" style="margin:0"/>
			</form>
		</div>-->
       </div>
     </div>
   </div>
 </div>
	<div class="container tc-main">
		<div class="row">
			<div class="span6 offset3">
				<h2 class="text-center">修改信息</h2>
				<form class="form-horizontal J_ajaxForm" action="<?php echo ($siteInfo['webFolder']); ?>user/register/doregister" method="post">

					<div class="control-group">
						<label class="control-label" for="input_email">昵称</label>
						<div class="controls">
							<input type="text" id="input_nick" name="nick" placeholder="请输入昵称" value="<?php echo ($info['nick']); ?>" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_oldpassword">旧密码</label>
						<div class="controls">
							<input type="password" id="input_oldpassword" name="oldpassword" placeholder="请输入旧密码" class="span3"><br />（如果不修改密码，请将此三空留空）
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
							<button class="btn btn-primary J_ajax_submit_btn" type="button" data-wait="1500">提交</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.J_ajax_submit_btn').click(function(){
			var nick = $.trim($('#input_nick').val());
			var password = $.trim($('#input_password').val());
			var verify = $.trim($('#input_verify').val());
			if(password != ''){
				if($.trim($('#input_oldpassword').val()) == ''){
					alert('请输入旧密码');
					return;
				}
			}
			if(password != $.trim($('#input_repassword').val())){
				alert('两次输入的密码不一致');
				return;
			}
			$.post('doModify.html', {nick: encodeURIComponent(nick),oldpassword:$.trim($('#input_oldpassword').val()), password: password}, function(data){
				switch(data){
					case 'success':
						alert('修改成功');
						location.reload();
						break;
					case 'badpwd':
						alert('旧密码错误，请重试');
						break;
					default:
						alert('提交过程发生错误，请联系管理员');
				}
			})
		})		
	})
	</script>		

    
<!-- JavaScript -->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/newcms/",
    JS_ROOT: "static/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo ($siteInfo['webFolder']); ?>static/js/wind.js"></script>
    <script src="<?php echo ($siteInfo['webFolder']); ?>tpl/simplebootx/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ($siteInfo['webFolder']); ?>static/js/frontend.js"></script>
	<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo ($siteInfo['webFolder']); ?>user/is_login",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"<?php echo ($siteInfo['webFolder']); ?>data/upload/avatar/"+data.user.avatar);
				}
				
				$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
				$("#main-menu-user li.user.login").show();
				
			}
			if(data.status==0){
				$("#main-menu-user li.user.offline").show();
			}
			
		});	
		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		
	});
	</script>


<link rel="stylesheet" href="<?php echo ($siteInfo['webFolder']); ?>static/css/jqtree.css">
<script src="<?php echo ($siteInfo['webFolder']); ?>static/js/tree.jquery.js"></script>
<script language="JavaScript">

	var data = [
		{
			label: 'node1',
			children: [
				{ label: 'child1' },
				{ label: 'child2' }
			]
		},
		{
			label: 'node2',
			children: [
				{ label: 'child3' }
			]
		}
	];

	$(function() {
		$('#tree1').tree({
			data: data
		});
	});

</script>
	</body>
</html>