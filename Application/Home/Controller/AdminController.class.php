<?php
namespace Home\Controller;

import('ORG.Util.Page');

class AdminController extends Base {

	function logout(){
		$_SESSION['userInfo'] = null;
		header("location: " . C('webFolder')."admin");
	}

    protected function _initialize() {
		parent::_initialize();
		$userInfo = I('session.userInfo');

		//如果用户没有登录，则转到后台登陆页面
		if(empty($userInfo['id']) || empty($userInfo['type']))
			header('location: '.C('webFolder').'user/adminLogin');

		//if(empty($_SESSION['userInfo']['id']) || empty($_SESSION['userInfo']['type'])){
		//	header('location: ' . C('webFolder') . 'user/log');
		//}
	}

	public function tree(){
		$arr=array();
		$folderDao = D('folder');
		$info = $folderDao->where("parent = 0")->select();

		if ($info){
			for($i =0; $i<count($info); $i++){
				$da = array(
						"id" => $info[$i]['id'],
						"name"=> $info[$i]['name'],
						"url"=> C('webFolder')."admin"."/article?folder=".$info[$i]['id'],
						"target"=>"rightFrame",
						"children"=> $this->SelectSon($info[$i]['id'])
				);
				array_push($arr,$da);
			}
		}
		echo(json_encode($arr));
	}

	public function index(){
		$this->display();
	}


	private function SelectSon($pid){
		$folderDao=D('folder');
		$info = $folderDao->where("parent=".$pid)->select();
		if ($info){
			$data = array();
			for($i=0; $i<count($info); $i++){
				$da = array(
						"id" => $info[$i]['id'],
						"name"=>$info[$i]['name'],
						"url"=> C('webFolder')."admin"."/article?folder=".$info[$i]['id'],
						"target"=>"rightFrame",
						"children"=>$this->SelectSon($info[$i]['id'])
				);
				array_push($data,$da);
			}
			return $data;
		}else{
			return null;
		}
	}

	private function arrayValuesRecursive($array)
	{
		$temp = array();
		foreach ($array as $key => $value) {
			if (is_numeric($key)) {
				$temp[] = is_array($value) ? $this->arrayValuesRecursive($value) : $value;
			} else {
				$temp[$key] = is_array($value) ? $this->arrayValuesRecursive($value) : $value;
			}
		}

		return $temp;
	}

	//文章分类树
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

	//分类列表
	public function folder(){
		$dao = D('Folder');
		$folders = $dao->getList();
		$this->assign('tree', $folders);
		$this->assign('jsFiles', array('admin/folder.js'));
		$this->display();
	}

	//转入添加分类页面
	public function folderAdd(){
		$this->assign('parent', (int)$_GET['id']);
		$this->assign('jsFiles', array('admin/folder.js'));
		$this->display();
	}

	//添加分类
	public function addFolder(){
		$dao = D('Folder');
		$_POST['name'] = urldecode($_POST['name']);
		$_POST['children'] = ',';
		$newfolderid = $dao->add($_POST);
		if(!empty($_POST['parent'])){
			$info = $dao->where(array('id' => $_POST['parent']))->find();
			if(!empty($info)){
				if(empty($info['parents'])){
					$parents = ',' . $_POST['parent'] . ',';
				}else{
					$parents = $info['parents'] . $_POST['parent'] . ',';
					$dao->execute("UPDATE tbl_folder SET children=CONCAT(children , {$newfolderid}, ',') WHERE id IN (0{$info['parents']}0)");
				}				
				$dao->where(array('id' => $newfolderid))->save(array('parents' => $parents));
				if(empty($info['children'])){
					$dao->where(array('id' => $_POST['parent']))->save(array('children' => $newfolderid));
				}else{
					$dao->where(array('id' => $_POST['parent']))->save(array('children' => $info['children'] . $newfolderid . ','));
				}
			}
		}else{
			$dao->where(array('id' => $newfolderid))->save(array('parents' => ','));
		}
	}

	//转入修改分类名称页面
	public function folderModify(){
		$this->assign('info', D('Folder')->where(array('id' => $_GET['id']))->find());
		$this->assign('jsFiles', array('admin/folder.js'));
		$this->display('folderAdd');
	}

	//修改分类名称
	public function modifyFolder(){
		$dao = D('Folder');
		$_POST['name'] = urldecode($_POST['name']);
		$post = $_POST;
		$id = $post['id'];
		unset($post['id']);
		$dao->where(array('id' => $id))->save($_POST);
	}

