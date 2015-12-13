<?php
error_reporting(7);
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>软件浏览器</title>
<link href='/cmf/static/css/base_2.css' rel='stylesheet' type='text/css'>
<style>
.linerow {border-bottom: 1px solid #CBD8AC;}
.napisdiv {left:40;top:3;width:150px;height:100px;position:absolute;z-index:3;display:none;}
</style>
<script>
function nullLink(){ return; }
function ChangeImage(surl){ document.getElementById('picview').src = surl; }
</script>
</head>
<body background='img/allbg.gif' leftmargin='0' topmargin='0'>
<div id="floater" class="napisdiv">
<a href="javascript:nullLink();" onClick="document.getElementById('floater').style.display='none';"><img src='img/picviewnone.gif' id='picview' border='0' alt='单击关闭预览'></a>
</div>
<SCRIPT language=JavaScript src="js/float.js"></SCRIPT>
<SCRIPT language='JavaScript'>
function nullLink()
{
	return;
}

function ReturnValue(reimg)
{

	 
    var funcNum = 2;
	if(window.opener.CKEDITOR != null && funcNum != 1)
	{
		
		window.opener.CKEDITOR.tools.callFunction(funcNum, reimg);
		
	}
	window.close();
}
</SCRIPT>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align="center">
<tr>
<td colspan='4' align='right'>
<table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CBD8AC'>
<tr bgcolor='#FFFFFF'>
<td colspan='4'>
<table width='100%' border='0' cellspacing='0' cellpadding='2'>
<tr bgcolor="#CCCCCC">
<td width="8%" align="center" class='linerow' bgcolor='#EEF4EA'><strong>预览</strong></td>
<td width="47%" align="center" background="img/wbg.gif" class='linerow'><strong>点击名称选择图片</strong></td>
<td width="15%" align="center" bgcolor='#EEF4EA' class='linerow'><strong>文件大小</strong></td>
<td width="30%" align="center" background="img/wbg.gif" class='linerow'><strong>最后修改时间</strong></td>
</tr>
<?php
$path = isset($_GET['activepath']) ? urldecode($_GET['activepath']) : '';
$strpos = strrpos($path, '/');
if($strpos >= 0){
	$parentdir = substr($path, 0, $strpos);
}else{
	$parentdir = '';
}
$line = "\n<tr>
   <td class='linerow' colspan='2'>
   <a href='select_soft.php?activepath=". $parentdir ."'><img src=img/dir2.gif border=0 width=16 height=16 align=absmiddle>上级目录</a></td>
   <td colspan='2' class='linerow'> 当前目录:{$path}</td>
   </tr>";
        echo $line;
$folder = getcwd() . '/../../upload' . $path;
$dir = opendir($folder);
while($buffer = readdir($dir)){
	if($buffer != '.' && $buffer != '..'){
		$fileName = $folder . "/{$buffer}";
		$fileName2 = $path . "/{$buffer}";
		if(is_dir($fileName)){
			if(preg_match("#^_(.*)$#i", $buffer)) continue; #屏蔽FrontPage扩展目录和linux隐蔽目录
			if(preg_match("#^\.(.*)$#i", $buffer)) continue;
		    $line = "\n<tr>
   <td bgcolor='#F9FBF0' class='linerow' colspan='2'>
		<a href='select_soft.php?activepath=".urlencode($fileName2) . "'><img src=img/dir.gif border=0 width=16 height=16 align=absmiddle>{$buffer}</a></td>
   <td class='linerow'>　</td>
   <td bgcolor='#F9FBF0' class='linerow'>　</td>
   </tr>";
			echo $line;	
		}else if(preg_match("#\.(zip|rar|tar\.gz)#i", $buffer)){
			$filesize = round(filesize($fileName) / 1000, 1);
			$filetime = date('Y-m-d H:i:s', filemtime($fileName));
			$line = "\n<tr>
	   <td align='center' class='linerow' bgcolor='#F9FBF0'>
	   <img src='img/picviewnone.gif' width='16' height='16' border='0' align=absmiddle>
	   </td>
	   <td class='linerow' bgcolor='#F9FBF0'>
	   <a href=\"javascript:ReturnValue('{$fileName2}');\"><img src=img/zip.gif border=0 width=16 height=16 align=absmiddle>{$buffer}</a>
	   <a href='/cmf/upload{$fileName2}' target='_blank'>预览</a></td>
	   <td class='linerow'>{$filesize} KB</td>
	   <td align='center' class='linerow' bgcolor='#F9FBF0'>{$filetime}</td>
	   </tr>";
			echo $line;
		}
	} 
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>