	
<?php
$title="Uploads";
	include('header.php');
	$deleted = false;
	

	if((!empty($_POST))){
		
		foreach ($_REQUEST["delall"] as $list_category_id) {	
			
			if(is_numeric($list_category_id) && $list_category_id > 0 ){	
					
					
					$sql="select cl.cat_id,cl.cat_image_url,cl.cat_image_thumb_url from list_category cl where cl.list_category_id=$list_category_id";
					$res=$db->Query($sql);
					$rowcount=mysql_num_rows($res);
					if($rowcount>0){
						
						$data=array();
						$data=mysql_fetch_array($res);
						
						$name		=explode('/',$data['cat_image_url']);
						
						$img		='uploads/'.$data["cat_id"].'/'.end($name);
						$img_thumb	='uploads/'.$data["cat_id"].'/thumb/'.end($name);
						
						deleteFile($img);
						deleteFile($img_thumb);
						
					}
					$db->Delete("list_category","list_category_id =".$list_category_id);				
					$deleted = true;
			}
		}
		$queryString='';
		if(isset($_GET['page'])&&$_GET['page']!=''){
			$curr_page=$_GET['page'];
			if($curr_page>1){
				$curr_page--;
				$queryString="page=$curr_page";
			}
		}
		header('location:detail-category.php?'.$queryString);
	}
	
	
	include('paginate.php'); //include of paginat page
	
	$cur_page 		= isset($_GET["page"])?$_GET["page"]:1;
	$per_page 		= 16;         // number of results to show per page
	
	if($cur_page==1)
	{
		$page_start = 0;
	}else
	{
		$page_start = (($cur_page-1)*$per_page);
	}
		
	$sql_result 	= mysql_query("select cl.*,c.cat_name from list_category cl inner join category c on c.cat_id= cl.cat_id order by cl.list_category_id desc");
	$total_results	= mysql_num_rows($sql_result);
	$total_pages 	= intval($total_results / $per_page);//total pages we going to have
	
		
	if($total_pages==0){
		
		$total_pages = 1;
	}
	elseif(($total_pages*$per_page)<$total_results)
	{
		$total_pages++;
	}
	$sql		=	"select cl.*,c.cat_name from list_category cl inner join category c on c.cat_id= cl.cat_id order by cl.list_category_id desc limit ".$page_start.",".$per_page;
	
	$res		=	$db->Query($sql);
	$rowcount	=	mysql_num_rows($res);
?>





