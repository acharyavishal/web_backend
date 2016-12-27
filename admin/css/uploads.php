<?php
    $title="Upload Media";
	include('header.php');
?>

<?php  // Load Data on Edit
	$cat_name = "";
	$query='';
	
	 
	if((isset($_GET["id"])) && ($_GET["id"]!="")){
		$id 		= 	isset($_GET["id"])?($_GET["id"]):0;
		$res 		=	$db->Query("select cat_name,cat_id from category where cat_id = ".$id."");
		$rowcount	=	mysql_num_rows($res);
		
		if($rowcount>0){
			$rs		 	= mysql_fetch_assoc($res);
			$cat_name 	= $rs["cat_name"];
			$cat_id 	= $rs["cat_id"];
			$query 		= " and cat_id=$cat_id ";
		}
	}
?>
<section id="content">
                <div class="container main image_upload_div">
                    <div class="block-header">
                        <h2>Uploads</h2>
                    
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
                
				
	<form class="form-horizontal dropzone" action="" method="post" id="form" enctype="multipart/form-data">
		<div class="card">
	 <div class="card-header">
                            <h2>Upload Media<small>upload images only.</small></h2>
                        </div>		
  <div class="card-body card-padding">
								
								<div class="form-group fg-line">
									<h4 style='padding:0px 15px;'>Name</h4>
									
									<select required="" name="cat_id" id="cat_id" class="form-control">
										<option value="">Select Category</option>
															
										<?php
											$sql="SELECT cat_name,cat_id FROM category where 1=1 $query";
											$res=mysql_query($sql);
											$rowcount=mysql_num_rows($res);
											if($rowcount>0){
												
											while ($data=mysql_fetch_array($res)) {
										?>					
												<option value="<?php echo $data["cat_id"]; ?>"><?php echo $data["cat_name"]; ?></option>
										<?php }
											} 
										?>  
										  
									</select>
								</div>
    
    <div class="drag-drop droppable">
      <div class="form-group fg-line">
			 				
     						<div class="card-header select-file">
									<label class="btn btn-default btn-file upload-image waves-effect  btn bgm-cyan waves-effect">
										<span>Select Files</span>
										<input onchange="readURL(this)" style="opacity:0;" type="file" multiple="multiple" name="files[]" id="fileupload" class="fileUpload" accept="image/*"> 
									</label>
								</div>
							</div>
							</div>
  <div class="row example-row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="card-deck-wrapper">
							<div class="card-deck files files">
							</div>
					</div>
				</div>
			</div>
		</div>
						</div>
						<div class="form-group fg-line">
		 	
     		<div class="card-header select-file">
						<button class="btn bgm-pink waves-effect" id="submit" value="Save Data" name="btnsubmit" type="submit">Upload Now</button>
				</div>
		</div>
		
		<!-- <div id="progressbar"></div>

<div class="row float-progress">
	<div class="col-md-10 col-lg-10 col-sm-10">
		<div id="progress" class="progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
		<div class="files-uploaded-wrapper ">
			<span class="files-uploaded">0</span>/<span class="files-total">0</span>
		</div>	
	</div>	
</div> -->
		</div><!-- /.row -->
		
		
<!-- /.upload images  -->

	<!-- /.upload images  -->	

								
		
	</form>
	
</div>
<a data-toggle="modal" href="#preventClick" class="btn card-preloader-open btn-default waves-effect" style='display:none;'>Prevent Outside Click</a>
<div class="modal fade modal-preloader" id="preventClick" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Pretty Eye</h4>
                                        </div>
                                       <div class="modal-body">
                    <div class="preloader pl-xxl">
                                <svg class="pl-circular" viewBox="25 25 50 50">
                                    <circle class="plc-path" cx="50" cy="50" r="20"/>
                                </svg>
                            </div>         <div class="modal-header">
                                            <h4 class="modal-title">Uploading...<br><small>Dialogue automatically close once upload completed.....</small></h4>
											<!-- <div class="row float-progress">
	<div class="col-md-10 col-lg-10 col-sm-10">
		<div id="progress" class="progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
		<div class="files-uploaded-wrapper ">
			<span class="files-uploaded">0</span>/<span class="files-total">0</span>
		</div>	
	</div>	
