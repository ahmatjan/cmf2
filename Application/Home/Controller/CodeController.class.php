<?php
namespace Home\Controller;

class CodeController extends Base {
	
	public function index(){
		$new_number = "";
		$img_width = 48;
		$img_height = 16;
		$mycharset = array();
		for($i = 0; $i <= 9; $i++) array_push($mycharset,$i);
		for($i = 0; $i < 26; $i++) array_push($mycharset,chr(ord("A")+$i));
		srand(microtime() * 100000);
		for($ti = 0; $ti < 4; $ti++){
			$newnumber = $mycharset[rand(0,35)];
			if($newnumber == "0") $newnumber=1;
			if($newnumber == "o" ||  $newnumber=="O") $newnumber="L";
			$new_number .= $newnumber;
		}
		$new_number = strtoupper($new_number);
		$_SESSION["code"] = $new_number;
		$number_img = imageCreate($img_width, $img_height);
		imagecolorallocate($number_img, 255, 255, 255);
		for($i = 1; $i <= 128; $i++){
			imagestring($number_img,1,mt_rand(1,$img_width),mt_rand(1,$img_height),"*",imagecolorallocate($number_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255)));
		}
		for($i = 0; $i < strlen($new_number); $i++){
			imagestring($number_img,mt_rand(3,5),$i*$img_width/4+mt_rand(1,4),mt_rand(1,$img_height/5), $new_number[$i],imagecolorallocate($number_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
		}
		header('Content-Type: image/jpeg');
		imagepng($number_img);
		imagedestroy($number_img);
	}
}