<?php
namespace Home\Controller;

class UserController extends FrontController {
	
    protected function _initialize() {
		parent::_initialize();
	}
	
	public function log(){
		$this->assign('jsFiles', array('user.js'));
		$this->display();
	}
	
	public function doLogin(){
		$userid = I('post.userid');
		$password = I('post.password');
		
		$pwd = md5($password);
		$dao = D('User');
		$info = $dao->where(array('userid' => $userid, 'password' => $pwd))->find();
		if(!empty($info)){
			$_SESSION['userInfo']['userid'] = $info['id'];
			$_SESSION['userInfo']['type'] = $info['type'];
			$_SESSION['userInfo']['nick'] = $info['nick'];
			exit('success');
		}else{
			exit('badpwd');
		}
		
	}
	
	function logout(){
		$_SESSION['userInfo'] = null;
		header("location: " . C('webFolder'));
	}
	    
    function is_login(){
    	if(!empty($_SESSION['userInfo']['userid'])){
    		$this->ajaxReturn(array("status"=>1,"user"=>$_SESSION['userInfo']['nick']));
    	}else{
    		$this->ajaxReturn(array("status"=>0,"info"=>"此用户未登录！"));
    	}
    }
	
	public function login(){
		$this->display();
	}
	
	public function reg(){
		$this->display();
	}
	
	public function center(){
		$info = D('User')->where(array('id' => $_SESSION['userInfo']['userid']))->find();
		$this->assign('info', $info);
		$this->display();
	}
	
	public function doModify(){
		$dao = D('User');
		if(!empty($_POST['password'])){
			$info = $dao->where(array('id' => $_SESSION['userInfo']['userid'], 'password' => md5($_POST['oldpassword'])))->find();
			if(empty($info)){
				exit('badpwd');
			}
		}
		if(empty($_POST['password'])){
			unset($_POST['password']);
		}else{
			$_POST['password'] = md5($_POST['password']);
		}
		$_POST['nick'] = urldecode($_POST['nick']);
		$dao->where(array('id' => $_SESSION['userInfo']['userid']))->save($_POST);
		exit('success');
	}
	
	public function doReg(){
		$dao = D('User');
		if(strtoupper($_POST['code']) !== $_SESSION['code']) exit('badcode');
		$info = $dao->where(array('userid' => $_POST['userid']))->find();
		if(empty($info)){
			$_POST['password'] = md5($_POST['password']);
			$id = D('User')->add($_POST);
			$_SESSION['userInfo'] = array(
				'userid' => $id,
				'nick' => urldecode($_POST['nick']),
				'type' => 0
			);
			exit('success');
		}else{
			exit('haveuser');
		}
	}
}