</div> -->
                                        </div>          
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-link waves-effect card-preloader-close" data-dismiss="modal">Close</button>
<div class="files-uploaded-wrapper " style='text-align:left'>
			<span class="files-uploaded">52</span>/<span class="files-total">53</span>
		</div>										  
										  <div class="progress">
					
							    <div class="progress-bar progress-bar-success" style="width: 0%">
                                    <span class="sr-only">35% Complete (success)</span>
                                </div>
                                <div class="progress-bar progress-bar-warning" style="width: 0%">
                                    <span class="sr-only">20% Complete (warning)</span>
                                </div>
                                <div class="progress-bar progress-bar-danger" style="width: 0%">
                                    <span class="sr-only">10% Complete (danger)</span>
                                </div>
                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


  
</section>


		
	<script>
	
	
	
	var delFile=[];
	function removePreview(){
		
		$('.remove-preview').off().on('click',function(){
			var id=$(this).attr('id');
			delFile.push(parseInt(id));
			$(this).closest('.card').hide();
		
		});
	}	

	function remove(input){
			// console.log(input);
	}
	
	
	function getUniqe(key){
		var currentdate = new Date(); 
		var datetime = currentdate.getDate()+""
		+(currentdate.getMonth()+1)	+""
		+ currentdate.getFullYear()	+""  
		+ currentdate.getHours() 	+""
		+ currentdate.getMinutes() 	+""
		+ currentdate.getSeconds()	+""
		+ currentdate.getMilliseconds();
		return parseInt(datetime)+key;
	}
				
	function genHTML(id,imgSrc){
		if(imgSrc==''){
			imgSrc='img/loading.png';
		}
		var html='';
		html='<div class="card col-sm-12 col-md-4 col-lg-3">';
		html+=	'<div class="card-block"> ';
		html+=	'	<h4 style="padding: 5px 15px; text-align: right;" class="card-title">         ';
		html+=	'		<a onclick="" href="javascript:void(0)" class="remove-preview" id='+id+'><span id="'+id+'" class="del-preview">         ';
		html+=	'			<i class="fa fa-times"></i> ';
		html+=	'		</span> </a>';
		html+=	'	</h4> ';
		html+=	'</div> ';
		html+=	'<img height="180px" width="100%" alt="Card image cap img-'+id+'" data-src="" src="'+imgSrc+'" class="card-img-top img-'+id+'"  style="margin: auto; text-align: center">';
		html+=	'<div class="img-single"><div class="img-singl-succes img-single-'+id+'"></div></div>';
		html+=	'<div class="card-block">';
		html+=		'<h4 class="card-title">Caption</h4>';
		html+=		'<textarea class="form-control img-cap" name="caption[]" class="form-control img-cap" style="" placeholder="some text here!!!"></textarea>';
		html+=	'</div>';
		html+='</div>';
		
		return html;
	}
	
	
		var formData = new FormData;
		var files=[];
		var dropbox;

		dropbox = document.querySelector('.droppable');
		dropbox.addEventListener("dragenter", dragenter, false);
		dropbox.addEventListener("dragover", dragover, false);
		dropbox.addEventListener("drop", drop, false);
		
		function dragenter(e) {
			e.stopPropagation();
			e.preventDefault();
		}
	
		function dragover(e) {
			e.stopPropagation();
			e.preventDefault();
		}
		
		function drop(e) {
			e.stopPropagation();
			e.preventDefault();
			
			var dt = e.dataTransfer;
			var files = dt.files;
			
			handleFiles(files);
		}
	
	var count=0;
	function handleFiles(filesList) {
		var countImage=$('.card-img-top').length;
		for (var key = 0; key < filesList.length; key++) {
		
			files.push($(filesList[key]));
			var file = filesList[key];
			var imageType = /^image\//;
			
			if (!imageType.test(file.type)) {
				continue;
			}
			
			count=countImage+key;
			var html;
			html=genHTML(count,'img/loading.png');
			$('.card-deck').append(html);
			
			var img = document.querySelector('.img-'+count+'');
			
			var reader = new FileReader();
			reader.onload = (function(aImg) 
								{ 
										return function(e) { 
														aImg.src = e.target.result; 
														}; 
								}
							)(img);
			reader.readAsDataURL(file);
			removePreview();
		}
	}
	
	
	
	

	
	/* show image just after image uploaded */
	var imgId=0;
