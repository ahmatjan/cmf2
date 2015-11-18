<?php
namespace Home\Controller;

class AdminController extends Base {
	
    protected function _initialize() {
		parent::_initialize();
		if(empty($_SESSION['userInfo']['userid']) || empty($_SESSION['userInfo']['type'])){
			header('location: ' . C('webFolder') . 'user/log');
		}
	}
	
	public function index(){
		$folders = D('Folder')->getTree();
		$this->assign('treeStr', $this->writeTree($folders));
		$this->assign('jsFiles', array('admin/index.js'));
		$this->display();
	}
	
	private function writeTree($array, $depth = 0){
		$str = '';
		$str .= '<ul' . (empty($depth) ? " id='tree'" : '') . '>';
		foreach($array as $val){
			$str .= '<li>';
			if(isset($val['sub'])){
				$str .= str_repeat('&nbsp;', $depth * 6) . '<i class="close"></i><a href="' . C('webFolder') . 'admin/article?folder=' . $val['id'] . '" target="rightFrame">' . $val['name'] . '</a>';$str .= $this->writeTree($val['sub'], $depth + 1);
			}else{
				$str .= str_repeat('&nbsp;', $depth * 6) . '<i></i><a href="' . C('webFolder') . 'admin/article?folder=' . $val['id'] . '" target="rightFrame">' . $val['name'] . '</a>';
			}
			$str .= '</li>';
		}
		$str .= '</ul>';
		return $str;
	}
	
	public function folder(){
		$dao = D('Folder');
		$folders = $dao->getList();
		$this->assign('tree', $folders);
		$this->assign('jsFiles', array('admin/folder.js'));
		$this->display();
	}
	
	public function folderAdd(){
		$this->assign('parent', (int)$_GET['id']);
		$this->assign('jsFiles', array('admin/folder.js'));
		$this->display();
	}
	
	public function addFolder(){
		$dao = D('Folder');
		$_POST['name'] = urldecode($_POST['name']);
		$_POST['children'] = ',';
		$id = $dao->add($_POST);
		if(!empty($_POST['parent'])){
			$info = $dao->where(array('id' => $_POST['parent']))->find();
			if(!empty($info)){
				if(empty($info['parents'])){
					$parents = ',' . $_POST['parent'] . ',';
				}else{
					$parents = $info['parents'] . $_POST['parent'] . ',';
					$dao->execute("UPDATE tbl_folder SET children=CONCAT(children , {$id}, ',') WHERE id IN (0{$info['parents']}0)");
				}				
				$dao->where(array('id' => $id))->save(array('parents' => $parents));
				if(empty($info['children'])){
					$dao->where(array('id' => $_POST['parent']))->save(array('children' => $id));
				}else{
					$dao->where(array('id' => $_POST['parent']))->save(array('children' => $info['children'] . $id . ','));
				}
			}
		}else{
			$dao->where(array('id' => $id))->save(array('parents' => ','));
		}
	}
	public function folderModify(){
		$this->assign('info', D('Folder')->where(array('id' => $_GET['id']))->find());
		$this->assign('jsFiles', array('admin/folder.js'));
		$this->display('folderAdd');
	}
	
	public function modifyFolder(){
		$dao = D('Folder');
		$_POST['name'] = urldecode($_POST['name']);
		$post = $_POST;
		$id = $post['id'];
		unset($post['id']);
		$dao->where(array('id' => $id))->save($_POST);
	}
	
	public function delFolder(){
		$dao = D('Folder');
		$info = $dao->where(array('id' => $_POST['id']))->find();
		if(!empty($info)){
			$ids = $info['children'] == ',' ? $_POST['id'] : (substr($info['children'], 1) . $_POST['id']);
			$str = 'children';
			foreach(explode(',', $ids) as $val){
				$str = "Replace({$str},',{$val},', ',')";
			}
			$dao->execute("UPDATE tbl_folder SET children={$str}");
			$dao->execute("DELETE FROM tbl_folder WHERE id IN ($ids)");
		}
	}
	
