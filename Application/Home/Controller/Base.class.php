<?php
namespace Home\Controller;

use Think\Controller;
class Base extends Controller {
	
    protected function _initialize() {
		session_start();
		header('Content-Type: text/html; charset=utf-8');
		$siteInfo = array(
			'title' => C('WEBNAME'),
			'jsFolder' => C('JSFOLDER'),
			'cssFolder' => C('CSSFOLDER'),
			'uploadFolder' => C('UPLOADFOLDER'),
			'imgFolder' => C('IMGFOLDER'),
			'webFolder' => C('WEBFOLDER'),
		);
		$this->assign('siteInfo', $siteInfo);
		$this->assign('userInfo', $_SESSION['userInfo']);
	}
}