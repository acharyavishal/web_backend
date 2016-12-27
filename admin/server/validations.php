<?php
require_once('../../config.php');

if(isset($_POST)&&isset($_POST['validate'])){

     switch ($_POST['validate']) {
     	case 'EMAIL':
     		echo  "email validation"; 
     		break;
     	
     	default:
     		echo 'default validation';
     		break;
     }

}else  {
	echo 'something went wrong';
}
exit;




?>