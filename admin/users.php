<?php
$title = "User List";
include('header.php');

$deleted = false;
if((!empty($_POST))){

	foreach ($_REQUEST["delall"] as $id_user) {
		if(is_numeric($id_user) && $id_user > 0 ){
			$db->Delete("user","id_user =".$id_user);
			$deleted = true;
		}
	}

}

$response=array();
$response=$firebase->get(DEFAULT_PATH_USERS);
	echo  '<pre>';
		print_r(json_decode($response,true));
	echo '</pre>';
 exit;
$sql="select * from user";
$res=$db->Query($sql);
$rowcount=mysql_num_rows($res);
?>


<section id="content">

	<div class="container">
		<div class="block-header">
			<h2>User List</h2>

			<ul class="actions">
				<li>
					<a href="#">
						<i class="zmdi zmdi-trending-up"></i>
					</a>
				</li>
				<li>
					<a href="#">
						<i class="zmdi zmdi-check-all"></i>
					</a>
				</li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown">
						<i class="zmdi zmdi-more-vert"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a href="#">Refresh</a>
						</li>
						<li>
							<a href="#">Manage Widgets</a>
						</li>
						<li>
							<a href="#">Widgets Settings</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>


		<div class="card">
			<div class="card-header">
				<h2>All Appsettings <small>settings for admin panel</small></h2>
			</div>
			<form action="" method="post">
				<div class="table-responsive">

					<div id="data-table-selection-header" class="bootgrid-header container-fluid">
						<div class="row">
							<div class="col-sm-12 actionBar">
								<div class="search form-group">
									<div class="input-group">
										<span class="zmdi icon input-group-addon glyphicon-search"></span>
										<input type="text" id='search-field' onkeyup='filter()' class="search-field  form-control" placeholder="Search">
									</div>
								</div>
							</div>
						</div>
					</div>

					<table id='tablelist' class="table table-bordered table-striped table-hover tc-table table-primary footable" data-page-size="10">
						<thead>
							<tr>
								<th class="col-small center" data-sort-ignore="true">
									<div class="checkbox">
										<label>
											<input type="checkbox" name='delall[]' onclick="selectall()" class="tc">
											<i class="input-helper"></i>
										</label>
									</div>
								</th>
								<th data-column-id="name" data-sortable="true" >Name</th>
								<th data-column-id="email" data-sortable="true" >Email</th>
								<th data-column-id="commands" data-formatter="commands" data-sortable="true">Action</th>
							</tr>
						</thead>
						<tbody>

							<?php
							if($rowcount>0){
								$count=0;
								while($rs = mysql_fetch_assoc($res))
								{
									if($rs["id_user"]!=$_SESSION['id_user']){
										?>
										<tr data-index="<?php echo $count;?>">
											<td class="col-small center">
												<div class="checkbox">
													<label>
														<input type="checkbox" name='delall[]' value="<?php echo (int)$rs["id_user"];?>" class="tc">
														<i class="input-helper"></i>
													</label>
												</div>
											</td>
											<td><?php echo $rs["name"]; ?></td>
											<td><?php echo $rs["email"]; ?></td>
											<td><a href="add-users.php?id=<?php echo (int)$rs["id_user"];?>">Edit Now</a></td>
										</tr>

										<?php
									}
									$count++;
								}
							}
							?>
						</tbody>
					</table>
					<div class="bootgrid-footer container-fluid" id="data-table-selection-footer">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-actions">
									<button class="btn  del" type="submit">Delete</button>
									<a href="add-users.php?menu=<?php echo isset($_GET['menu'])? $_GET['menu']:'';?>" class="btn btn-primary">Add New</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>


	</div>
</section>

<?php
include('footer.php');

?>
