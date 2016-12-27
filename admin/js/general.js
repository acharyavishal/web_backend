

/*table checkbox convert*/
$('table th input:checkbox').on('click' , function(){
	var that = this;
	$(this).closest('table').find('tr > td:first-child input:checkbox')
	.each(function(){
		this.checked = that.checked;
		$(this).closest('tr').toggleClass('selected');
	});

});
function filter() {
                  // Declare variables
                  var input, filter, table, tr, td, i;
                  input = document.getElementById("search-field");
                  filter = input.value.toUpperCase();
                  table = document.getElementById("tablelist");
                  tr = table.getElementsByTagName("tr");

                  // Loop through all table rows, and hide those who don't match the search query
                  for (i = 0; i < tr.length; i++) {
                  	td = tr[i].getElementsByTagName("td")[1];
                  	if (td) {
                  		console.log(td);
                  		if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                  			console.log(tr[i].style.display);
                  			tr[i].style.display = "";
                  		} else {
                  			console.log(tr[i].style.display);
                  			tr[i].style.display = "none";
                  		}
                  	}
                  }
              }

              function selectall()
              {
								// 
              	// if(document.tabledata.del.checked==true)
              	// {
              	// 	var chks = document.getElementsByName('delall[]');
								//
              	// 	for(i=0;i<chks.length;i++)
              	// 	{
              	// 		chks[i].checked=true;
              	// 	}
              	// }
              	// else if(document.tabledata.del.checked==false)
              	// {
              	// 	var chks = document.getElementsByName('delall[]');
								//
              	// 	for(i=0;i<chks.length;i++)
              	// 	{
              	// 		chks[i].checked=false;
              	// 	}
              	// }
              }


              function IsNumber(a)
              {
              	var reg = /^\d+$/;
              	if(reg.test(a))
              	{
              		return true;
              	}
              	else{return false;}
              }

              /* show image just after image uploaded */
              function getFile(file)
              {
              	console.log(file);
              	if (file)
              	{
              		var reader = new FileReader();

              		reader.onload = function (e)
              		{
              			var totalImg=$('#files img').length;
              			var imgId=totalImg+i;
              			var html='';
              			if(e.target.result.search('image')>0)
              			{
              				var html=generateHtml(imgId);
              				$('.card-deck').append(html);
              			}

              		};
              		reader.readAsDataURL(file);
              	}
              }


              /* img-browse */
              var counter=0;
              $('.img-upload').click(function(){
              	$(this).addClass("img-browse-"+counter);
              	$('.img-browse').addClass("img-browse-"+counter).clone().insertAfter();
              	counter++;
              });
