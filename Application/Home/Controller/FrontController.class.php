<?php
namespace Home\Controller;

class FrontController extends Base {
	
    protected function _initialize() {
		$dao = D('Folder');
		$info = $dao->where(array('parent' => 0))->select();
		$this->assign('topFolder', $info);



		parent::_initialize();
	}
	
}