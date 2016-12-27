<?php

session_start();

ob_start();

/* change if you want use your project name  */
define('FIREBASE_API_KEY', 'AIzaSyDEeGmnEm6PTnNKXsxjzEJDaWm6w5PIjEc');
define("SITE_URL","http://localhost/webapp_backend/admin");
define("ADMIN_URL","http://localhost/webapp_backend/admin");

define("SITE_PATH",$_SERVER['DOCUMENT_ROOT']."/index.php",true);
define("ADMIN_PATH",$_SERVER['DOCUMENT_ROOT']."/index.php",true);

define("UPLOAD_IMG_PATH",'http://localhost/webapp_backend/admin/');
define('ENCRYPTION_KEY', '7979797979797979797979797979789');
date_default_timezone_set('Asia/Kolkata');
$now = new DateTime();
$current_time=$now->format('Y-m-d H:i:s'); 
// setup host
$dbHost = "localhost";
$dbName = "adminIndus";
$dbUser = "root";
$dbPass = "";



require_once("include/db.class.php");
require_once("include/functions.php");

$db = new Database();
?>
