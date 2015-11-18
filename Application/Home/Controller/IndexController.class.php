<?php
namespace Home\Controller;

class IndexController extends FrontController {
	
    protected function _initialize() {
		parent::_initialize();
	}
	
	public function index(){
		$dao = D('Folder');
		$folders = $dao->where(array('parent' => 0))->select();
		foreach($folders as $key => $val){
			if($val['children'] == ','){
				$f = $val['id'];
			}else{
				$f = substr($val['children'], 1) . $val['id'];
			}
			$folders[$key]['articles'] = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $f . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . (int)$_SESSION['userInfo']['userid'])->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.addtime' => 'desc'))->limit(0, 10)->select();
		}
		$this->assign('topFolders', $folders);
		$this->display();
	}
}