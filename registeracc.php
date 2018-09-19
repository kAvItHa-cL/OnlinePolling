<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Online Voting</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets/css/headers/header-default.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/parallax-slider/css/parallax-slider.css">
    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>	

<body>
<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="index.html">
                <img src="assets/img/a.png" alt="Logo">
            </a>
            <!-- End Logo -->
            
            <!-- Topbar -->
            <div class="topbar">
                <ul class="loginbar pull-right">
                    <!--<li><a href="page_login.html">Login</a></li> -->  
                </ul>
            </div>
            <!-- End Topbar -->

          
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
                        <a href="admin/login.html" class="" >
                            Admin Login
                        </a>
                    </li>
					<li class="">
                        <a href="login.html" class="" >
                            User Login
                        </a>
                    </li>
					<li class="">
                        <a href="registeracc.php" class="" >
                            User Registration
                        </a>
                    </li>
					
					<li class="">
                        <a href="about.html" class="" >
                            About
                        </a>
                    </li>

                    

                    
                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
    <!--=== End Header ===-->
	    <!--=== Breadcrumbs ===-->
   
     <!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->
	
	<!--=== Content Part ===-->
    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <form action="registeracc.php" method="post" onsubmit="return registerValidate(this)">';
                    <div class="reg-header">
                        <h2>Register a new account</h2>
                        <p>Already Signed Up? Click <a href="login.html" class="color-green">Sign In</a> to login your account.</p>                    
                    </div>

                    <label>First Name</label>
                    <input type="text" class="form-control margin-bottom-20" name='firstname' maxlength='15' value='' placeholder='First Name'onkeypress="return alphaonly(this,event)" required="required">

                   
                    <label>Last Name</label>
                    <input type="text" class="form-control margin-bottom-20" name='lastname' maxlength='15' value='' placeholder='Last Name' onkeypress="return alphaonly(this,event)" required="required">
					
                   <label>User Name </label>
                    <input type="text" class="form-control margin-bottom-20" name='username' maxlength='15' value='' placeholder='User Name' onkeypress="return alphaonly(this,event)" required="required">
					
                    <label>Email Address <span class="color-red">*</span></label>
	                 <input type="email" class="form-control margin-bottom-20" name='email' maxlength='100' value='' placeholder='Email Address' required="required">

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Password <span class="color-red">*</span></label>
                            <input type="password" class="form-control margin-bottom-20" name='password' maxlength='15' value='' placeholder='Password' required="required">
                        </div>
                        <div class="col-sm-6">
                            <label>Confirm Password <span class="color-red">*</span></label>
                            <input type="password" class="form-control margin-bottom-20" name='ConfirmPassword' maxlength='15' value='' placeholder='Confirm Password' required="required">
                        </div>
                    </div>


                    <div class="row">
                        
                        <div class="col-lg-12 text-right">
                            <button class="btn-u" type="submit" name='submit'>Register</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/container-->		
    <!--=== End Content Part ===-->
	<?php
error_reporting(E_ALL ^ E_NOTICE);
$con = mysqli_connect('localhost', 'root', '') or die(mysql_error());
mysqli_select_db($con, 'polling') or die(mysql_error());

//Process
if (isset($_POST['submit']))
{

$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] );
$myUserName = addslashes( $_POST['username'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];
$myPassword = $_POST['password'];

$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

$result1 = mysqli_query($con, "SELECT * FROM tbmembers1 WHERE user_name='$myUserName'");
$num1 = mysqli_num_rows($result1);
$result2 = mysqli_query($con, "SELECT * FROM tbmembers1 WHERE email='$myEmail'");
$num2 = mysqli_num_rows($result2);
if($num1 > 0) {
echo "<script>alert('User name already exists please choose different one');document.location='registeracc.php'</script>"; 
 // die( "<h2>User name already exists please choose different one <br><h2>Go to</h2> <a href=\"registeracc.php\"><h2>Register</h2></a>");;
}
if($num2 > 0) {
echo "<script>alert('E-Mail already exists please choose different one');document.location='registeracc.php'</script>"; 
   //die( "<h2>E-Mail already exists please choose different one<br>Go to</h2> <a href=\"registeracc.php\"><h2>Register</h2></a> ");
}

if(num1 == 0 && num2 == 0){
$sql = mysqli_query($con, "INSERT INTO tbmembers1(first_name, last_name, user_name, email, password, pass_word) VALUES ('$myFirstName','$myLastName', '$myUserName', '$myEmail', '$newpass', '$myPassword')" )
    or die( "<h1>User With Same Email Id Exists..!!!<br> Registration Failed Go to <a href=\"registeracc.php\">Register Here</a>" );
echo "<script>alert('You have registered for an account Go to Login >');document.location='login.html'</script>";
	//die( "<h3>You have registered for an account.<h1><br><br><h3>Go to<h3> <a href=\"login.html\"><h2>Login</h2></a>" );
   }
}
echo '<div id="login">';
echo '<div id="triangle"></div>';

echo "</tr></td></table>";
echo "</form></div>";
?>
	
<script>
function digitonly(input,event)
{	
			
			var keyCode = event.which ? event.which : event.keyCode;
			var lisShiftkeypressed = event.shiftKey;
			if(lisShiftkeypressed && parseInt(keyCode) != 9){return false;}
			if((parseInt(keyCode)>=48 && parseInt(keyCode)<=57) || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ || keyCode==8/*BCKSPC*/ || keyCode==46/*DEL*/ || keyCode==9/*TAB*/  || keyCode==45/*minus sign*/ || keyCode==43/*plus sign*/){return true;}		
			alert("Enter Digits Only");	
        	input.focus();
			return false;			
}
function alphaonly(input,event)
{
			
			var keyCode = event.which ? event.which : event.keyCode;
			//Small Alphabets
			if(parseInt(keyCode)>=97 && parseInt(keyCode)<=122){return true;}
			//Caps Alphabets
			if(parseInt(keyCode)>=65 && parseInt(keyCode)<=90){return true;}
			if(parseInt(keyCode)==32 || parseInt(keyCode)==13 || parseInt(keyCode)==46 || keyCode==9/*TAB*/ || keyCode==8/*BCKSPC*/ || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ ){return true;}
			alert("Only Alphabets are allowed")	
			input.focus();
			return false;
}



  </script>