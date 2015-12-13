<?php
	if(!empty($_FILES['upload'])){
		$file =& $_FILES['upload'];
		$strpos = strrpos($file['name'], '.');
		if($strpos >= 0){
			$ext = substr($file['name'], $strpos);
		}
		$folder = date('Ymd');
		$fileName = md5(rand(1, 9999999)) . $ext;
		$root = getcwd() . '/../../upload/' . $folder;
		if(!file_exists($root)){
			mkdir($root);
		}
		copy($file['tmp_name'], $root . '/' . $fileName);
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(2, '/cmf/upload/{$folder}/{$fileName}', '');</script>";
	}