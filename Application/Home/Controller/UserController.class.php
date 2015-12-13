<?php
namespace Home\Controller;

class UserController extends FrontController {
	
    protected function _initialize() {
		parent::_initialize();
	}
	
	public function adminLogin(){
		$this->assign('jsFiles', array('user.js'));
		$this->display();
	}

	//登录
	public function doLogin(){
		$username = I('post.username');
		$password = I('post.password');
		
		$pwd = md5($password);
		$dao = D('User');
		$info = $dao->where(array('username' => $username, 'password' => $pwd))->find();
		if(!empty($info)){
			$_SESSION['userInfo']['id'] = $info['id'];
			$_SESSION['userInfo']['username'] = $info['username'];
			$_SESSION['userInfo']['type'] = $info['type'];
			$_SESSION['userInfo']['truename'] = $info['truename'];
			$this->display("Index:index");
		}else{
			$this->display("Index:index");
		}
	}

	public function doAdminLogin(){
		$username = I('post.username');
		$password = I('post.password');

		$pwd = md5($password);
		$dao = D('User');
		$info = $dao->where(array('username' => $username, 'password' => $pwd))->find();
		if(!empty($info)){
			$_SESSION['userInfo']['id'] = $info['id'];
			$_SESSION['userInfo']['username'] = $info['username'];
			$_SESSION['userInfo']['type'] = $info['type'];
			$_SESSION['userInfo']['truename'] = $info['truename'];
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
    	if(!empty($_SESSION['userInfo']['id'])){
    		$this->ajaxReturn(array("status"=>1,"user"=>$_SESSION['userInfo']['truename']));
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
		$info = D('User')->where(array('id' => $_SESSION['userInfo']['id']))->find();
		$this->assign('info', $info);
		$this->display();
	}

	//转入修改用户信息页面
	public function modify(){
		$userid = $_SESSION['userInfo']['id'];

		$dao = D('user');
		$userInfo = $dao->where(array('id'=>$userid))->find();
		$this->assign("userInfo",$userInfo);
		$this->display();
	}

	//修改用户信息
	public function doModify(){
		$dao = D('User');
		$sessionUserid = $_SESSION['userInfo']['id'];
		$inputUserid = $_POST['userid'];

		if ($sessionUserid == $inputUserid){
			$_POST['sex'] = urldecode($_POST['sex']);
			$_POST['truename'] = urldecode($_POST['truename']);
			$_POST['company'] = urldecode($_POST['company']);
			$_POST['department'] = urldecode($_POST['department']);
			$_POST['job'] = urldecode($_POST['job']);
			$_POST['email'] = urldecode($_POST['email']);
			$_POST['contact'] = urldecode($_POST['contact']);

			if(empty($_POST['password'])){
				unset($_POST['password']);
			}else{
				$_POST['password'] = md5($_POST['password']);
			}

			$dao->where(array('id'=>$inputUserid))->save($_POST);
		}

		exit('success');
	}

	//增加一个新注册用户
	public function doReg(){
		$dao = D('User');
		$info = $dao->where(array('username' => $_POST['username']))->find();
		//默认添加的都是普通用户
		if(empty($info)){
			$_POST['password'] = md5($_POST['password']);
			$_POST['truename'] = urldecode($_POST['truename']);
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