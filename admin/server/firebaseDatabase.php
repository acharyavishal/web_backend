<?php
require_once('../../config.php');

if(isset($_POST)&&isset($_POST['type'])){

	$response=array();
	$defults=array("status"=>300,"message"=>"no changes found");


		switch (strtoupper($_POST['type'])) {
			case 'TABLES':
				# code...
			echo json_encode($response);
			break;

			case 'ORDERS':
				$response['status']=200;
				$response['message']="gotcha";
			echo json_encode($response);
			break;

			case 'USERS':
				# code...
			echo json_encode($response);
			break;

			case 'STUDENTS':


				echo $db->InsertUnique($_POST['data'],'students','uid',$_POST['key']);
				echo $id = mysql_insert_id();
				if($id>0){
					$response=array();
					$response['url']='add-students.php';
					$response['title']='Restaurant App';
					$response['message']='New order availabel!!!';
					$response['id']=$mysql_insert_id;
					echo json_encode($response);

				}

			break;
			default:
				echo json_encode($response);
				break;
		}

}else  {
	echo 'something went wrong';
}
exit;




?>
