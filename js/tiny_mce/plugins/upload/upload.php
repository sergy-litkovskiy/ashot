<?php
/*include_once('config.php');*/

//session_start();

$type = $_REQUEST['type'];
$check_upload = false;
$file_name = '';
$screen_max = 200;

$upload_path = '/img/upload_tiny/';

$upload_dir = '../../../../img/upload_tiny/';

$upload_url = "http://".$_SERVER["SERVER_NAME"].$upload_path."";


if (!in_array($type,array('image','media','file'))) 

$type = 'file';

if (isset($_FILES["userfile"]) ) {
	if ( is_dir($upload_dir) ) {
		$file_tmp = $_FILES['userfile']['tmp_name'];
		$file_name = $_FILES["userfile"]["name"];

		if (!file_exists($upload_dir.$file_name)) {
			
			if (is_uploaded_file($file_tmp)) {
				
				if ( move_uploaded_file($file_tmp, $upload_dir.$file_name) ) {
					$check_upload = true;
				}
			}
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>Загрузка файла</title>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<meta http-equiv="Pragma" content="no-cache"/>

<script type="text/javascript" src="../../tiny_mce_popup.js"></script>
<script>
function selectURL(url) {
	document.passform.fileurl.value = url;
	FileBrowserDialogue.mySubmit();
}
var FileBrowserDialogue = {
	init : function () { },
	mySubmit : function () {
		var URL = document.passform.fileurl.value;
		var win = tinyMCEPopup.getWindowArg("window");
		win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;
		if (typeof(win.ImageDialog) != "undefined") {
			if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
			if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(URL);
		}
		tinyMCEPopup.close();
	}
}

tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
</script>
</head>
<body>
<div class="tabs">
<ul>
	<li id="general_tab" class="current"><span>Загрузка <?php echo $type; ?></span></li>
</ul>
</div>
<form name="passform"><input name="fileurl" type="hidden" value="" /></form>
<form enctype="multipart/form-data" method="post" action="upload.php">
<input type="hidden" name="type" value="<?php echo $type?>"/>
<div class="panel_wrapper">
	<div id="general_panel" class="panel current">
<?php
/*если картинка загружена - выводим превьюшку и ссылку*/
if ( $check_upload ) {
	/*list($width,$height,$imgtype) = GetImageSize($upload_url.$file_name);

	if ( $imgtype>=1 && $imgtype<=3 ) {
		$size_max = ($width>$height) ? $width : $height;
		if ( $size_max>$screen_max ) {
			$size_prc = 100*200/$size_max;
			$width = ceil($width*$size_prc/100);
			$height = ceil($height*$size_prc/100);
		}
		echo "
	<p style='color:red'><b>Предпросмотр загружаемой картинки:</b><br>
	<a href=\"#\" onclick=\"selectURL('".$upload_url.$file_name."');\">".'<img border="0" src="'.$upload_url.$file_name.'" width="'.$width.'"/></a></p>';
	}*/
	echo "<hr><p style='color:red'><b>Нажмите на ссылку, чтобы адрес картинки загрузился в адресную строку &nbsp;&nbsp;&rarr;&nbsp;&nbsp;[&nbsp;<a href=\"#\" onclick=\"selectURL('".$upload_url.$file_name."');\">".$file_name."</a>&nbsp;]</b></p>";
}

/*если картинка еще не загружена выводим форму для загрузки*/
else {
		echo "<table border='0' cellpadding='4' cellspacing='0'>
		
		<tr>
			<td><label for='userfile'>".ucfirst($type)."</label></td>
			<td><input type='file' id='userfile' name='userfile' style='width: 200px'></td>
		</tr>
		</table>
	</div>
</div>
<div class='mceActionPanel'>
	<div style='float: left'><input type='submit' id='insert' name='upload' value='Загрузить'/></div>";
}	
?>	
	<div style="float: right"><input type="button" id="cancel" name="cancel" value="Отменить" onclick="tinyMCEPopup.close();" /></div>
</div>
</form>

</body>
</html>