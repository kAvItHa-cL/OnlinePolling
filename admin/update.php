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
                <img src="../assets/img/a.png" alt="Logo">
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
                        <a href="manage_admin.php" class="" >
                           Manage Administrator
                        </a>
                    </li>
					
					<li class="">
                        <a href="position.php" class="" >
                          add Positions
                        </a>
                    </li>
					<li class="">
                        <a href="candidates.php" class="" >
                         add Candidates
                        </a>
                    </li>
					<li class="">
                        <a href="refresh.php" class="" >
                             Results
                        </a>
                    </li>
					<li class="">
                        <a href="update.php" class="" >
                             Updates
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

if(isset($_POST['Submit']))
{   
  
   $title=$_POST['title'];	
   $description=$_POST['txt_description'];
   
   
   include("connection.php");

  $q = "insert into recent_updates values('$title','$description');";
	
	$r = mysql_query($q) or die("Failed to execute the query");

 // echo '<script language="javascript">alert("Record Added.");</script>';

echo "<script>alert('Updated to Home Page');document.location='update.php'</script>";
}

?>
  <!--=== Content Part ===-->
    <div class="container content">		
    	<div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <form  method="post" action="<?php echo($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
                    <div class="reg-header">            
                        <h2>RECENT UPDATES</h2>
                    </div>

                   <label>Title</label>
                    <input type="text" class="form-control margin-bottom-20" name='title' maxlength='15' value='' placeholder='Title'onkeypress="return alphaonly(this,event)" required="required">

                   
                    <label>Description</label>
                      <textarea name="txt_description" class="form-control margin-bottom-20" width="266" name='lastname' maxlength='100' value='' placeholder='Description' onkeypress="return alphaonly(this,event)" required="required"></textarea>
                    <div class="row">
                       
                        <div class="col-md-12">
                            <button class="btn-u pull-right" type="submit" name="Submit"> Update </button>                        
                        </div>
                    </div>
					<div class="reg-header">
                       
                        <p></p>                    
                    </div>
                </form>            
            </div>
        </div><!--/row-->
    </div><!--/container-->		
    <!--=== End Content Part ===-->
                 
                </div>
            </div> 
        </div><!--/copyright-->
    </div>
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

   
 

 











