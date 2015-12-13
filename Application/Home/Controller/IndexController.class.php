<?php
namespace Home\Controller;

class IndexController extends FrontController {
	
    protected function _initialize() {
		parent::_initialize();
	}
	
	public function index(){
		$this->display();
	}

	//文章分类树
	public function tree(){
		$arr=array();
		$folderDao = D('folder');
		$info = $folderDao->where("parent = 0")->select();

		if ($info){
			for($i =0; $i<count($info); $i++){
				$da = array(
						"id" => $info[$i]['id'],
						"name"=> $info[$i]['name'],
						"url"=> C('webFolder')."article/folder?id=".$info[$i]['id'],
						"target"=>"rightFrame",
						"children"=> $this->SelectSon($info[$i]['id'])
				);
				array_push($arr,$da);
			}
		}
		echo(json_encode($arr));
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
						"url"=> C('webFolder')."article/folder?id=".$info[$i]['id'],
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
	
	
}