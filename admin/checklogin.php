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
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="../assets/css/headers/header-default.css">
    <link rel="stylesheet" href="../assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="../assets/plugins/animate.css">
    <link rel="stylesheet" href="../assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/parallax-slider/css/parallax-slider.css">
    <link rel="stylesheet" href="../assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

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
                <img src="../assets/img/logo1-default.png" alt="Logo">
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
                            User Register
                        </a>
                    </li>
					<li class="">
                        <a href="contact.html" class="" >
                            Contact Us
                        </a>
                    </li>
					<li class="">
                        <a href="about.html" class="" >
                            About
                        </a>
                    </li>
<?php
error_reporting(E_ALL);

ob_start();
session_start();
$host="localhost"; // Host name
$username="root"; // Database username
$password=""; // Database password
$db_name="polling"; // Database name
$tbl_name="tbadministrators"; // Table name

// This will connect you to your database
$con = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
mysqli_select_db($con, "$db_name")or die("cannot select DB");

// Defining your login details into variables
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$encrypted_mypassword=md5($mypassword); //MD5 Hash for security
// mysqli injection protections
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con,$myusername);
$mypassword = mysqli_real_escape_string($con,$mypassword);

$sql="SELECT * FROM $tbl_name WHERE email='$myusername' and password='$mypassword'" or die(mysqli_error($con));
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
echo("1");
// Checking table row
$count=mysqli_num_rows($result);
// If username and password is a match, the count will be 1

if($count==1){
// If everything checks out, you will now be forwarded to admin.php
$user = mysqli_fetch_assoc($result);
 $_SESSION['admin_id'] = $user['admin_id'];
header("location:index.php");
}
//If the username or password is wrong, you will receive this message below.
else {
echo "<h2>Wrong Username or Password<br><br>Return to </h2><a href=\"login.html\"><h2>login</h2></a>";
}

ob_end_flush();
mysqli_close($con);
?> 
