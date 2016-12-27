	</section>
	<footer id="footer">
        Copyright &copy; 2015 Material Admin

        <ul class="f-menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </footer>

    <!-- Page Loader -->
    <div class="page-loader">
        <div class="preloader pls-blue">
            <svg class="pl-circular" viewBox="25 25 50 50">
                <circle class="plc-path" cx="50" cy="50" r="20" />
            </svg>

            <p>Please wait...</p>
        </div>
    </div>

    <!-- notifications -->
    <a class="notifications btn bgm-lightblue btn-icon-text waves-effect"  href="#" class="btn btn-info" data-type="inverse" data-animation-in="animated bounceInRight"  data-animation-Out="animated bounceOutRight">Bounce In Right</a>
    <!--floating button-->
		<?php if(isset($add_page)): ?>
    <div class="float-add-item">
        <a class="btn btn-primary btn-icon waves-effect waves-circle waves-float"
        href="<?php echo $add_page;?>"><i class="<?php echo $list_page_icon;?>"></i></a>
    </div>
	<?php endif; ?>



    <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
            <![endif]-->

            <!-- Javascript Libraries -->
            <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

            <script src="vendors/bower_components/flot/jquery.flot.js"></script>
            <script src="vendors/bower_components/flot/jquery.flot.resize.js"></script>
            <script src="vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
            <script src="vendors/sparklines/jquery.sparkline.min.js"></script>
            <script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

            <script src="vendors/bower_components/moment/min/moment.min.js"></script>
            <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
            <script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
            <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
            <script src="vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
            <script src="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
            <script src="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

						<script src="vendors/bootgrid/jquery.bootgrid.updated.min.js"></script>
						<script src="vendors/bower_components/lightgallery/light-gallery/js/lightGallery.min.js"></script>
						<script src="vendors/bower_components/moment/min/moment.min.js"></script>
						<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
						<script src="vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>
						<script src="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
						<script src="vendors/bower_components/typeahead.js/dist/typeahead.bundle.min.js"></script>
						<script src="vendors/summernote/dist/summernote-updated.min.js"></script>


						<!-- Placeholder for IE9 -->
						<!--[if IE 9 ]>
						<script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
						<![endif]-->

						<script src="vendors/bower_components/chosen/chosen.jquery.min.js"></script>
						<script src="vendors/fileinput/fileinput.min.js"></script>
						<script src="vendors/input-mask/input-mask.min.js"></script>
						<script src="vendors/farbtastic/farbtastic.min.js"></script>


            <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
            <![endif]-->

            <script src="js/flot-charts/curved-line-chart.js"></script>
            <script src="js/flot-charts/line-chart.js"></script>
            <script src="js/charts.js"></script>

            <script src="js/charts.js"></script>
            <script src="js/functions.js"></script>
            <script src="js/demo.js"></script>

            <!-- core JavaScript -->
            <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
            <!-- PAGE LEVEL PLUGINS JS -->
            <script src="assets/js/plugins/footable/footable.min.js"></script>
            <!-- REQUIRE FOR SPEECH COMMANDS -->
            <!-- initial page level scripts for examples -->
            <script src="assets/js/plugins/footable/footable.init.js"></script>
            <script src="js/general.js"></script>
            <script>
    //for tables checkbox demo
    jQuery(function($) {

			/*notification params*/
			var nFrom = $('.notifications').attr('data-from');
			var nAlign = $('.notifications').attr('data-align');
			var nIcons = $('.notifications').attr('data-icon');
			var nType = $('.notifications').attr('data-type');
			var nAnimIn = $('.notifications').attr('data-animation-in');
			var nAnimOut = $('.notifications').attr('data-animation-out');



            var ids=[];
            var firebaseDatabase = firebase.database();
            var studentsRef = firebaseDatabase.ref('/students');
						// var ordersRef = firebaseDatabase.ref('/orders');
						// var usersRef = firebaseDatabase.ref('/users');

            newItems=false;
            studentsRef.on('child_added', function(message) {
              if (!newItems) return;
              var datas = message.val();
              console.log("child_added");
              $.each(message.val(),function(key,data){
                console.log(key+"-  "+data);
              });


            });



						// usersRef.on('value', function(snapshot) {
						// 	console.log(snapshot.val());
						// 		$.each(snapshot.val(),function(key,data){
						//
						// 				if(key!==''){
						// 					console.log(data);
						// 						var request = $.ajax({
						// 							url: "server/firebaseDatabase.php",
						// 							method: "POST",
						// 							data: {"type":"orders","key":key,"data":data}
						// 					});
						// 						request.done(function( msg ) {
						//
						// 								if(msg ===''){
						// 										console.log("empty");
						// 								}else{
						// 										console.log(typeof msg);
						// 										console.log(msg);
						// 								}
						//
						// 					});
						//
						// 						request.fail(function( jqXHR, textStatus ) {
						//
						// 					});
						// 				}
						// 		});
						// });
						// ordersRef.on('value', function(snapshot) {
						// 		$.each(snapshot.val(),function(key,data){
						// 				console.log(data);
						// 		});
						// });


            studentsRef.on('value', function(snapshot) {
                $.each(snapshot.val(),function(key,data){

                    if(key!==''){
                        //console.log(data);
                        var request = $.ajax({
                          url: "server/firebaseDatabase.php",
                          method: "POST",
                          data: {"type":"students","key":key,"data":data}
                      });
                        request.done(function( msg ) {

                            if(msg ===''){
                                console.log("empty");
                            }else{
                                console.log(typeof msg);
                                console.log(msg);
                            }

                      });

                        request.fail(function( jqXHR, textStatus ) {

                      });
                    }
                });
            });

            function notify(data){

            }

            /*
             * Notifications
             */
             function notify(from, align, icon, type, animIn, animOut,title,message,url){
                $.growl({
                    icon: icon,
                    title: title,
                    message: message,
                    url: url
                },{
                    element: 'body',
                    type: type,
                    allow_dismiss: true,
                    placement: {
                        from: from,
                        align: align
                    },
                    offset: {
                        x: 20,
                        y: 85
                    },
                    spacing: 10,
                    z_index: 1031,
                    delay: 2500,
                    timer: 1000,
                    url_target: '_blank',
                    mouse_over: false,
                    animate: {
                        enter: animIn,
                        exit: animOut
                    },
                    icon_type: 'class',
                    template: '<div data-growl="container" class="alert" role="alert">' +
                    '<button type="button" class="close" data-growl="dismiss">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '<span class="sr-only">Close</span>' +
                    '</button>' +
                    '<span data-growl="icon"></span>' +
                    '<span data-growl="title"></span>' +
                    '<span data-growl="message"></span>' +
                    '<a href="#" data-growl="url"></a>' +
                    '</div>'
                });
            };

            $('.notifications').click(function(e){
                e.preventDefault();

            });

            /*notifications*/

            // setInterval(function(){
            //     notify(nFrom, nAlign, nIcons, nType,nAnimIn,nAnimOut,"NEW ORDER!!!","  TBL120","add-students.php");
            // },5000);






        });
    </script>



</body>

</html>
