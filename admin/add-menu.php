<?php

if ((!empty($_POST)) && isset($_POST["btnsubmit"])) {
    require_once("../config.php");
    $db               = new Database();
    $tablename        = "menu";
    $menu_name        = $_POST["menu_name"];
    $parent_menu      = $_POST["parent_menu"];
    $menu_page_url    = $_POST["menu_page_url"];
    $menu_sort_order  = $_POST["menu_sort_order"];
    $menu_image_class = $_POST["menu_image_class"];
    $menu_table       = $_POST["menu_table"];
    if ($_POST['is_active'] == 'on') {
        $chkflg = 1;
    }
    
    else {
        $chkflg = 0;
    }
    
    
    
    if ((isset($_GET["id"])) && ($_GET["id"] != "")) {
        $id = $_GET["id"];
        if (empty($parent_menu)) {
            $parent_menu = 0;
        }
        $data = array(
            "menu_name" => $menu_name,
            "parent_menu" => $parent_menu,
            "page_url" => $menu_page_url,
            "sortorder" => $menu_sort_order,
            "img_class" => $menu_image_class,
            "status" => $chkflg,
            "menu_table" => $menu_table
        );
        
         
        $db->Update($data, $tablename, "menu_id=" . $id);
        header("Location: menu.php?mode=update");
        exit;
    } else {
        if (empty($parent_menu)) {
            $parent_menu = 0;
        }
        
        
        $data = array(
            "menu_name" => $menu_name,
            "parent_menu" => $parent_menu,
            "page_url" => $menu_page_url,
            "sortorder" => $menu_sort_order,
            "img_class" => $menu_image_class,
            "menu_table" => $menu_table,
            "status" => $chkflg
        );
        
        $db->Insert($data, $tablename);
        header("Location: menu.php?mode=insert");
        exit;
    }
}
?>

<?php
	$title="Add Menu";
	include('header.php');
?>

<?php  // Load Data on Edit
	$menu_name = "";
	$parent_menu="";
	$menu_page_url = "";
	$menu_sort_order = getsortorder('sortorder','menu');
	$menu_image_class = "";
	$is_active = "";
	$menu_table = "";
			
	if((isset($_GET["id"])) && ($_GET["id"]!="")){
		$id = isset($_GET["id"])?($_GET["id"]):0;
		$res =$db->Query("select * from menu where menu_id = ".$id."");
		$rowcount=mysql_num_rows($res);
		if($rowcount>0){
			$rs = mysql_fetch_assoc($res);
			
			$menu_name = $rs["menu_name"];
			$parent_menu=$rs["parent_menu"];
			$menu_page_url = $rs["page_url"];
			$menu_sort_order = $rs["sortorder"];
			$menu_image_class = $rs["img_class"];
			$is_active = $rs["status"];
			$menu_table = $rs["menu_table"];
			
			
			if($is_active == '1')
						$is_active = "checked";
					else
						$is_active = "";
			
		}
	}
?>

<section id="content">
                <div class="container">
                    
                
                    <div class="card">
                        <div class="card-header">
                            <h2>New Menu<small></small></h2>
                        </div>
                        
                        <div class="card-body card-padding">
                            <form role="form" action="" method="post">
                                <div class="form-group fg-line">
                                    <label for="exampleInputEmail1">Menu name</label>
                                    <input type="text" name="menu_name" id="menu_name" value="<?php echo $menu_name;?>" class="menu_name form-control input-sm" placeholder=""  >
                                </div>
								<div class="form-group fg-line">
                                    <label for="exampleInputEmail1">Menu name</label>
                                    <select name="parent_menu" id="parent_menu" class="parent_menu form-control">
                                                    <option value="">None</option>
                                                    <?php
												
												$tablename = "menu";
												$res =$db->Query("select * from menu order by sortorder");
												$rowcount=mysql_num_rows($res);
												if($rowcount>0){
												while($rs=mysql_fetch_array($res))
												{
												if(empty($rs['parent_menu']) && ($rs['status'] == '1' && $rs['menu_id']!='')){
												$id=$rs['menu_id'];
												$name=$rs['menu_name'];
											?>														
											 
											 <option value="<?php echo $id; ?>"<?php if ($parent_menu == $id) { echo 'selected'; } ?>><?php echo $name; ?></option>;
											 
												<?php
												}
												else{
													
												}
												}
												}
											?>
                                    </select>
                                </div>
                                <div class="form-group fg-line">
                                    <label for="exampleInputEmail1">Page url</label>
                                    <input type="text" name="menu_page_url"  value="<?php echo $menu_page_url;?>" placeholder="" id="menu_page_url" class="menu_page_url form-control input-sm">
                                </div>
								<div class="form-group fg-line">
                                    <label for="exampleInputEmail1">Sort Order</label>
                                    <input type="text" name="menu_sort_order" value="<?php echo $menu_sort_order;?>" placeholder="" id="menu_sort_order" class="menu_sort_order form-control input-sm">
                                </div>
								<div class="form-group fg-line">
                                    <label for="exampleInputEmail1">Image class</label>
                                    <input type="text" name="menu_image_class" value="<?php echo $menu_image_class;?>" placeholder="" id="menu_image_class" class="menu_image_class  form-control input-sm">
                                </div>
								<div class="form-group fg-line">
                                    <label for="exampleInputEmail1">Menu Tabel</label>
                                    <input type="text" name="menu_table" value="<?php echo $menu_table;?>" placeholder="" id="menu_table" class="menu_table  form-control input-sm">
                                </div>
							    <div class="checkbox">
                                    <label>
                                        <input name="is_active" type="checkbox" value="on" <?php echo $is_active;?>>
                                        <i class="input-helper"></i>
                                        Is Active <?php echo $is_active;?>
                                    </label>
                                </div>
                                
                                <button type="submit" name="btnsubmit" class="btn btn-primary btn-sm m-t-10 waves-effect" >Save</button>
                                <a href="menu.php?menu=<?php echo isset($_GET['menu'])? $_GET['menu']:"";?>" class="btn btn-sm m-t-10 waves-effect btn-default" >Back</a>
                            </form>
                        </div>
                    </div>
                    
                   </div>
            </section>



	<script>
	
	
	jQuery('p.validation').hide();
	
	function validateinput(){
	 var isValid = true;
	 $('.validation').hide();
					if ($('#menu_name').val()== '') {
						isValid = false;
						$('#menu_name').next('.validation').show();
					}
					
					if ($('#txtparentmenu').val()== '') {
						isValid = false;
						$('#txtparentmenu').next('.validation').show();
					}
					
					if ($('#menu_page_url').val()== '') {
						isValid = false;
						$('#menu_page_url').next('.validation').show();
					}
					
					if ($('#menu_sort_order').val()== '') {
						isValid = false;
						$('#menu_sort_order').next('.validation').html("Please enter sort order.").show();
					}
					else
					{
						if (IsNumber($('#menu_sort_order').val())== false) {
						isValid = false;
						$('#menu_sort_order').next('.validation').html("Please enter valid numeric value for sort order.").show();
						}
					}
					if ($('#menu_image_class').val()== '') {
						isValid = false;
						$('#menu_image_class').next('.validation').show();
					}
																																				
				return isValid;
	}
	</script>
<?php
	include('footer.php');
?>