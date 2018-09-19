<!DOCTYPE html> 
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Online voting</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="../assets/css/headers/header-default.css">
    <link rel="stylesheet" href="../assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="../assets/plugins/animate.css">
    <link rel="stylesheet" href="../assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="../assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <!--[if lt IE 9]><link rel="stylesheet" href="../assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../assets/css/custom.css">
</head>

<body>    
<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <img src="../assets/img/a.png" alt="Logo">
            </a>
            <!-- End Logo -->
            
            <!-- Topbar -->
            <div class="topbar">
                <ul class="loginbar pull-right">
                    <!--<li><a href="page_login.html">Login</a></li> -->  
                </ul>
            </div>
            

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

         <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">
                     <!-- Home -->
                    <li class="">
                     <a href="index.php" class="">
                            Home
                        </a>
                    </li>
                    <!-- End Home -->
					<li class="">
                        <a href="manage_admin.php" class="" >
                           Manage Administrator
                        </a>
                    </li>
					
					<li class="">
                        <a href="position.php" class="" >
                          Add Positions
                        </a>
                    </li>
					<li class="">
                        <a href="candidates.php" class="" >
                         Add Candidates
                        </a>
                    </li>
					<li class="">
                        <a href="refresh.php" class="" >
                             Results
                        </a>
                    </li>
					<li class="">
                        <a href="logout.php" class="" >
                           Logout
                        </a>
                    </li>

                    
                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->
<?php
@mysql_connect('localhost', 'root', '') or die(@mysql_error());
@mysql_select_db('polling') or die(@mysql_error());

session_start();
ob_clean();
ob_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
ob_end_clean();
 }

//Process
if (isset($_POST['submit']))
{

$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];
$myPassword = $_POST['password'];

//$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

$sql = @mysql_query( "INSERT INTO tbAdministrators(first_name, last_name, email, password) VALUES ('$myFirstName','$myLastName', '$myEmail', '$myPassword')" )
        or die( mysql_error() );

die( "<center><h1>A new administrator account has been created.</h1></center>" );
}
//Process
if (isset($_GET['id']) && isset($_POST['update']))
{
$myId = addslashes( $_GET['id']);
$myEmail = $_POST['email'];
$myPassword = $_POST['password'];

//$newpass = ($myPassword); //This will make your password encrypted into md5, a high security hash

$sql = @mysql_query( "UPDATE tbAdministrators SET email='$myEmail', password='$myPassword' WHERE admin_id = '$myId'" )
        or die( @mysql_error() );

die( "<center><h1>An administrator account has been updated.</h1></center>" );
}
?>                   

                            

                    <!-- Pages -->        
					</ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->

   
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">
        <div class="row">
            

            <!-- Begin Content -->
            <div class="col-md-14">
                <div class="row margin-bottom-40">
                    <div class="col-md-6">
                        <!-- Reg-Form -->
                        <form action="manage_admin.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onsubmit="return updateProfile(this)" class="sky-form">
                            <header>UPDATE ACCOUNT</header>
                            
                            <fieldset>                  
                                <section>
								
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Email address">
                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                                    </label>
                                </section>
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password" placeholder="Password" id="password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                    </label>
                                </section>
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="ConfirmPassword" placeholder="Confirm password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                    </label>
                                </section>
                            </fieldset>
                                
                            
                                
                         
                            </fieldset>
                            <footer>
                                <button type="submit" name="update" class="btn-u">Update Account</button>
                            </footer>
                        </form>         
                        <!-- End Reg-Form -->
                    </div>

                    <!-- Login-Form -->
                    <div class="col-md-6">
                       <form action="manage_admin.php" method="post" onsubmit="return registerValidate(this)" class="sky-form">
                            <header>CREATE ACCOUNT</header>
                            
                            <fieldset> 
                                 <section>
                                    <div class="row">
                                        <label class="label col col-1"></label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-user"></i>
                                                <input type="text" name="firstname" placeholder="First Name">
                                                <b class="tooltip tooltip-bottom-right">Please fill out this field</b>
										   </label>
                                        </div>
                                    </div>
                                </section>
                                  <section>
                                    <div class="row">
                                        <label class="label col col-1"></label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-user"></i>
                                                <input type="text" name="lastname" placeholder="Last Name">
                                            <b class="tooltip tooltip-bottom-right">Please fill out this field</b>
											</label>
                                        </div>
                                    </div>
                                </section>								
                                <section>
                                    <div class="row">
                                        <label class="label col col-1"></label>
										
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-envelope"></i>
                                                <input type="email" name="email" placeholder="E-mail">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
											</label>
                                        </div>
                                    </div>
                                </section>
                                
                                <section>
                                    <div class="row">
                                        <label class="label col col-1"></label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="password" placeholder="Password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
											</label>
                                            
                                        </div>
                                    </div>
                                </section>
                                <section>
								<div class="row">
                                        <label class="label col col-1"></label>
                                        <div class="col col-8">
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="Confirmpassword" placeholder="Confirm password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                    </label>
                                </section>
                                
                            </fieldset>
                            <footer>
                               
                                <button class="btn-u" type="submit" name='submit'>Create Account</button>
                            </footer>
                        </form>         
                        
                        
                    </div>
                    <!-- End Login-Form -->
                </div><!--/end row-->

                

     
</div><!--/End Wrapepr-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="../assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="../assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="../assets/plugins/smoothScroll.js"></script>
<script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery.maskedinput.min.js"></script>
<script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js"></script>
<script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="../assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="../assets/js/app.js"></script>
<script type="text/javascript" src="../assets/js/forms/reg.js"></script>
<script type="text/javascript" src="../assets/js/forms/login.js"></script>
<script type="text/javascript" src="../assets/js/forms/contact.js"></script>
<script type="text/javascript" src="../assets/js/forms/comment.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        RegForm.initRegForm();
        LoginForm.initLoginForm();
        
        });
</script>
<!--[if lt IE 9]>
    <script src="../assets/plugins/respond.js"></script>
    <script src="../assets/plugins/html5shiv.js"></script>
    <script src="../assets/plugins/placeholder-IE-fixes.js"></script>
    <script src="../assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->

<!--[if lt IE 10]>
    <script src="../assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->       

</body>
</html>