	public function manageArticle(){
		$nowtime = date('Y-m-d H:i:s');
		if($_POST['audittype'] == 'true'){
			$dao = D('ArticleAudit');
			$info = $dao->where(array('auditer' => $_SESSION['userInfo']['userid'], 'article' => $_POST['artid']))->order(array('id' => 'desc'))->find();
			if($info){
				if($_POST['rlt']){
					$dao->where(array('id' => $info['id']))->save(array(
						'status' => 2,
						'modifytime' => $nowtime,
						'comment' => $_POST['comment']
					));
					if(empty($_POST['auditer'])){
						$dao->table('tbl_article')->where(array('id' => $_POST['artid']))->save(array('status' => 3));
					}else{
						$dao->add(array('article' => $_POST['artid'], 'auditer' => $_POST['auditer'], 'addtime' => date('Y-m-d H:i:s')));
					}
				}else{
					$dao->where(array('id' => $info['id']))->save(array(
						'status' => 1,
						'modifytime' => $nowtime,
						'comment' => $_POST['comment']
					));
					$dao->table('tbl_article')->where(array('id' => $_POST['artid']))->save(array('status' => 0));
				}
			}
		}else{
			$dao = D('ArticleAudit');
			$dao->add(array('article' => $_POST['artid'], 'auditer' => $_POST['auditer'], 'addtime' => date('Y-m-d H:i:s')));
			$dao->table('tbl_article')->where(array('id' => $_POST['artid']))->save(array('status' => 1));
		}
		echo "<script type='text/javascript'>alert('提交成功'); history.go(-1);</script>";
	}
	
	public function article(){
		$dao = D('Article');
		$where = '1';
		$this->assign('jsFiles', array('admin/article.js'));
		if(!empty($_GET['adder'])){
			$where .= " AND a.adder=" . $_SESSION['userInfo']['userid'];
		}
		if(!empty($_GET['status'])){
			$where .= " AND a.status={$_GET['status']}";
		}
		if(!empty($_GET['folder'])){
			$info = $dao->table('tbl_folder')->where(array('id' => $_GET['folder']))->field('children')->find();
			if(!empty($info['children'])){
				$where .= " AND f.folder IN (" . substr($info['children'],1) . "{$_GET['folder']})";
			}
			$this->assign('folder', $_GET['folder']);
		}
		$count = $dao->table('tbl_article a JOIN tbl_user u ON u.id=a.adder JOIN tbl_article_group g ON a.id=g.article=a.id LEFT JOIN tbl_article_folder f ON f.article=a.id')->field('a.*')->distinct(true)->where($where)->count();
		$page = new \Think\Page($count);
		$info = $dao->table('tbl_article a JOIN tbl_user u ON u.id=a.adder JOIN tbl_article_group g ON a.id=g.article LEFT JOIN tbl_article_folder f ON f.article=a.id LEFT JOIN (select article, auditer from(select * from tbl_article_audit order by addtime desc) tmp group by article ) au ON au.article=a.id ')->field('a.*, u.userid, au.auditer')->distinct(true)->where($where)->select();
		$this->assign('articles', $info);
		$this->assign('statuses', array(0 => '未提交', 1 => '已提交', 3 => '已发布'));
		$admins = $dao->table('tbl_user')->where('type > 1')->select();
		$this->assign('admins', $admins);
		$this->display();
	}
	
	public function seeaudit(){
		$dao = D('ArticleAudit');
		$info = $dao->table('tbl_article_audit a JOIN tbl_user u ON a.auditer=u.id')->field('a.*, u.userid')->where(array('article' => $_POST['id']))->select();
		if(empty($info)){
			exit('');
		}else{
			$str = '';
			foreach($info as $val){
				$str .= ",{\"status\": {$val['status']}, \"time\": \"" . ($val['status'] == 0 ? $val['addtime'] : $val['modifytime']) . "\", \"auditer\": \"{$val['userid']}\", \"comment\": \"{$val['comment']}\"}";
			}
			echo '[' . substr($str, 1) . ']';
		}
	}
	
	public function articleAdd(){
		$dao = D('Folder');
		$this->assign('folders', $dao->getList());
		$this->assign('groups', $dao->table('tbl_group')->select());
		$this->assign('jsFiles', array('admin/article.js'));
		$this->assign('action', 'addarticle');
		$this->display();
	}
	
