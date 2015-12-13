<?php
namespace Home\Controller;

class ArticleController extends FrontController {
	
    protected function _initialize() {
		parent::_initialize();
	}

	public function folder(){
		$id = I("get.id",0);

		$userid = $_SESSION['userInfo']['id'];
		if (empty($userid))
			$userid = "-1";

		//0为普通用户，1，2，4为后台用户
		$usertype = $_SESSION['userInfo']['type'];

		$dao = D('Folder');
		$info = $dao->where("id = %d",$id)->find();

		//目录名字
		if($info){
			$this->assign('folder', $info);

			if($info['children'] == ','){
				$folders = $id;
				//叶子节点
			}else{
				$folders = substr($info['children'], 1) . $id;
				//非叶子节点
			}

			if($usertype > 0){
				//后台用户，可以查看所有文章
				$count    = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id')->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
				$page = new \Think\Page($count);
				$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
				$articles = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id')->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
			}else{
				//普通用户，只能查看自己所属分类的文章
				$count    = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user='.$userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
				$page = new \Think\Page($count);
				$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
				$articles = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user='.$userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
			}
			$this->assign('folderName',$info['name']);
			$this->assign('articles', $articles);
			$this->assign('pageStr', $page->show());
		}else{
			if ($usertype > 0){
				//后台用户，可以查看所有文章
				$count = $dao->table('tbl_article a')->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
				$page = new \Think\Page($count);
				$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
				$articles = $dao->table('tbl_article a')->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
			}else{
				//普通用户，只能查看自己所属分类的文章
				$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
				$page = new \Think\Page($count);
				$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
				$this->assign('folderName','首页');
			}
			$this->assign('folderName',"首页");
			$this->assign('articles', $articles);
			$this->assign('pageStr', $page->show());
		}
		$this->display();
	}
	
	public function article(){
		$id = $_GET['id'];
		$dao = D('Article');
		$articleInfo = $dao->table('tbl_article a JOIN tbl_user u ON a.adder=u.id JOIN tbl_article_data d ON a.id=d.id')->where(array('a.id' => $id))->field('a.*, u.username as adduser, d.content')->find();
		$dao->where(array('id' => $id))->save(array('click' => $articleInfo['click'] + 1));
		//$info['click']++;
		$this->assign('article', $articleInfo);
		$attachments = $dao->table('tbl_attachment')->where(array('article' => $id))->select();
		foreach($attachments as $key => $val){
			$strpos = strrpos($val['attachment'], '.');
			$ext = strtolower(substr($val['attachment'], $strpos + 1));
			if($ext == 'bmp' || $ext == 'jpg' || $ext == 'gif' || $ext == 'png'){
				$attachments[$key]['img'] = 1;
			}
		}
		$this->assign('attachments', $attachments);

		$this->assign('folderName',"");
		$folderids = $dao->table('tbl_article_folder')->where(array('article'=>$id))->select();
		if (count($folderids) > 0){
			$folderid = $folderids[0]['folder'];

			if (!empty($folderid)){
				$folderInfo = $dao->table('tbl_folder')->where(array('id'=>$folderid))->find();
				if (!empty($folderInfo)){
					$this->assign('folderName',$folderInfo['name']);
				}
			}
		}


		$this->display();
	}

	public function advSearch(){
		$searchType = $_GET['mySle'];
		$keyword = $_GET['keyword'];


		switch($searchType) {
			case 0: //根据标题搜索
				$articles = $this->getArticlesByTitle($keyword);
				$this->assign('articles', $articles);
				break;
			case 1: //根据关键字搜索
				$articles = $this->getArticlesByKeyword($keyword);
				$this->assign('articles', $articles);
				break;
			case 2: //根据作者搜索
				$articles = $this->getArticlesByAuthor($keyword);
				$this->assign('articles',$articles);
				break;
			case 3: //根据摘要搜索
				$articles = $this->getArticlesByAbstract($keyword);
				$this->assign('articles', $articles);
				break;
			case 4: //根据内容搜索
				$articles = $this->getArticlesByContent($keyword);
				$this->assign('articles', $articles);
				break;
			case 5: //根据目录搜索
				$articles = $this->getArticlesByFolderName($keyword);
				$this->assign('articles', $articles);
				break;
			case 6: //根据附件搜索
				$articles = $this->getArticlesByAttachment($keyword);
				$this->assign('articles', $articles);
				break;
			case 7: //根据表格搜索
				$articles = $this->getArticlesByChart($keyword);
				$this->assign('articles',$articles);

				break;
			default:
				$articles = $this->getArticlesByTitle($keyword);
				$this->assign('articles',$articles);
		}

		$this->assign('keyword', $keyword);

		if ($searchType == 7)
			$this->display("charts");
		else
			$this->display("folder");
	}