function readURL(input) {
	var len=input.files.length;
	var countImage=$('.card-img-top').length;
	var count=0;
	for(var i=0;i<len;i++){	
		
		if (input.files && input.files[i]) {
			var html;
			count=countImage+i;
			html=genHTML(count,'img/loading.png');
			$('.card-deck').append(html);
			var img = document.querySelector('.img-'+count+'');
			
			var reader = new FileReader();
			reader.onload = (function(aImg) 
								{ 
										return function(e) { 
														aImg.src = e.target.result; 
														}; 
								}
							)(img);
			reader.readAsDataURL(input.files[i]);
			removePreview();
			// count++;
			}
		}	
    }
	
	
	
	
	
	
	
		var cat_id	=	null;
		$('#cat_id').change(function(){
			cat_id=$('#cat_id option:selected').val();
		});
		$('.float-progress').hide();
		var count=0;
		var total=0;
		var proress=0;
		
		
		$('input[type=file]').on('change',function(input){
			files.push($('#fileupload').prop("files"));
		});
		
		var totalFiles=0;
		$('form').submit(function(){
			
			if(cat_id==null){ alert("Please Select Category!!!"); return false;}
			var data=$("textarea");
			
			total=files.length;
			if(total>0){
				
				$('.float-progress').show(200);
			}
			
			for(var i =0;i<total;i++){
				
				totalFiles=parseInt(files[i].length)+totalFiles;
			}
			totalFiles=totalFiles-delFile.length;
			$('.files-total').text(totalFiles);
			
			
		
		var count=0;
		var cnt=0;
		$('.card-preloader').show();
						$('#submit').text('Uploading...');
						$('#submit').attr('disabled',true);
						$('.card-preloader-open').trigger('click');
						
		/* Foreach:FileList */
		files.forEach(function (item, index, array) {
			
			/* Foreach:File */
			$.each(item,function(key,value){
				
				if (typeof item[key] === 'undefined') { return false; }
				
				
				if (jQuery.inArray(key, delFile)!= -1) {
					return false;
				}
				if (jQuery.inArray(cnt, delFile)!= -1) {
					return false;
				}				
				cnt++;
				
				
				/* Uniqe filename */
				var file_name_tail		=	getUniqe(count);
				
				/* append ro form data */
				formData.append('file_name_tail',file_name_tail);
				formData.append('file', item[key]);
				
				/* check caption not empty */
				if(data[key].value==''){
					formData.append('cap', 'no captions');
				}else{
					formData.append('cap', data[key].value);
				}
				
				$('.img-single-'+count).css('width','10%');
				var flag=true;
				var i=0;
					
						
				$.ajax(
				{
					url			: 'upload-image.php?cat_id='+cat_id,
					type		: 'POST',
					async		: true ,
					data		: formData,
					cache		: false,
					processData	: false, 
					contentType	: false,
					xhr: function() {
						
						
						var xhr = new window.XMLHttpRequest();
					
						xhr.upload.addEventListener("progress", function(evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							percentComplete = parseInt(percentComplete * 100);
							if (percentComplete === 100) {}
					
							}
						}, false);
					
						return xhr;
					},					
					beforeSubmit:function(e){},
					success:function(data){
						count++;
						
						proress=((count+1)*100)/totalFiles;
						$('.img-single-'+count).css('width','50%');
						$('.progress-bar-success').css('width',proress+'%');
						$('.files-uploaded').text(count+1);
						
						
						
					},
					complete:function(data){
						$('.img-single-'+count).css('width','100%');
						if(count==totalFiles){
							$('.float-progress').hide(1000);
							proress=0;
						$('#submit').text('Upload Now');
						$('.card-preloader-close').trigger('click');
						$('#submit').attr('disabled',false);
						$('.card-preloader').hide();
							//location.reload();
						}
						
						
					},
					error:function(e){
					
						$('#submit').text('Upload Now');
						$('.card-preloader-close').trigger('click');
						$('#submit').attr('disabled',false);
						$('.card-preloader').hide(500);
					
					}
					
				});/*ajax*/
			});/*foreach File Objects*/
		});/*foreach FileList Objects*/
	return  false;
	});/*submit form*/
	
	

	
	</script>
		
	
	
<?php
	include('footer.php');
?>