	public function addArticle(){
		$dao = D('Article');
		$_POST['addtime'] = date('Y-m-d H:i:s');
		$_POST['adder'] = $_SESSION['userInfo']['userid'];
		$_POST['status'] = $_POST['audit'] ? 0 : 3;
		$data = $_POST['content'];
		$groups = $_POST['group'];
		$folders = $_POST['folder'];
		$fileNames = $_POST['filename'];
		foreach($fileNames as $key => $val){
			if(empty($val)) $fileNames[$key] = '';
		}
		unset($_POST['group']);
		unset($_POST['folder']);
		unset($_POST['content']);
		unset($_POST['filename']);
		$id = $dao->add($_POST);
		$array = array('id' => $id, 'content' => $data);
		D('ArticleData')->add($array);
		foreach($groups as $val){
			D('ArticleGroup')->add(array('article' => $id, 'group' => $val));
		}
		foreach($folders as $val){
			D('ArticleFolder')->add(array('article' => $id, 'folder' => $val));
		}
		$size = sizeof($_FILES['attachment']['name']);
		foreach($_FILES['attachment'] as $key => $val){
			for($i = 0; $i < $size; $i++){
				$files[$i][$key] = $val[$i];
			}
		}
		foreach($files as $key => $val){
			$fileName = $this->uploadFile($val);
			if(!empty($fileName)){
			D('Attachment')->add(array('article' => $id, 'name' => $fileNames[$key], 'attachment' => $fileName));
			}
		}
		echo "<script type='text/javascript'>alert('添加成功'); history.go(-2);</script>";
	}
	
	private function uploadFile($file){
		$strpos = strrpos($file['name'], '.');
		$ext = substr($file['name'], $strpos);
		if(empty($ext)) return '';
		$fileName = date('YmdHis') . rand(1, 10000) . $ext;
		$folder = getcwd() . '/upload/' . date('Ymd');
		if(!file_exists($folder)) mkdir($folder);
		copy($file['tmp_name'], $folder . "/" . $fileName);
		return 'upload/' . date('Ymd')  . '/' . $fileName;
	}
	
	public function articleModify(){
		$dao = D('Folder');
		$info = $dao->table('tbl_article_data')->where(array('id' => $_GET['id']))->find();
		$article = D('Article')->where(array('id' => $_GET['id']))->find();
		$article['content'] = $info['content'];
		$this->assign('info', $article);
		$this->assign('oldFolders', $dao->table('tbl_article_folder')->where(array('article' => $_GET['id']))->select());
		$this->assign('oldGroups', $dao->table('tbl_article_group')->where(array('article' => $_GET['id']))->select());
		$this->assign('oldAttachments', $dao->table('tbl_attachment')->where(array('article' => $_GET['id']))->select());
		$this->assign('folders', $dao->getList());
		$this->assign('groups', $dao->table('tbl_group')->select());
		$this->assign('jsFiles', array('admin/article.js'));
		$this->assign('action', 'modifyarticle');
		$this->display('articleAdd');
	}
	
	public function modifyArticle(){
		$dao = D('Article');
		$id = $_POST['id'];
		$data = $_POST['content'];
		$groups = $_POST['group'];
		$folders = $_POST['folder'];
		$fileNames = $_POST['filename'];
		$oldAttachments = $_POST['oldAttachments'];
		foreach($fileNames as $key => $val){
			if(empty($val)) $fileNames[$key] = '';
		}
		unset($_POST['group']);
		unset($_POST['folder']);
		unset($_POST['content']);
		unset($_POST['filename']);
		unset($_POST['id']);
		$dao->where(array('id' => $id))->save($_POST);
		$array = array('content' => $data);
		D('ArticleData')->where(array('id' => $id))->save($array);
		D('ArticleGroup')->where(array('article' => $id))->delete();
		D('ArticleFolder')->where(array('article' => $id))->delete();
		if(sizeof($oldAttachments) == 0){
			D('Attachment')->where(array('article' => $id))->delete();
		}else{
			D('Attachment')->where(" article = {$id} AND id NOT IN (" . implode(',', $oldAttachments) . ')')->delete();
		}
		foreach($groups as $val){
			D('ArticleGroup')->add(array('article' => $id, 'group' => $val));
		}
		foreach($folders as $val){
			D('ArticleFolder')->add(array('article' => $id, 'folder' => $val));
		}
		$size = sizeof($_FILES['attachment']['name']);
		foreach($_FILES['attachment'] as $key => $val){
			for($i = 0; $i < $size; $i++){
				$files[$i][$key] = $val[$i];
			}
		}
		foreach($files as $key => $val){
			$fileName = $this->uploadFile($val);
			if(!empty($fileName)){
			D('Attachment')->add(array('article' => $id, 'name' => $fileNames[$key], 'attachment' => $fileName));
			}
		}
		echo "<script type='text/javascript'>alert('修改成功'); history.go(-1);</script>";
	}
	
	public function delArticle(){
		switch($_POST['type']){
			case 'delete':
				D('Article')->where(array('id' => $_POST['id']))->delete();
				break;
			case 'deleteaudit':
				D('Article')->where(array('id' => $_POST['id']))->save(array('status' => 0));
				break;
		}
	}
	
	
	public function group(){
		$dao = D('Group');
		$this->assign('group', $dao->select());
		$this->assign('jsFiles', array('admin/group.js'));
		$this->display();
	}
	
