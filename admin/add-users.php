<?php

if((!empty($_POST)) && isset($_POST["btnsubmit"])){
	require_once("../config.php");
	$db = new Database();
	$tablename = "user";
	/* echo '<pre>';
	print_r($_POST);
	echo '<pre>'; */

	$txtname=$_POST["txtname"];
	$txtemail=$_POST["txtemail"];
	$contactno=$_POST["contactno"];
	$password=mc_encrypt($_POST["password"], ENCRYPTION_KEY);
	// $password=$_POST["password"];
	if($_POST['isactive']=='on'){
		$chkflg=1;
	}
	else{$chkflg=0;}

	$dt1=date("Y-m-d");


	if((isset($_GET["id"])) && ($_GET["id"]!=""))
	{
		//print_r($_POST);
		$id = $_GET["id"];
		$data = array(
			"name" =>$txtname,
			"email" => $txtemail,
			"password"=>$password,
			"modifydate"=>$dt1,
			"isactive"=>$chkflg,
			"contactno"=>$contactno
		);
		$db->Update($data,$tablename,"id_user=".$id);
		$tablename="admin_rights";
		$db->Delete("admin_rights","id_user =".$id);
		$dt2=date("Y-m-d");
		$sql="select * from menu";
		$res=$db->Query($sql);
		$rowcount=mysql_num_rows($res);

		if($rowcount>0){
			while($rs = mysql_fetch_assoc($res))
			{	 $menu_id=$rs['menu_id'];
				if($_POST['chk'.$rs['menu_id']]=='on'){

					$data = array(
						"id_user"=>$id,
						"menu_id"=>$menu_id,
						"createdate"=>$dt2
					);
					$db->Insert($data,$tablename);											}
				}
			}
			header("Location: users.php?mode=update");
			exit;
		}
		else{

			$data = array(
				"name" =>$txtname,
				"email" => $txtemail,
				"password"=>$password,
				"creatdate"=>$dt1,
				"isactive"=>$chkflg,
				"contactno"=>$contactno
			);
			$db->Insert($data,$tablename);
			$id_user = mysql_insert_id();


			$dt2=date("Y-m-d");
			$sql="select * from menu";
			$res=$db->Query($sql);
			$rowcount=mysql_num_rows($res);
			if($rowcount>0){
				while($rs = mysql_fetch_assoc($res))
				{	$menu_id=$rs['menu_id'];
					if($_POST['chk'.$rs['menu_id']]=='on'){
						$tablename="admin_rights";
						$data = array(
							"id_user"=>$id_user,
							"menu_id"=>$menu_id,
							"createdate"=>$dt2
						);
						$db->Insert($data,$tablename);											}
					}
				}
				header("Location: users.php?mode=insert");
				exit;
			}
		}
		?>


		<?php
		$title="Add Users";
		include('header.php');

		?>

		<?php

		$txtname= "";
		$txtemail= "";
		$password= "";
		$isactive="";
		$contactno="";

		if((isset($_GET["id"])) && ($_GET["id"]!="")){
			$id = isset($_GET["id"])?($_GET["id"]):0;
			$res =$db->Query("select * from user where id_user = ".$id);
			$rowcount=mysql_num_rows($res);
			if($rowcount>0){
				$rs = mysql_fetch_assoc($res);
				$txtname =$rs["name"];
				$txtemail=$rs["email"];
				$contactno=$rs["contactno"];
				$password=mc_decrypt($rs["password"],ENCRYPTION_KEY);
				$isactive=$rs['isactive'];
				if($isactive == '1')
				$isactive = "checked";
				else
				$isactive = "";

			}
		}

		?>

		<section id="content">
			<div class="container">


				<div class="card">
					<div class="card-header">
						<h2>Add Users<small></small></h2>
					</div>

					<div class="card-body card-padding">
						<form role="form" action="" method="post">
							<div class="form-group fg-line">
								<label >Name</label>
								<input class="form-control input-sm" type="text" value="<?php echo $txtname ;?>" name="txtname" id="txtname" class="span4" required>
							</div> <!-- /control-group -->

							<div class="form-group fg-line">
								<label >Email</label>
								<input class="form-control input-sm" type="email" value="<?php echo $txtemail;?>" name="txtemail" id="txtemail" class="span4" required>

							</div> <!-- /control-group -->


							<div class="form-group fg-line">
								<label >Password</label>
								<input class="form-control input-sm" type="password" value="<?php echo $password;?>" name="password" id="password" class="span4" required>
							</div> <!-- /control-group -->



							<div class="form-group fg-line">
								<label >Confirm Password</label>
								<input class="form-control input-sm" type="password" value="<?php echo $password;?>" name="cnfpassword" id="cnfpassword" class="span4" required>
							</div> <!-- /control-group -->

							<div class="form-group fg-line">
								<label >Contact No</label>
								<input class="form-control input-sm" type="contactno" value="<?php echo $contactno;?>" name="contactno" id="contactno" class="span4 contactno" required>
							</div> <!-- /control-group -->
							<div class="form-group fg-line">
								<div class="toggle-switch">
									<label class="ts-label" for="ts1">is Active?</label>
									<input type="checkbox"  name="isactive" hidden="hidden" id="ts1" <?php echo $isactive;?>>
									<label class="ts-helper" for="ts1"></label>
								</div>
							</div>
							<div class="form-group fg-line">
								<label>User Rights</label>

								<?php
								if(!empty($id)){
									$sql="select m.*,ar.admin_rights_id from menu m left join admin_rights ar on  m.menu_id=ar.menu_id and ar.id_user=".$id." order by menu_name";
								}
								else{
									$sql="select * from menu";
								}
								$res=$db->Query($sql);
								$rowcount=mysql_num_rows($res);
								$count=0;
								if($rowcount>0){
									while($rs = mysql_fetch_assoc($res))
									{
										?>





										<?php
										$ischecked = '';
										if(!empty($rs['admin_rights_id']) && $rs['admin_rights_id'] != ""){
											$ischecked = 'checked="checked"';
										}
										if($count==0){
											?>
											<div class="checkbox">
												<label>
													<input type="checkbox" id="user_rights_menu" onclick="selectallMenu(this)" name="btSelectAll">Select All
													<i class="input-helper"></i>
												</label>
											</div>
											<hr>
											<?php
										}
										?>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="menu" class="menu" name="chk<?php echo $rs['menu_id'];?>" <?php echo $ischecked; ?> ><?php echo $rs['menu_name'];?>
												<i class="input-helper"></i>
											</label>
										</div><!-- /controls -->
										<?php $count++;?>
										<?php } }?>
									</div><!--menus--->

									<button class="btn btn-primary" name="btnsubmit" type="submit">Save</button>
									<a href="users.php?menu=<?php echo isset($_GET['menu'])? $_GET['menu']:"";?>" class="btn">Back</a>
								</form>
							</div>
						</div>

					</div>
				</section>




				<script>

				function selectallMenu(input)
				{
					$('.menu').prop('checked',$(input).is(':checked'));
				}

				$(document).ready(function()
				{
					$("#edit-profile").validate({
						rules: {
							password: {
								required: true
							},
							cnfpassword: {
								required: true,
								equalTo: "#password"
							},
							messages: {
								cnfpassword: {
									equalTo: "Please enter the same password as above"
								}
							}
						}
					});
				});
				</script>
				<?php
				include('footer.php');
				?>
