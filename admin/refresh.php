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
                        <a href="index.php" class="" >
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
error_reporting(E_ALL ^ E_NOTICE);
$con = mysqli_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysqli_select_db($con, "polling");
?>
<?php

// retrieving candidate(s) results based on position
if (isset($_POST['Submit'])){   
/*
$resulta = mysql_query("SELECT * FROM tbCandidates where candidate_name='Luis Nani'");

while($row1 = mysql_fetch_array($resulta))
  {
  $candidate_1[0]=$row1['candidate_cvotes'];
  }
  */
  global $count;
  global $candidate_name_1;
  global $candidate_1;
  $candidate_name_1 = array();
  $candidate_1 = array();
  $position = addslashes( $_POST['position'] );
    $count=0;
    $results = mysqli_query($con, "SELECT * FROM tbCandidates where candidate_position='$position'");
    $i = 0;
    while ($row=mysqli_fetch_array($results)){
	  $candidate_name_1[$i] = $row['candidate_name'];
	  $candidate_1[$i] = $row['candidate_cvotes'];
	  $i++;
	  $count++;
	}
	}
    else
        // do nothing
?> 
<?php
// retrieving positions sql query
$positions=mysqli_query($con, "SELECT * FROM tbPositions")
or die("There are no records to display ... \n" . mysql_error()); 
?>
<?php
session_start();
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}
?>

<?php if(isset($_POST['Submit'])){$totalvotes=$candidate_1[0]+$candidate_1[1];} ?>

<!DOCTYPE html>
<table width="420" align="center">
<CAPTION><h3>RESULTS</h3></CAPTION>
<form name="fmNames" id="fmNames" method="post" action="refresh.php" onsubmit="return positionValidate(this)">
<tr>
    <td>CHOOSE POSITION</td>
    <td><SELECT REQUIRED NAME="position" id="position"class="btn btn-default dropdown-toggle" data-toggle="dropdown">select
    <OPTION VALUE="select">select
	
    <?php 
    //loop through all table rows
    while ($row=mysqli_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]</OPTION>"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT></td>
    <td><button class="btn-u" input type="submit" name="Submit">See Results</td>
	
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<?php 
$i = 0;
$flag = 0;
if(isset($_POST['Submit'])){
while($i < $count) {
   $width = 0;
   $count1 = 0;
   echo "<br>$candidate_name_1[$i]<br>";
   if($candidate_1[$i] != 0) {
     for($num=0; $num < $count; $num++) {
		$count1+=$candidate_1[$num];
	 }
	 if($count1 != 0) {
		$width = (100*round($candidate_1[$i]/($count1),2));
	 }	    
   } 
			echo "<br><img src='images/candidate-1.gif' width='$width' height='20'>";
	        echo"$width% of ";
		    echo $totalvotes;
            echo " total votes"; 
			echo "<br>votes ";
            echo $candidate_1[$i]."<br>";
			$i++;
   }
} 
?>
</div>
</div>
</body></html>