	public function groupAdd(){
		$this->assign('jsFiles', array('admin/group.js'));
		$this->display();
	}
	
	public function addGroup(){
		$dao = D('Group');
		$_POST['name'] = urldecode($_POST['name']);
		$dao->add($_POST);
		echo $dao->getLastSql();
	}
	public function groupModify(){
		$this->assign('info', D('Group')->where(array('id' => $_GET['id']))->find());
		$this->assign('jsFiles', array('admin/group.js'));
		$this->display('groupAdd');
	}
	
	public function modifyGroup(){
		$dao = D('Group');
		$_POST['name'] = urldecode($_POST['name']);
		$post = $_POST;
		$id = $post['id'];
		unset($post['id']);
		$dao->where(array('id' => $id))->save($_POST);
	}
	
	public function delGroup(){
		D('Group')->where(array('id' => $_POST['id']))->delete();
	}
	
	
	public function user(){
		$dao = D('User');
		$users = $dao->where(array('type' => '0'))->select();
		$this->assign('jsFiles', array('admin/user.js'));
		$this->assign('users', $users);
		$this->assign('type', '会员');
		$info = $dao->table('tbl_usertype')->select();
		foreach($info as $val){
			$types[$val['id']] = $val['name'];
		}
		$this->assign('types', $types);
		$this->display('user');
	}
	
	public function modifyUser(){
		$dao = D('User');
		$post = $_POST;
		$post['nick'] =urldecode($post['nick']);
		$post['truename'] =urldecode($post['truename']);
		$id = $post['id'];
		$group = $post['group'];
		unset($post['group']);
		unset($post['id']);
		if(empty($post['password'])){
			unset($post['password']);
		}else{
			$post['password'] = md5($post['password']);
		}
		$dao->where(array('id' => $id))->save($post);
		$dao->execute("DELETE FROM tbl_user_group WHERE user='{$id}'");
		if(sizeof($group) > 0){
			$dao = D('UserGroup');
			foreach($group as $val){
				$dao->add(array('user' => $id, 'group' => $val));
			}
		}
	}
	
	public function delUser(){
		D('User')->where(array('id' => $_POST['id']))->delete();
	}
	
	public function type(){
		$dao = D('Type');
		$this->assign('jsFiles', array('admin/type.js'));
		$this->assign('type', $dao->select());
		$this->display();
	}
		
	public function typeAdd(){
		$this->assign('folder', (int)$_GET['id']);
		$this->assign('jsFiles', array('admin/type.js'));
		$this->display();
	}
	
	public function addType(){
		$dao = D('Type');
		$_POST['name'] = urldecode($_POST['name']);
		$dao->add($_POST);
	}
	public function typeModify(){
		$this->assign('info', D('Type')->where(array('id' => $_GET['id']))->find());
		$this->assign('jsFiles', array('admin/type.js'));
		$this->display('typeAdd');
	}
	
	public function modifyType(){
		$dao = D('Type');
		$_POST['name'] = urldecode($_POST['name']);
		$post = $_POST;
		$id = $post['id'];
		unset($post['id']);
		$dao->where(array('id' => $id))->save($_POST);
	}
	
	public function delType(){
		D('Type')->where(array('id' => $_POST['id']))->delete();
	}

	public function admin(){
		$dao = D('User');
		$this->assign('jsFiles', array('admin/user.js'));
		$users = $dao->where('type > 0')->select();
		$this->assign('jsFiles', array('admin/user.js'));
		$this->assign('users', $users);
		$this->assign('type', '管理员');
		$info = $dao->table('tbl_usertype')->select();
		foreach($info as $val){
			$types[$val['id']] = $val['name'];
		}
		$this->assign('types', $types);
		$this->display('user');
	}
	
	public function userModify(){
		$dao = D('User');
		$this->assign('jsFiles', array('admin/user.js'));
		$user = $dao->where(array('id' => $_GET['id']))->find();
		$info = $dao->table('tbl_user_group')->where(array('user' => $_GET['id']))->select();
		$group = array();
		foreach($info as $val){
			$group[] = $val['group'];
		}
		$user['group'] = $group;
		$this->assign('types', $dao->table('tbl_usertype')->select());
		$this->assign('groups', $dao->table('tbl_group')->select());
		$this->assign('info', $user);
		$this->display('userAdd');
	}
	
	public function delAdmin(){
		D('User')->where(array('id' => $_POST['id']))->save(array('id' => 0));
	}	
	
}