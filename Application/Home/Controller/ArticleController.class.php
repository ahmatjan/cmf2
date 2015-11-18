<?php
namespace Home\Controller;

class ArticleController extends FrontController {
	
    protected function _initialize() {
		parent::_initialize();
	}
	
	public function folder(){
		$id = $_GET['id'];
		$dao = D('Folder');
		$info = $dao->where(array('id' => $id))->find();
		if($info){
			$this->assign('folder', $info);
			if($info['children'] == ','){
				$folders = $id;
			}else{
				$folders = substr($info['children'], 1) . $id;
			}
			
			$userid = $_SESSION['userInfo']['userid'];
			if (empty($userid))
				$userid = "-1";
			
			$count = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
			$page = new \Think\Page($count);
			$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
			$articles = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.addtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
			$this->assign('articles', $articles);
			$infos = $dao->where(array('parent' => $id))->select();
			$this->assign('pageStr', $page->show());
			if(sizeof($infos) > 0){
				$this->assign('subFolder', $infos);
			}else{
				$this->assign('posts', $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.addtime' => 'desc'))->limit(0, 10)->select());
			}
		}
		$this->display();
	}
	
	public function article(){
		$id = $_GET['id'];
		$dao = D('Article');
		$info = $dao->table('tbl_article a JOIN tbl_user u ON a.adder=u.id JOIN tbl_article_data d ON a.id=d.id')->where(array('a.id' => $id))->field('a.*, u.userid as adduser, d.content')->find();
		$dao->where(array('id' => $id))->save(array('click' => $info['click'] + 1));
		//$info['click']++;
		$this->assign('article', $info);
		$attachments = $dao->table('tbl_attachment')->where(array('article' => $id))->select();
		foreach($attachments as $key => $val){
			$strpos = strrpos($val['attachment'], '.');
			$ext = strtolower(substr($val['attachment'], $strpos + 1));
			if($ext == 'bmp' || $ext == 'jpg' || $ext == 'gif' || $ext == 'png'){
				$attachments[$key]['img'] = 1;
			}
		}
		$this->assign('attachments', $attachments);
		$this->display();
	}
}