<section id="content">
				 
                <div class="container">
                    <div class="block-header">
                        <h2>Upload Details</h2>
                    
                        <ul class="actions">
                            <li>
                                <a class="icon-pop" href="#">
                                    <i class="zmdi zmdi-trending-up"></i>
                                </a>
                            </li>
                            <li>
                                <a class="icon-pop" href="#">
                                    <i class="zmdi zmdi-check-all"></i>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a class="icon-pop" href="#" data-toggle="dropdown">
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
                        
                      
                        
							<div class="card-body card-padding">			
		<!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
			<div class="pull-right search"> 
								<!-- <form action="" method="post"> 
									<label class="checkbox checkbox-inline m-r-20"> 
										Select All<input type="checkbox" name="del[]" class="selectAll"><i class="input-helper"></i></label>
								</form> -->
							</div>
				<h1 class="page-header"><i class="fa fa-photo"> </i> Image List</h1>
							
								
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-4 col-sm-6 col-lg-3">
							<div class="form-actions">
								<button type="submit" class="btn bgm-deeporange waves-effectdel">Delete</button> 
								<a class="btn btn-primary waves-effect" href="uploads.php?menu=72">New Upload</a>
							
							</div>
						</div>
						<div class="col-md-8 col-sm-6 col-lg-9">
							
							
						
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					
					
					<div class="panel-body">
							<div class="card-deck-wrapper">
								<div class="card-deck-wrapper">
								<div class="card-deck files files">
								<?php 
								$count			=0;
								$hide_chk		=0;
							
								if($rowcount>0){
									
									while($rs = mysql_fetch_assoc($res))
									{
									// $img_thumb	=$rs["cat_image_thumb_url"];
									$origin_img	=$rs["cat_image_url"];
									$cat		=$rs["cat_name"];
									$caption	=$rs["cat_caption"];
									$name		=explode('/',$origin_img);
									$img		='uploads/'.$rs["cat_id"].'/'.end($name);
									$img_thumb	='uploads/'.$rs["cat_id"].'/thumb/'.end($name);
									
									if (file_exists($img)) {
										
									
									
									?>
									
									<div data-index="<?php echo $count;?>" class="card col-sm-6 col-md-4 col-lg-3  upload-wrapper">
										<div class='upload-content'>	
											<div class="card-block upload">
													<h4 class="card-title"><?php echo $cat; ?><a href='delete-file.php?del[]=<?php echo $rs['list_category_id'];?>'><span class="single-remove"><i class="fa fa-times"></i></span></a></h4>
													<h6 class="card-title cat">Category</h6>
											</div>
											<img width="100%" height="200px" style="margin: auto; text-align: center" class="card-img-top img-1" src="<?php echo $img_thumb; ?>" data-src="" alt="Card image cap img-1">
											<div class="card-block upload">
												<div class='upload-edit'>
													<div class="col-sm-6 col-lg-6 widget-left upload-widget-left">
														<a href="javascript:void(0)" class="list_category_id" id="#list_category_id">
															<span class="icons upload-icon"><i class="glyphicon glyphicon-trash"></i></span><input type="checkbox" name="delall[]" value="<?php echo $rs["list_category_id"]; ?>" class='' data-index="0"> Delete
														</a>
													</div>
													<div class="col-sm-6 col-lg-6 widget-left upload-widget-left">
														<a href="javascript:void(0)" class="<?php echo $rs['list_category_id'];?>" id="#cat-modal" data-toggle="modal" data-target="#cat-modal-<?php echo $rs['list_category_id'];?>">
															<span class="icons upload-icon"><i class="glyphicon glyphicon-pencil "></i></span>Edit
														</a>
													</div>
												</div>
											</div>
										</div>	
											
									</div>
												
								<!--modal-->
									<form action="update-captions.php" method="post"> 
										<div class="modal fade" id="cat-modal-<?php echo $rs['list_category_id'];?>" role="dialog">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													
													<div class="modal-footer">
														<div class="no-padd col-md-2 col-sm-12 col-lg-2">
															<img style="float: left" src="<?php echo $img_thumb; ?>" width="125px" height="125px">
															<div style="clear:both"></div>
														</div>
														<div class="img-preview col-md-8 col-sm-12 col-lg-8">
															<h4 class="foot-modal img"><span class="lbl-cat">Category 	:&nbsp;</span><?php echo $cat; ?>	 </h4>
															<h5 class="foot-modal img"><span class="lbl-cap">Caption 	&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</span><input type='text' name='cap' value='<?php echo $caption; ?>' class="edit-cap" ></h5>
															<input type="hidden" name='list_category_id' value="<?php echo $rs['list_category_id'];?>">
															<input type="submit" name='submit' value="update" class="btn save-cap">
														</div>
													</div>
												
													<div class="modal-body">
														<div class="">
															<img src="<?php echo $img; ?>"  width="100%" height="100%" />
														</div>
													</div>
													
												</div>
											</div>
										</div>		
									</form>
													
									
									<?php
									$count++;
									}
								}
							}
							?>
							</div>
						</div>
						</div>
					</div><!--col-->
					<div class="col-lg-12">
						<div class="fixed-table-pagination">
						<div class="pull-right pagination">
							
							 <?php

								echo '<div class="pagination pull-right" ><ul class="pagination">';
									if ($total_pages > 1) {
										echo paginate('detail-category.php?total_pages='.$total_pages.'', $cur_page, $total_pages);
									}
								echo "</ul></div>";
								
							?> 
							
						</div>
						</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->	
	
	
		
	<div class="row relative">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-4 col-sm-6 col-lg-3">
							<div class="form-actions">
								<button class="btn bgm-deeporange waves-effectdel" type="submit">Delete</button> 
								<a href="uploads.php?menu=72" class="btn btn-primary waves-effect">New Upload</a>
							</div>
						</div>
						<div class="col-md-8 col-sm-6 col-lg-9">
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
						
						
                            </div>
							<div class="row float">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-4 col-sm-12 col-lg-3">
							<div class="form-actions">
  							<label class="checkbox checkbox-inline m-r-20"> 
							 <form method="post" action="" name="tabledata">
										<label style="position: relative; right: 25px">Select All</label><input name="del[]" class="selectAll" type="checkbox"><i class="input-helper"></i></label>
								<button class="btn bgm-deeporange waves-effectdel" type="submit">Delete</button> 
								<a href="uploads.php?menu=72" class="btn btn-primary waves-effect">New Upload</a>
							</form><!--/.main-->
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
							
							
                        </div>
						
                    
                
                    
                    
                    
                
            </section>
<script>
$('#list_category_id').click(function(){
	$(this).closest('input[type="checkbox"]').prop('checked',true);
});

$('.upload-search-lbl').click(function(){
var data=$(this).text();
  var target='Search '+data.trim();
  $('.upload.form-control').prop('placeholder',target)
});

$('.selectAll').change(function(){
	$('input[name="delall[]"]').prop('checked',$(this).prop('checked'));
})

					
					
					
					

</script>
<style>

</style>
<?php
	include('footer.php');
?>