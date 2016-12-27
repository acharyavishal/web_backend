<?php

$title = "Menu Listning";
$deleted = false;

include('header.php');


if((!empty($_POST))){
	foreach ($_REQUEST["delall"] as $menu_id) {
		if(is_numeric($menu_id) && $menu_id > 0 ){
			$db->Delete("menu","menu_id =".$menu_id);
			$deleted = true;
		}
	}

}

if(isset($_GET['mode']) && ($_GET['mode']=='changestatus') && (isset($_GET['id']))){

	$id=$_GET['id'];
	$status=$_GET['status'];
	$tablename='menu';
	$data=array("status"=>$status);
	$db->Update($data,$tablename,"menu_id=".$id);
	header('location:menu.php');
}

$sql="select e.*, m.menu_name as parentname  from menu e left join menu m on e.parent_menu = m.menu_id order by sortorder";
$res=$db->Query($sql);
$rowcount=mysql_num_rows($res);

?>



<section id="content">

	<div class="container">
		<div class="card">
			<div class="card-header">
				<h2>All Appsettings <small></small></h2>
			</div>

			<form action="" method="post">
				<div class="table-responsive">
					<table id='tablelist' class="table table-bordered table-striped table-hover tc-table table-primary footable" data-page-size="15">
						<thead>
							<tr>

								<th class="col-small center" data-sort-ignore="true">
									<div class="checkbox">
										<label>
											<input type="checkbox" class="tc">
											<i class="input-helper"></i>
										</label>
									</div>
								</th>
								<th data-toggle="true">Name</th>
								<th data-hide="">Parent</th>
								<th data-hide="">Page Url</th>
								<th data-hide="">Sort Order</th>
								<th data-hide="">Status</th>
								<th data-hide="">Action</th>
								<th data-sort-ignore="true"></th>
							</tr>
						</thead>
						<tbody>

							<?php
							if($rowcount>0){
								$count=0;
								while($rs = mysql_fetch_assoc($res))
								{
									?>
									<tr data-index="<?php echo $count;?>">


										<td class="col-small center">
											<div class="checkbox">
												<label>
													<input type="checkbox" name='delall[]' value="<?php echo (int)$rs["menu_id"];?>" class="tc">
													<i class="input-helper"></i>
												</label>
											</div>
										</td>

										<td><?php echo $rs["menu_name"]; ?></td>

										<?php if(!empty($rs["parentname"])){ ?>
											<td><?php echo $rs["parentname"]; ?> </td>
											<?php } else {?>
												<td>-</td>
												<?php } ?>

												<td><?php echo $rs["page_url"]; ?></td>
												<td><?php echo $rs["sortorder"]; ?> </td>
												<td> <?php
												if($rs['status'] == '1' && $rs['menu_id']!='')
												{
													?>
													<a href="menu.php?id=<?php echo $rs['menu_id'];?>&status=0&mode=changestatus" class="">Active</a>
													<?php
												}
												else
												{
													?>
													<a href="menu.php?id=<?php echo $rs['menu_id'];?>&status=1&mode=changestatus" class="">Inactive</a>
													<?php
												}
												?>
											</td>
											<td style=""><a href="add-menu.php?id=<?php echo $rs["menu_id"]; ?>" class=""><i class="btn-icon-only icon-edit"> </i>Edit</a></td>
										</tr>
										<?php
										$count++;
									}
								}
								?>
							</tbody>

							<tfoot>
								<tr>
									<td colspan="7">

										<button class="btn btn-danger btn-icon-text waves-effect"><i class="zmdi zmdi-delete"></i> Delete</button>


										<a href='add-menu.php' class="btn bgm-lightblue btn-icon-text waves-effect"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Add New</a>


										<div class="btn-group btn-group-sm pull-left">


											<ul class="dropdown-menu dropdown-primary" role="menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li class="divider"></li>
												<li><a href="#">Separated link</a></li>
											</ul>
										</div>
										<ul class="hide-if-no-paging pagination pagination-centered pull-right"></ul>
										<div class="clearfix"></div>

									</td>

								</tr>
							</tfoot>
						</table>

					</form>
				</div>

			</div>


		</div>
	</section>


	<?php
	include('footer.php');
	?>
