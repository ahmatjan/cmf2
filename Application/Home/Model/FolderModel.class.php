<?php
namespace Home\Model;
class FolderModel extends DataModel{
	
	public function getTree($root = 0){
		$info = $this->order(array('`order`' => 'desc'))->select();
		$folders = array();
		$parents = array();
		foreach($info as $val){
			$folders[$val['id']] = $val;
			$parents[$val['parent']][] = $val['id'];
		}
		$this->addToTree($tree, $folders, $parents, $root);
		return $tree;
	}
	
	public function getList($root = 0){
		$info = $this->order(array('`order`' => 'desc'))->select();
		$folders = array();
		$parents = array();
		foreach($info as $val){
			$folders[$val['id']] = $val;
			$parents[$val['parent']][] = $val['id'];
		}
		$this->addToList($list, $folders, $parents, $root);
		return $list;
	}
	
	public function addToTree(&$arr, $folders, $parents, $root, $depth = 0){
		foreach($parents[$root] as $key => $val){
			$folders[$val]['depth'] = $depth;
			$arr[$val] = $folders[$val];
			if(!empty($parents[$val])){
				$this->addToTree($arr[$val]['sub'], $folders, $parents, $val, $depth + 1);
			}
		}
	}
	public function addToList(&$arr, $folders, $parents, $root, $depth = 0){
		foreach($parents[$root] as $key => $val){
			$folders[$val]['depth'] = $depth;
			$arr[] = array('name' => str_repeat('&nbsp;', $depth * 6) . $folders[$val]['name'], 'id' => $val);
			if(!empty($parents[$val])){
				$this->addToList($arr, $folders, $parents, $val, $depth + 1);
			}
		}
	}
}