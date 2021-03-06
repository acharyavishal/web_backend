<?php 
$title="Admin Dashboard";

include("header.php");


 $sql="SELECT m.* , m.menu_name, a.admin_rights_id FROM admin_rights a LEFT JOIN menu m ON m.menu_id=a.menu_id where a.id_user=".$_SESSION['id_user']." order by menu_name";


$res=$db->Query($sql);
$rowcount=mysql_num_rows($res);
?>

 
            
            <section id="content">
                <div class="container">
				
				 <div class="mini-charts">
                        <div class="row">
                            <?php
								$response=array();		
									if($rowcount>0)
									{
										$response["status"]=200;
										$response["message"]="successfully fetched data!!!";
										$data=array();
										while($rs = mysql_fetch_assoc($res))
										{
												$data[]=$rs;
											
											if(empty($rs['parent_menu']) && $rs['status'] == '1' && $rs['menu_id']!='')
											{
													
												?>
												
											<div class="col-sm-6 col-md-3">
												<a href="<?php echo $rs["page_url"].'?menu='.$rs['menu_id']; ?>" class="shortcut">
												<div class="mini-charts-item bgm-cyan bgm-<?php echo $rs["img_class"];?>">
													<div class="clearfix">
														<div class="chart stats-bar <?php echo $rs["img_class"];?>"></div>
														<div class="count">
															<h2><?php echo $rs["menu_name"]; ?></h2>
															<small><?php echo $rs["menu_name"]; ?></small>
														</div>
													</div>
												</div>
												</a>
											</div>		
												
										
												<?php
													
													
												}
											}
											$response["data"]=$data;
											/* echo '<pre>';
													print_r($response);
													echo json_encode($response);
											echo '</pre>'; */
												
										}			
										?>			
							
                        </div>
                    </div>
                    
				
                    <div class="card">
                        <div class="card-header">
                            <h2>Sales Statistics <small>Vestibulum purus quam scelerisque, mollis nonummy metus</small></h2>
                            
                            <ul class="actions">
                                <li>
                                    <a href="#">
                                        <i class="zmdi zmdi-refresh-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="zmdi zmdi-download"></i>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="zmdi zmdi-more-vert"></i>
                                    </a>
                                    
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="#">Change Date Range</a>
                                        </li>
                                        <li>
                                            <a href="#">Change Graph Type</a>
                                        </li>
                                        <li>
                                            <a href="#">Other Settings</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="card-body">
                            <div class="chart-edge">
                                <div id="curved-line-chart" class="flot-chart "></div>
                            </div>
                        </div>
                    </div>
                    
                   
                    
                    <div class="dash-widgets">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div id="site-visits" class="dash-widget-item bgm-teal">
                                    <div class="dash-widget-header">
                                        <div class="p-20">
                                            <div class="dash-widget-visits"></div>
                                        </div>
                                        
                                        <div class="dash-widget-title">For the past 30 days</div>
                                        
                                        <ul class="actions actions-alt">
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
                                    
                                    <div class="p-20">
                                        
                                        <small>Page Views</small>
                                        <h3 class="m-0 f-400">47,896,536</h3>
                                        
                                        <br/>
                                        
                                        <small>Site Visitors</small>
                                        <h3 class="m-0 f-400">24,456,799</h3>
                                        
                                        <br/>
                                        
                                        <small>Total Clicks</small>
                                        <h3 class="m-0 f-400">13,965</h3>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div id="pie-charts" class="dash-widget-item">
                                    <div class="bgm-pink">
                                        <div class="dash-widget-header">
                                            <div class="dash-widget-title">Email Statistics</div>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                        
                                        <div class="text-center p-20 m-t-25">
                                            <div class="easy-pie main-pie" data-percent="75">
                                                <div class="percent">45</div>
                                                <div class="pie-title">Total Emails Sent</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-t-20 p-b-20 text-center">
                                        <div class="easy-pie sub-pie-1" data-percent="56">
                                            <div class="percent">56</div>
                                            <div class="pie-title">Bounce Rate</div>
                                        </div>
                                        <div class="easy-pie sub-pie-2" data-percent="84">
                                            <div class="percent">84</div>
                                            <div class="pie-title">Total Opened</div>
                                        </div>
                                    </div>
    
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6">
                                <div class="dash-widget-item bgm-lime">
                                    <div id="weather-widget"></div>
                                </div>
                            </div>
    
                            <div class="col-md-3 col-sm-6">
                                <div id="best-selling" class="dash-widget-item">
                                    <div class="dash-widget-header">
                                        <div class="dash-widget-title">Best Sellings</div>
                                        <img src="img/widgets/alpha.jpg" alt="">
                                        <div class="main-item">
                                            <small>Samsung Galaxy Alpha</small>
                                            <h2>$799.99</h2>
                                        </div>
                                    </div>
                                
                                    <div class="listview p-t-5">
                                        <a class="lv-item" href="#">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/widgets/note4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Samsung Galaxy Note 4</div>
                                                    <small class="lv-small">$850.00 - $1199.99</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="#">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/widgets/mate7.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Huawei Ascend Mate</div>
                                                    <small class="lv-small">$649.59 - $749.99</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="lv-item" href="#">
                                            <div class="media">
                                                <div class="pull-left">
                                                    <img class="lv-img-sm" src="img/widgets/535.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="lv-title">Nokia Lumia 535</div>
                                                    <small class="lv-small">$189.99 - $250.00</small>
                                                </div>
                                            </div>
                                        </a>
                                        
                                        <a class="lv-footer" href="#">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </section>
       
	<?php include("footer.php");?>