	//删除文章分类
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
			$dao->execute("DELETE FROM tbl_article_folder WHERE folder IN ($ids)");
		}
	}

	/////////////////////////////////////////////////////////////后台文章处理系列//////////////////////////////////////////////////////

	//提交审核
	public function manageArticle(){
		$nowtime = date('Y-m-d H:i:s');
		$currentUser = $_SESSION['userInfo']['id'];
		$articleID = I('post.artid');
		$nextAuditor = I('post.auditor');

		$dao = D('ArticleAudit');

		//是否将文章从编辑态转入审核态
		if($_POST['audittype'] == 'true'){
			$post = array();
			$post['article'] = $articleID;
			$post['auditor'] = $currentUser;
			$post['comment'] = $_POST['comment'];
			$post['addtime'] = $nowtime;
			$post['modifytime'] = $nowtime;

			//r1t为1，表示该审核人通过
			if($_POST['rlt']){
				// status: 2:通过申请，1，拒绝申请, 0:处理申请中
				$post['status'] = 2;
				$dao->add($post);

				//判断是否还需要下一位审核人
				if(empty($nextAuditor)){
					//审核文章通过，并且不需要下一个审核人，文章转入发表状态
					$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('audittime' =>$nowtime));
					$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('status' => 3));
				}else{
					//审核文章通过，需要下一个审核人，添加下一位审核人信息
					$post['auditor'] = $nextAuditor;
					$post['status'] = 0;
					$post['comment'] = '';
					$dao->add($post);

					//更新文章下一个审核人信息
					$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('auditor' => $nextAuditor));
					$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('audittime' => $nowtime));
				}
			}else{
				//审核不通过，将文章转回编辑状态
				//文章不通过
				$post['status'] = 1;
				$dao->add($post);
				//文章转会编辑中状态
				$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('status' => 1));
				$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('audittime' => $nowtime));
			}
		}else{
			//文章首次提交给审核人，文章状态由编辑状态转入审核状态。

			//添加审核记录
			$dao->add(array('article' => $articleID, 'auditor' => $nextAuditor, 'addtime' => $nowtime, 'status' => 0));
			//$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('status' => 2));
			//$dao->table('tbl_article')->where(array('id' => $articleID))->save(array('auditor' => $nextAuditor));
			$post = array();
			$post['audittime'] =  date('Y-m-d H:i:s');
			$post['submittime'] = date('Y-m-d H:i:s');
			$post['status'] = 2;
			$post['auditor'] = $nextAuditor;
			//更新文章审计时间
			//更新文章提交时间
			//更新审计人员
			//文章状态转入审核中
			$articleDao = D('article');
			$articleDao->where(array('id' => $articleID))->save($post);
		}
		echo "<script type='text/javascript'>alert('提交成功'); history.go(-1);</script>";
	}

	//后台显示文章列表
	public function article(){
		$this->assign('jsFiles', array('admin/article.js'));

		$dao = D('Article');
		$where = '1';

		$currentUser = $_SESSION['userInfo']['id'];

		//查询约束条件，看是否本人发表的文章
		$adder = I('get.adder',0);
		if(!empty($adder)){
			$where .= " AND a.adder=".$currentUser;
		}

		//查询约束条件，看文章状态，1编辑中，2审核中，3已发布
		$status = I('get.status',0);
		if(!empty($status)){
			$where .= " AND a.status=".$status;
			//假设传入的状态为2，表示要列出待审核的文章，而且该文章是需要当前登录用户来审核的。
			if ($status == 2){
				$where .= " AND a.auditor = ".$currentUser;
			}
		}

		//查询约束条件,文章所属目录
		$folder = I('get.folder',0);
		if(!empty($folder)){
			$info = $dao->table('tbl_folder')->where('id=%d',$folder)->field('children')->find();
			if(!empty($info['children'])){
				$where .= " AND f.folder IN (".substr($info['children'],1).$folder.")";
			}
			$this->assign('folder', $folder);
		}

		//查询约束条件，对于普通会员，只能查询自己所在组的文章，对于管理员，文章审核员，文章编辑则无此限制
		$userType = $_SESSION['userInfo']['type'];
		//判断是普通用户(userType = 0)。文章审核人员为2，文章编辑为1，管理员为4
		if ($userType == 0)
			$where.=" AND a.id in (select distinct tbl_article_group.article from tbl_article_group left join tbl_user_group on tbl_article_group.group = tbl_user_group.group where tbl_user_group.user = ".$currentUser.")";

		//计算文章数量，分页用
		$count = $dao->table('tbl_article a JOIN tbl_article_folder f ON f.article=a.id ')->field('a.id')->where($where)->order('a.updatetime desc')->distinct(true)->count();
		$Page = new \Think\Page($count,30);
		$show = $Page->show();
		$this->assign('page',$show);

		//$info  = $dao->table('tbl_article a JOIN tbl_user u ON u.id=a.adder JOIN tbl_article_group g ON a.id=g.article LEFT JOIN tbl_article_folder f ON f.article=a.id LEFT JOIN (select article, auditer from(select * from tbl_article_audit order by addtime desc) tmp group by article ) au ON au.article=a.id ')->field('a.*, u.userid, au.auditer')->distinct(true)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		//$articles  = $dao->table('tbl_article a JOIN tbl_user u ON u.id=a.adder JOIN tbl_article_group g ON a.id=g.article LEFT JOIN tbl_article_folder f ON f.article=a.id LEFT JOIN (select article, auditor from(select * from tbl_article_audit order by addtime desc) tmp group by article ) au ON au.article=a.id ')->field('a.*, u.userid, au.auditor')->distinct(true)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
		$articles = $dao->table("tbl_article a LEFT JOIN tbl_article_folder f on a.id = f.article")->field("a.*")->distinct(true)->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

		$articleList = array();
		foreach($articles as $article){
			$articleid = $article['id'];

			$folders = $dao->table("tbl_article_folder")->where("article = %d",$articleid)->select();
			$article["folders"] = $folders;

			$groups = $dao->table("tbl_article_group")->where("article = %d", $articleid)->select();
			$article["groups"] = $groups;
			$articleList[] = $article;
		}

		$this->assign('articles', $articleList);

		//设置用户id和用户name的对应
		$userMapping = array();
		$userList = $dao->table("tbl_user")->select();
		foreach($userList as $userval){
			$userMapping[$userval["id"]] = $userval["username"];
		}
		$this->assign("userMapping",$userMapping);

		//设置folder id和名称的对应
		$folderMapping = array();
		$folderList = $dao->table("tbl_folder")->select();
		foreach($folderList as $folderval){
			$folderMapping[$folderval["id"]] = $folderval["name"];
		}
		$this->assign("folderMapping",$folderMapping);

		//设置group id 和名称的对应
		$groupMapping = array();
		$groupList = $dao->table("tbl_group")->select();
		foreach($groupList as $groupval){
			$groupMapping[$groupval["id"]] = $groupval["name"];
		}
		$this->assign("groupMapping",$groupMapping);

		//设置文章状态，文章优先级的id和名称的对应
		$this->assign('statusMapping', array(1 => '编辑中', 2 => '审核中', 3 => '已发布'));
		$this->assign('priorityMapping', array(1=>'一般', 2=>'紧急', 3=>'重要'));

		$auditors = $dao->table('tbl_user')->where('type > 1')->select();
		$this->assign('auditors', $auditors);
		$this->display();
	}

	//查看历史审计记录
	public function seeaudit(){
		$dao = D('ArticleAudit');
		$info = $dao->table('tbl_article_audit a JOIN tbl_user u ON a.auditor=u.id')->field('a.*, u.username')->where(array('article' => $_POST['id']))->select();
		if(empty($info)){
			exit('');
		}else{
			$str = '';
			foreach($info as $val){
				$str .= ",{\"status\": {$val['status']}, \"time\": \"" . ($val['status'] == 0 ? $val['addtime'] : $val['modifytime']) . "\", \"auditor\": \"{$val['username']}\", \"comment\": \"{$val['comment']}\"}";
			}
			echo '[' . substr($str, 1) . ']';
		}
	}

	//转入添加文章页面
	public function articleAdd(){
		$dao = D('Folder');
		$this->assign('folders', $dao->getList());
		$this->assign('groups', $dao->table('tbl_group')->select());
		$this->assign('jsFiles', array('admin/article.js'));
		$this->assign('action', 'addarticle');
		$this->display();
	}

	//转入修改文章界面
	public function articleModify(){
		$this->assign('jsFiles', array('admin/article.js'));

		$dao = D('Folder');
		$articleID = I('get.id');

		$info = $dao->table('tbl_article_data')->where(array('id' => $articleID))->find();
		$article = D('Article')->where(array('id' => $articleID))->find();

		$article['content'] = $info['content'];
		$this->assign('info', $article);
		$this->assign('oldFolders', $dao->table('tbl_article_folder')->where(array('article' => $articleID))->select());
		$this->assign('oldGroups', $dao->table('tbl_article_group')->where(array('article' => $articleID))->select());
		$this->assign('oldAttachments', $dao->table('tbl_attachment')->where(array('article' => $articleID))->select());
		$this->assign('folders', $dao->getList());
		$this->assign('groups', $dao->table('tbl_group')->select());

		$this->assign('action', 'modifyarticle');
		$this->display('articleAdd');
	}

	//添加文章
	public function addArticle(){
		//文章添加人
		$_POST['adder'] = $_SESSION['userInfo']['id'];
		//文章最后更新日期
		$_POST['updatetime'] = date('Y-m-d H:i:s');

		//如果audit为0，则说明不需要审核，如果为1 说明需要审核。默认需要审核。
		$_POST['status'] = $_POST['audit'] ? 1 : 3;

		$content = $_POST['content'];
		$groups = $_POST['group'];
		$folders = $_POST['folder'];
		$fileNames = $_POST['filename'];

		foreach($fileNames as $key => $val){
			if(empty($val))
				$fileNames[$key] = '';
		}

		unset($_POST['content']);
		unset($_POST['group']);
		unset($_POST['folder']);
		unset($_POST['filename']);

		//添加文章本身
		$dao = D('Article');
		$newArticleid = $dao->add($_POST);

		//添加文章，文章内容对应关系
		$array = array('id' => $newArticleid, 'content' => $content, 'rawcontent'=>strip_tags($content));
		D('ArticleData')->add($array);

		//添加文章，可见用户组对应关系
		foreach($groups as $val){
			D('ArticleGroup')->add(array('article' => $newArticleid, 'group' => $val));
		}
		//添加文章，文章分类对应关系
		foreach($folders as $val){
			D('ArticleFolder')->add(array('article' => $newArticleid, 'folder' => $val));
		}

		//添加文章，文章附件对应关系
		$size = sizeof($_FILES['attachment']['name']);
		foreach($_FILES['attachment'] as $key => $val){
			for($i = 0; $i < $size; $i++){
				$files[$i][$key] = $val[$i];
			}
		}

		//添加附件
		foreach($files as $key => $val){
			$fileName = $this->uploadFile($val);
			if(!empty($fileName)){
				D('Attachment')->add(array('article' => $newArticleid, 'name' => $fileNames[$key], 'attachment' => $fileName));
			}
		}

		echo "<script type='text/javascript'>alert('添加成功');history.go(-2);</script>";
	}
	
	private function uploadFile($file){
		//上传附件
		$strpos = strrpos($file['name'], '.');
		$ext = substr($file['name'], $strpos);
		if(empty($ext)) return '';
		$fileName = date('YmdHis') . rand(1, 10000) . $ext;
		$folder = getcwd() . '/upload/' . date('Ymd');
		if(!file_exists($folder)) mkdir($folder);
		copy($file['tmp_name'], $folder . "/" . $fileName);
		return 'upload/' . date('Ymd')  . '/' . $fileName;
	}

	//修改文章
	public function modifyArticle(){

		$id = $_POST['id'];
		$content = $_POST['content'];
		$groups = $_POST['group'];
		$folders = $_POST['folder'];
		$fileNames = $_POST['filename'];
		$oldAttachments = $_POST['oldAttachments'];

		foreach($fileNames as $key => $val){
			if(empty($val))
				$fileNames[$key] = '';
		}

		unset($_POST['group']);
		unset($_POST['folder']);
		unset($_POST['content']);
		unset($_POST['filename']);
		unset($_POST['id']);

		//更新文章修改日期
		$_POST['updatetime'] = date('Y-m-d H:i:s');

		//如果audit为0，则说明不需要审核，如果为1 说明需要审核。默认需要审核。
		$_POST['status'] = $_POST['audit'] ? 1 : 3;

		$dao = D('Article');
		//保存文章主表
		$dao->where(array('id' => $id))->save($_POST);
		//保存文章内容表
		$articleContent = array('content' => $content, 'rawcontent' => strip_tags($content));
		D('ArticleData')->where(array('id' => $id))->save($articleContent);

		//删除文章可被浏览的用户组
		D('ArticleGroup')->where(array('article' => $id))->delete();
		//删除文章所属的目录
		D('ArticleFolder')->where(array('article' => $id))->delete();
		//删除文章附件
		if(sizeof($oldAttachments) == 0 || trim($oldAttachments) == ""){
			D('Attachment')->where(array('article' => $id))->delete();
		}else{
			D('Attachment')->where(" article = {$id} AND id NOT IN (" . implode(',', $oldAttachments) . ')')->delete();
		}
		//重新添加文章可被浏览的用户组
		foreach($groups as $val){
			D('ArticleGroup')->add(array('article' => $id, 'group' => $val));
		}
		//重新添加文章所属目录
		foreach($folders as $val){
			D('ArticleFolder')->add(array('article' => $id, 'folder' => $val));
		}

		//文章附件
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

		//修改成功
		echo "<script type='text/javascript'>alert('修改成功');</script>";


		$this->display("article");
	}

	//删除文章
	public function delArticle(){
		$articleID = I('post.id');
		$delType = I('post.type');
		switch($delType){
			case 'delete':
				//删除文章
				D('Article')->where(array('id' => $articleID))->delete();
				D('ArticleGroup')->where(array('article' => $articleID))->delete();
				D('ArticleFolder')->where(array('article' => $articleID))->delete();
				D('ArticleData')->where(array('id' => $articleID))->delete();
				D('Attachment')->where(array('article' => $articleID))->delete();
				D('ArticleAudit')->where(array('article' => $articleID))->delete();
				break;
			case 'deleteaudit':
				//撤回文章
				D('Article')->where(array('id' => $articleID))->save(array('status' => 1));
				break;
		}
		$this->display("article");
	}

	//////////////////////////////////////////////////////////////////////////////用户组相关函数//////////////////////////////////////////////////////////////////
	//列出所有用户组
	public function group(){
		$this->assign('jsFiles', array('admin/group.js'));

		$dao = D('Group');
		$this->assign('group', $dao->select());

		$this->display();
	}

	//转入添加用户组页面
	public function groupAdd(){
		$this->assign('jsFiles', array('admin/group.js'));
		$this->display();
	}

	//转入修改用户组
	public function groupModify(){
		$this->assign('jsFiles', array('admin/group.js'));
		//得到用户组id参数，默认为-1
		$groupID = I('get.id',0);

		if (empty($groupID)){
			$this->error("请选择正确的用户组");
		}else{
			$dao = D('Group');
			$groupInfo = $dao->where("id = %d",$groupID)->find();

			if(empty($groupInfo)){
				$this->error('没有找到对应的用户组');
			}

			$this->assign('info',$groupInfo);
			$this->display('groupModify');
		}
	}

	//增加一个新的用户组
	public function addGroup(){
		$dao = D('Group');
		$_POST['name'] = urldecode($_POST['name']);
		$dao->add($_POST);
		$this->display("group");
	}

	//修改用户组名称
	public function modifyGroup(){
		$_POST['name'] = urldecode($_POST['name']);
		$post = $_POST;
		$id = $post['id'];
		unset($post['id']);

		$dao = D('Group');
		$dao->where(array('id' => $id))->save($post);

		$this->display("group");
	}

	//删除某个用户组
	public function delGroup(){
		$groupID = I('post.id', 0);

		if (empty($groupID)){
			$this->error("无法找到对应的用户组");
		}

		//删除该组
		D('Group')->where('id=%d',$groupID)->delete();
		//删除用户和组的对应关系
		D('UserGroup')->where('group=%d',$groupID)->delete();
		//删除文章和组的对应关系
		D('ArticleGroup')->where('group=%d',$groupID)->delete();
	}
	////////////////////////////////////////////////////////////////用户组相关函数//////////////////////////////////////////////////////


	////////////////////////////////////////////////////////////////用户权限相关函数/////////////////////////////////////////////////////
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
	//////////////////////////////////////////////////////////////////////////////////////用户权限相关函数///////////////////////////////////////////////


	//列出所有系统管理员
	public function adminList(){
		$this->assign('jsFiles', array('admin/user.js'));
		$this->assign('type', '管理员');

		$dao = D('User');

		$users = $dao->where('type > 0')->select();
		$this->assign('users', $users);

		$info = $dao->table('tbl_usertype')->select();
		foreach($info as $val){
			$types[$val['id']] = $val['name'];
		}
		$this->assign('types', $types);

		$this->display('user');
	}

	///////////////////////////////////////////////////////////////用户相关函数///////////////////////////////////////////////////////////////////
	// 转入添加新用户页面
	public function userAdd(){
		$this->assign('jsFiles', array('admin/user.js'));
		$dao = D('User');
		$types = $dao->table('tbl_usertype')->select();
		$groups = $dao->table('tbl_group')->select();
		$this->assign('types', $types);
		$this->assign('groups', $groups);

		$this->display();
	}

	//转入修改用户界面
	public function userModify(){
		$this->assign('jsFiles', array('admin/user.js'));

		$id = I('get.id',0);

		if (empty($id)){
			$this->error("用户不存在");
		}

		$dao = D('User');

		$user = $dao->where("id=%d",$id)->find();
		$usergroup = $dao->table('tbl_user_group')->where("user=%d",$id)->select();
		$group = array();
		foreach($usergroup as $val){
			$group[] = $val['group'];
		}

		$user['group'] = $group;

		$this->assign('types', $dao->table('tbl_usertype')->select());
		$this->assign('groups', $dao->table('tbl_group')->select());
		$this->assign('info', $user);

		$this->display();
	}

	//列出所有用户
	public function user(){
		$this->assign('jsFiles', array('admin/user.js'));

		$dao = D('User');

		$count = $dao->where()->count();
		$Page = new \Think\Page($count, 20);
		$show = $Page->show();
		$this->assign('page',$show);

		$users = $dao->where()->limit($Page->firstRow.','.$Page->listRows)->select();

		$i = 0;
		foreach ($users as $user)
		{
			$groupids = $dao->field('tbl_user_group.group')->table('tbl_user_group')->where('user = %d',$user['id'])->select();

			$groupnames = '';

			foreach($groupids as $groupid){
				$groupname = $dao->table('tbl_group')->where('id = %d', $groupid)->getField('name');

				$groupnames = $groupnames.$groupname.' ';
			}
			$users[$i]["groupname"] = $groupnames;
			$i++;
		}

		$this->assign('users', $users);

		$info = $dao->table('tbl_usertype')->select();
		foreach($info as $val){
			$types[$val['id']] = $val['name'];
		}

		$this->assign('types', $types);
		$this->display('user');
	}

	//将新用户添加到数据库中
	public function addUser(){
		$dao = D('User');

		//添加用户基本信息
		$post = $_POST;

		$post['username'] = urldecode($post['username']);
		$post['sex'] =urldecode($post['sex']);
		$post['company'] = urldecode($post['company']);
		$post['department'] = urldecode($post['department']);
		$post['job'] = urldecode($post['job']);
		$post['email'] = urldecode($post['email']);
		$post['contact'] = urldecode($post['contact']);
		$post['truename'] =urldecode($post['truename']);
		$post['password'] = md5(urldecode($post['password']));

		$group = $post['group'];

		$id = $dao->add($post);

		//添加用户和用户组对应信息
		if(sizeof($group) > 0){
			$dao = D('UserGroup');
			foreach($group as $val){
				$dao->add(array('user' => $id, 'group' => $val));
			}
		}
	}

	//修改已有用户到数据库中
	public function modifyUser(){
		$post = $_POST;

		$post['sex'] = urldecode($post['sex']);
		$post['company'] = urldecode($post['company']);
		$post['department'] = urldecode($post['department']);
		$post['job'] = urldecode($post['job']);
		$post['email'] = urldecode($post['email']);
		$post['contact'] = urldecode($post['contact']);
		$post['truename'] =urldecode($post['truename']);


		$id = $post['id'];
		$group = $post['group'];

		unset($post['group']);
		unset($post['id']);
		unset($post['username']);

		if(empty($post['password'])){
			unset($post['password']);
		}else{
			$post['password'] = md5(urldecode($post['password']));
		}

		//更新用户信息
		$dao = D('User');
		$dao->where("id=%d",$id)->save($post);

		//修改后删除原有的用户/用户组对应关系
		$dao->table(tbl_user_group)->where("user=%d",$id)->delete();

		//重新添加用户/用户组关系
		if(sizeof($group) > 0){
			$dao = D('UserGroup');
			foreach($group as $val){
				$dao->add(array('user' => $id, 'group' => $val));
			}
		}
	}

	//删除用户
	public function delUser(){
		$userid = I('get.id',0);

		//如果是admin，或者是空则返回
		if (empty($userid) || $userid == 1)
			$this->error("删除失败");

		//删除用户本身
		D('User')->where("id = %d",$userid)->delete();
		//删除用户所属分类
		D('UserGroup')->where("user = %d", $userid)->delete();
		//删除用户的审核记录
		D('ArticleAudit')->where("auditor = %d", $userid)->delete();

		$this->success("删除成功");
	}

	///////////////////////////////////////////////////////////////////用户相关函数//////////////////////////////////////////////////////////////

}