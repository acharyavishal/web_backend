<?php 
require_once '../config.php';
$errorAuth = '';

if(isset($_REQUEST['login'])){
    $eroare=0;
    $u_name = addslashes($_POST['username']);
    $pass = addslashes($_POST['password']);
    $sql="select * from user where email ='".$u_name."' or name='".$u_name."' ";
    $res=$db->Query($sql);
    $rows=mysql_num_rows($res);
    if($rows>0){
        $rs = mysql_fetch_assoc($res);
        if(mc_decrypt($rs["password"],ENCRYPTION_KEY) == $pass)
        {
            session_start();
            $_SESSION['id_user'] = $rs["id_user"];
            $_SESSION['username'] = $rs["name"];
            $redirect="home.php";
            header("location:$redirect");
        }

        else{
            $errorAuth = "Invalid";
        }
    }

}
?>


<?php 

if((!empty($_POST)) && isset($_POST["btnsubmit"])){
    require_once("../config.php");
    $db = new Database();
    $tablename = "user";   
    $txtname=$_POST["username"];
    $txtemail=$_POST["email"];
    $contactno=$_POST["contactno"];
    $password=mc_encrypt($_POST["password"], ENCRYPTION_KEY);
    $chkflg=1;
    $dt1=date("Y-m-d");

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
        {   
            $menu_id=$rs['menu_id'];
              if($rs['menu_id']!=4){
                $tablename="admin_rights";
                $data_rights = array(
                    "id_user"=>$id_user,
                    "menu_id"=>$menu_id,
                    "createdate"=>$dt2  
                    );
                $db->Insert($data_rights,$tablename);                                           
            }   
        } 
    }

    session_start();
    $_SESSION['id_user'] = $id_user;
    $_SESSION['username'] = $txtname;
    header("Location: home.php");

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Vendor CSS -->
    <link href="vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="css/app.min.1.css" rel="stylesheet">
    <link href="css/app.min.2.css" rel="stylesheet">
    <link href="css/style_custom.css" rel="stylesheet">

</head>
<body class="login-content">
    <!-- Login -->

    <div class="lc-block toggled" id="l-login">
        <form role="form" action="" method="post">  
         <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                <input type="text" name='username' class="form-control" placeholder="Username">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                <input type="password" name='password' class="form-control" placeholder="Password">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
                Keep me signed in
            </label>
        </div>

        <a href="#" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></a>
        <input type="submit" class='login' name="login" value="Login" style='display:none;!important;opacity:0;' />
        <ul class="login-navigation">
            <li data-block="#l-register" class="bgm-red">Register</li>
            <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
        </ul>
    </form>
</div>

<!-- Register -->
<div class="lc-block" id="l-register">
    <form role="form" action="" method="post">  
        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
            <div class="fg-line">
                <input type="text" name='username' class="form-control" placeholder="Username">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <div class="fg-line">
                <input type="text" name='email' class="form-control" placeholder="Email Address">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <div class="fg-line">
                <input type="text" name='contactno' class="form-control" placeholder="Contact">
            </div>
        </div>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
            <div class="fg-line">
                <input type="password" name='password' class="form-control" placeholder="Password">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="checkbox">
            <label>
                <input type="checkbox" value="">
                <i class="input-helper"></i>
                Accept the license agreement
            </label>
        </div>

        <a href="#" class="btn btn-login btn-danger btn-float register"><i class="zmdi zmdi-arrow-forward"></i></a>
        <button class="register" name="btnsubmit" type="submit" style='display:none;opacity:0;'></button>
        <ul class="login-navigation">
            <li data-block="#l-login" class="bgm-green">Login</li>
            <li data-block="#l-forget-password" class="bgm-orange">Forgot Password?</li>
        </ul>
    </form>
</div>

<!-- Forgot Password -->
<div class="lc-block" id="l-forget-password">
    <form role="form" action="" method="post">  
        <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>

        <div class="input-group m-b-20">
            <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
            <div class="fg-line">
                <input type="text" class="form-control" placeholder="Email Address">
            </div>
        </div>

        <a href="#" class="btn btn-login btn-danger btn-float"><i class="zmdi zmdi-arrow-forward"></i></a>

        <ul class="login-navigation">
            <li data-block="#l-login" class="bgm-green">Login</li>
            <li data-block="#l-register" class="bgm-red">Register</li>
        </ul>
    </form>
</div>
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

            <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>

            <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
            <![endif]-->

            <script src="js/functions.js"></script>


            <script>
                $('a.btn-login').click(function(){
                    $('input[type="submit"]').trigger('click'); 
                });
                $('a.register').click(function(){
                    $('button.register').trigger('click');  
                });
            </script>

        </body>

        <!-- Mirrored from 192.185.228.226/projects/ma/1-5-2/jquery/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Dec 2015 09:29:15 GMT -->
        </html>