	private function getArticlesByTitle($titleName = "")
	{
		$dao = D('Article');
		$map['status'] = array('EQ',3);
		$map['title'] = array('LIKE', '%'.$titleName.'%');

		//当前登录用户
		$userid = $_SESSION['userInfo']['id'];
		//用户类型，如果>0表示为后台用户
		$userType = $_SESSION['userInfo']['type'];

		if (empty($userid))
			$userid = "-1";

		if ($userType > 0)
		{
			$count  = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("id = -1")->select();
		}else{
			$count  = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("id = -1")->select();
		}

		return $articles;
	}

	private function getArticlesByKeyword($keyword = ""){
		$dao = D('Article');
		$map['status'] = array('EQ',3);
		$map['keywords'] = array('LIKE', '%'.$keyword.'%');

		$userid = $_SESSION['userInfo']['id'];
		$userType = $_SESSION['userInfo']['type'];

		if (empty($userid))
			$userid = "-1";

		if ($userType > 0){
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("tbl_article.id = -1")->select();
		}else{
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("tbl_article.id = -1")->select();
		}

		return $articles;
	}

	private function getArticlesByAuthor($author = ""){
		$dao = D('Article');
		$map['status'] = array('EQ',3);
		$map['author'] = array('LIKE', '%'.$author.'%');

		$userid = $_SESSION['userInfo']['id'];
		$userType = $_SESSION['userInfo']['type'];
		if (empty($userid))
			$userid = "-1";

		if ($userType > 0){
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("tbl_article.id = -1")->select();
		}else{
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("tbl_article.id = -1")->select();
		}
		return $articles;
	}

	private function getArticlesByAbstract($abstract = "")
	{
		$dao = D('Article');
		$map['status'] = array('EQ',3);
		$map['abstract'] = array('LIKE', '%'.$abstract.'%');

		$userid = $_SESSION['userInfo']['id'];
		$userType = $_SESSION['userInfo']['type'];

		if (empty($userid))
			$userid = "-1";

		if ($userType > 0){
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id')->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("tbl_article.id = -1")->select();
		}else{
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where($map)->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("tbl_article.id = -1")->select();
		}

		return $articles;
	}

	private function getArticlesByContent($content = ""){
		$dao = D('Article');
		$map['status'] = array('EQ',3);

		$userid = $_SESSION['userInfo']['id'];
		$userType = $_SESSION['userInfo']['id'];

		if (empty($userid))
			$userid = "-1";

		if ($userType > 0){
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id ')->where("a.status = 3 and a.id in (select id from tbl_article_data where rawcontent like '%".$content."%')")->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id ')->where("a.status = 3 and a.id in (select id from tbl_article_data where rawcontent like '%".$content."%')")->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("id = -1")->select();

		}else{
			$count = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where("a.status = 3 and a.id in (select id from tbl_article_data where rawcontent like '%".$content."%')")->field('a.*')->distinct(true)->count();
			if ($count > 0)
				$articles = $dao->table('tbl_article a JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where("a.status = 3 and a.id in (select id from tbl_article_data where rawcontent like '%".$content."%')")->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->select();
			else
				$articles = $dao->where("id = -1")->select();

		}
		return $articles;
	}

	private function getArticlesByFolderName($name = "")
	{
		$dao = D('Folder');
		$info = $dao->where(array('name' => $name))->find();

		$id = -1;
		if ($info){
			$id = $info['id'];
		}

		if ($info){
			if($info['children'] == ','){
				$folders = $id;
			}else{
				$folders = substr($info['children'], 1) . $id;
			}
		}

		$userid = $_SESSION['userInfo']['id'];
		$userType = $_SESSION['userInfo']['type'];

		if (empty($userid))
			$userid = "-1";

		if ($userType > 0){
			$count = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id ')->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
			$page = new \Think\Page($count);
			$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
			$articles = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id ')->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
		}else{
			$count = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->count();
			$page = new \Think\Page($count);
			$page->setUrl('folder?id=' . $id . '&p=' . urlencode('[PAGE]'));
			$articles = $dao->table('tbl_article a JOIN tbl_article_folder f on f.article=a.id AND f.folder IN (' . $folders . ') JOIN tbl_article_group g ON g.article=a.id JOIN tbl_user_group ug ON ug.group=g.group and ug.user=' . $userid)->where(array('a.status' => 3))->field('a.*')->distinct(true)->order(array('a.publishtime' => 'desc'))->limit($page->firstRow, $page->listRows)->select();
		}
		return $articles;
	}

	private function getArticlesByAttachment($keywords = ""){
		$articles = array();
		return $articles;
	}

	private function getArticlesByChart($keywords = ""){
		$articles = array();
		return $articles;
	}
}