	
<?php
	$title		="App Setting List";
	include('header.php');
	
	$deleted = false;
	if((!empty($_POST))){
	
		foreach ($_REQUEST["delall"] as $app_id) {	
			if(is_numeric($app_id) && $app_id > 0 ){	
					$db->Delete("app_setting","app_id =".$app_id);				
					$deleted = true;
			}
		}
		
	}
	
	$sql="select * from app_setting ";
	$res=$db->Query($sql);
	$rowcount=mysql_num_rows($res);
?>


   <section id="content">
                <div class="container">
                    <div class="block-header">
                        <h2>Appsettings</h2>
                        
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
                             <table id='tablelist' class="table table-bordered table-striped table-hover tc-table table-primary footable" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                                        <th data-column-id="received" data-order="desc">Key Name</th>
                                        <th data-column-id="sender">Key Value</th>
										<th data-column-id="commands" data-formatter="commands" data-sortable="true">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <?php 
							if($rowcount>0)
							{
								$count=0;
								while($rs = mysql_fetch_assoc($res))
								{
									
								?>
									<tr>
										<td class="bs-checkbox"> <?php echo $rs["app_id"];?></td>
										<td><?php echo $rs["kayname"]; ?></td>
										<td><?php echo $rs["keyvalue"]; ?></td>
										<td data-action='edit' class='edit'>Edit</td>
									</tr>
									<?php
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
												<button class="btn del" type="submit">Delete</button> 
												<a href="add-appsetting.php?menu=<?php echo isset($_GET['menu'])? $_GET['menu']:"";?>" class="btn btn-primary">Add New</a>
											</div>
										</div>
									</div>
								</div>
							</form>
                        </div>
                    </div>
                    
                    
                </div>
            </section>
			
			<script>
				$('table:first tr').each(function() {
				var lasttd=  $(this).find('td:last').text('').append('<a href="">Edit</a>')
					//your code
				});
			</script>
     
<?php
	include('footer.php');
?>