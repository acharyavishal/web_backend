<?php

function deletecoockie()
	{
		foreach($_COOKIE as $key => $value)
		{		
			if($key!='PHPSESSID')
				$cookie=setcookie ($key,"", time() - 10000);
		}
	}
	
	
	function make_thumb($img_name,$filename,$new_w,$new_h)
{
				//get image extension.
				$ext=getExtension($img_name);
				//creates the new image using the appropriate function from gd library
				

				if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
				$src_img=imagecreatefromjpeg($img_name);
				
				 
				if(!strcmp("png",$ext))
				$src_img=imagecreatefrompng($img_name);
				 
				//gets the dimmensions of the image
				$old_x=imageSX($src_img);
				$old_y=imageSY($src_img);
 
				// next we will calculate the new dimmensions for the thumbnail image
				// the next steps will be taken:
				// 1. calculate the ratio by dividing the old dimmensions with the new ones
				// 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
				// and the height will be calculated so the image ratio will not change
				// 3. otherwise we will use the height ratio for the image
				// as a result, only one of the dimmensions will be from the fixed ones
				$ratio1=$old_x/$new_w;
				$ratio2=$old_y/$new_h;

									if($ratio1>$ratio2)
									{
										$thumb_w=$new_w;
										$thumb_h=$old_y/$ratio1;
									}
									else 
									{
										$thumb_h=$new_h;
										$thumb_w=$old_x/$ratio2;
									}
 
				// we create a new image with the new dimmensions
				$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
				
				 
				// resize the big image to the new created one
				imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
				 
				// output the created image to the file. Now we will have the thumbnail into the file named by $filename
				if(!strcmp("png",$ext))
				imagepng($dst_img,$filename);
				else
				imagejpeg($dst_img,$filename);
				 
				//destroys source and destination images.
				imagedestroy($dst_img);
				imagedestroy($src_img);
}
 
 
  function getExtension($str) 
						{
								$i = strrpos($str,".");
								if (!$i) { return ""; }
								$l = strlen($str) - $i;
								$ext = substr($str,$i+1,$l);
								return $ext;
						}
	
	
function SetValuesToCookie($pagename,$field,$concatString='_')
{
	if(isset($_POST) && count($_POST) > 0)
	{
		foreach ($_POST as $key=>$value)
		{
			if(isset($key) && in_array($key,$field))
			{
				setcookie($pagename.$concatString.$key, $value, time()+7200);
			}
			else
			{
				setcookie($pagename.$concatString.$key, '', time()-7200);
			}
		}
	}
	else if(isset($_GET) && count($_GET) > 0)
	{
		foreach ($_GET as $key=>$value)
		{
			if(isset($key) && in_array($key,$field))
			{
				setcookie($pagename.$concatString.$key, $value, time()+7200);
			}
			else
			{
				setcookie($pagename.$concatString.$key, '', time()-7200);
			}
		}
	}
	else
	{
		for($i=0;$i<count($field);$i++)
		{
			setcookie($pagename.$concatString.$field[$i], '', time()-7200);
		}
	}
}


function readdata($path){
 	$line = "";
  	if(!($fp=fopen($path,"r"))){
		print("File could not be opened.");
		exit;
	}
	 while(!feof($fp)){
		$line .= fread($fp,1024);
	}
	 fclose($fp);
	 return $line;
 }
 
 function getComboBox($tablename,$fldlist,$id, $where = ""){
	
	global $db;
	
	if($where != "") $where = "where {$where}";
	$sql = "
		select {$fldlist} from {$tablename} {$where} 
	";
	
	$result = $db->Query($sql);
	$chkflg = "";
	$values = "";
	while($arr = mysql_fetch_row($result)){
		if($arr[0] == $id)
			$chkflg = " selected ";
		else 	
			$chkflg = "";
		$values .= ("			
			<option value='".$arr[0]."' {$chkflg}>".ucwords($arr[1])."</option>			
		");
	}
	return $values;
}


 function getKeyvalue($id)
 {
 global $db;
 $sql="select * from app_setting where app_id=".$id;
 $r=$db->Query($sql);
 $rs = mysql_fetch_assoc($r);
 $rows=mysql_num_rows($r);
	if($rows>0){
	
		return $rs['keyvalue']; 
	}
	else{	
		return '';
	}

}


function getsortorder($columname,$table)
 {
 global $db;
 $sql="select (max($columname))+1 as maxorder from $table";
 $r=$db->Query($sql);
 $rs = mysql_fetch_assoc($r);
 $rows=mysql_num_rows($r);
 
	if($rows>0){
	
		return $rs['maxorder']; 
	}
	else{	
		return '';
	}

}
function send_mail($myname, $myemail, $contactname, $contactemail, $subject, $message,$contentType = 'html') {
  $headers = "";
  $headers .= "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/{$contentType}; charset=iso-8859-1\n";
  $headers .= "X-Priority: 1\n";
  $headers .= "X-MSMail-Priority: High\n";
  $headers .= "X-Mailer: php\n";
  $headers .= "From: \"".$myname."\" <".$myemail.">\n";
  $headers .= "Cc: saileshraja@hotmail.com" . "\r\n";
  $headers .= "Bcc: info@shivkinner.com" . "\r\n\r\n";
  
  $retval = @mail("\"".$contactname."\" <".$contactemail.">", $subject, $message, $headers);
  
  //print "<br />Mail sent to {$contactname} ({$contactemail}). <br />" ;
  return($retval);
}

function hasValue($avar){
 if(isset($_GET[$avar]))
 	return stripslashes($_GET[$avar]);
 else if (isset($_POST[$avar]))
 	return stripslashes($_POST[$avar]);
 else
 	return false;
}
function putCookie($name, $avalue){
	setcookie( $name, $avalue,time() + 3600, '/');
}

function removeCookie($name){
	setcookie( $name, "",time() - 1800, '/');
}

//// Encrypt Function
function mc_encrypt($encrypt, $key){
    //return $encrypt;
	$encrypt = serialize($encrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $key = pack('H*', $key);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
    return $encoded;
	
}

// Decrypt Function
function mc_decrypt($decrypt, $key){
    //return $decrypt;
	$decrypt = explode('|', $decrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac){ return false; }
    $decrypted = unserialize($decrypted);
    return $decrypted;
	 
}
function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

    // This will build our "base URL" ... Also accounts for HTTPS :)
    $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';

    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
    $breadcrumbs = Array("<a href=\"$base\">$home</a>");

    // Find out the index for the last value in our path array
    $last = end(array_keys($path));

    // Build the rest of the breadcrumbs
    foreach ($path AS $x => $crumb) {
        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

        // If we are not on the last index, then display an <a> tag
        if ($x != $last)
            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
        // Otherwise, just display the title (minus)
        else
            $breadcrumbs[] = $title;
    }

    // Build our temporary array (pieces of bread) into one big string :)
    return implode($separator, $breadcrumbs);
}

function  deleteFile($delfile){
	if (file_exists($delfile)) {
		unlink($delfile);
	}
}
	
function rrmdir($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)) rrmdir($file); else unlink($file); 
  } rmdir($dir); 
}	
?>