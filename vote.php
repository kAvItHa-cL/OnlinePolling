

<?php
$link = mysql_connect('localhost', 'root', '') or die(mysql_error());

mysql_select_db('polling') or die(mysql_error());

session_start();

ob_clean();

if(isset($_SESSION['member_id'])){
 header("location:access-denied.php");
ob_end_clean();

}

?>
<?php
// retrieving positions sql query
global $cposition;
global $cname;
$positions=mysql_query("SELECT * FROM tbpositions")
or die("There are no records to display ... \n" . mysql_error()); 
?>
<?php
    // retrieval sql query
// check if Submit is set in POST
 if (isset($_POST['Submit']))
 {
 // get position value
 $position = addslashes( $_POST['position'] ); //prevents types of SQL injection
 $cposition = $position;
 // retrieve based on position
 $result = mysql_query("SELECT * FROM tbcandidates WHERE candidate_position='$position'")
 or die(" There are no records at the moment ... \n"); 
 
 // redirect back to vote
 //header("Location: vote.php");
 }
 else
 // do something
  
?>

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
                        <a href="login.html" class="" >
                            Current Polls
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
	<html><head>
<link href="" rel="" type="" />
<script language="" src="">
</script>
<script type="text/javascript">
function getVote(int)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","save.php?vote="+int,true);
xmlhttp.send();
}

function getPosition(String)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.open("GET","vote.php?position="+String,true);
xmlhttp.send();
}
</script>
<script type="text/javascript">
$(document).ready(function(){
   var j = jQuery.noConflict();
    j(document).ready(function()
    {
        j(".refresh").everyTime(1000,function(i){
            j.ajax({
              url: "admin/refresh.php",
              cache: false,
              success: function(html){
                j(".refresh").html(html);
              }
            })
        })
        
    });
   j('.refresh').css({color:"green"});
});
</script>
</head>
<body>
<table width="420" align="center">
<CAPTION><h3>CURRENT POLLS</h3></CAPTION>
<form name="fmNames" id="fmNames" method="post" action="vote.php" onsubmit="return positionValidate(this)">
<tr>
    <td class="white">CHOOSE POSITION</td>
    <td><SELECT NAME="position" id="position" class="btn btn-default dropdown-toggle" data-toggle="dropdown"onclick="getPosition(this.value)">
    <OPTION VALUE="select">select
    <?php 
    //loop through all table rows
    while ($row=mysql_fetch_array($positions)){
    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
    //mysql_free_result($positions_retrieved);
    //mysql_close($link);
    }
    ?>
    </SELECT></td>
    <td><button	class='btn-u' type="submit" name="Submit"/>See Candidates</td>
</tr>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
</tr>
</form> 
</table>
<table width="270" align="center">
<form action='vote.php' method='POST'>
<tr>
    <th></th>
</tr>

<tr>
    
    <td>&nbsp;</td>
</tr>
</table>

<?php
//loop through all table rows
//if (mysql_num_rows($result)>0){
  if (isset($_POST['Submit'])){
  $count = 0;
echo "<center><table border='0'>";
echo "<h3>CANDIDATES</h3>";
while ($row=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['candidate_name']."</td>";
echo "<td><input type='radio' name='vote' value='$row[candidate_name]' onclick='getVote(this.value)'/></td>";
echo "</tr>";
$count++;
}
echo "</table><br>";
if($count > 0) {
echo "<input type='hidden' name='Position' value='$cposition'><button	class='btn-u' input type='submit' name='uvote' </button>Cast Vote";
} else { echo "<h2>There are no elections going on for this post. Please visit again sometime soon.</h2>"; }
echo "</center></form>";
mysql_free_result($result);
mysql_close($link);
//}
 }
else
// do nothing
?>
</div>

</div>
</body>
</html>