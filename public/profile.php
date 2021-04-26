<?php
/* standard profile page */
//etablishing connection
include("config.php");
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="stylesheet.css" rel="stylesheet">
</head>
<body>

<ul>
  <li><a class="active" href="welcome.php">Home</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="members.php">Members</a></li>
  <li><a href="payment.php">Payment</a></li>
  <li><a href="activities.php">Activities</a></li>
  <li><a href="logout.php">Signout</a></li>
  <li><a href="purring.php">Billing</a></li>
  <li><a href="interest.php">Interest</a></li>
</ul>

</body>
</html>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->

<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src='<?php echo ($_SESSION["image_src"]); ?>'  class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                         <b><?php echo htmlspecialchars($_SESSION["firstName"]); ?></b> <b><?php echo htmlspecialchars($_SESSION["lastName"]); ?></b>.
					</div>
					<div class="profile-usertitle-job">
						<!-- ASSIGN ROLE FOR INSTANCE ADMIN LEADER MEMBER  -->
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li>
							<a href="changeProfile.php">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
			   <?php
				 echo "<li> email: " . $_SESSION["email"] . "</li>" ;  
				 echo "<li> firstname:" . $_SESSION["firstName"] . "</li>" ;
				 echo "<li> lastName: " . $_SESSION["lastName"] . "</li>" ;
				 echo "<li> streetName:" . $_SESSION["streetName"] . "</li>" ;
				 echo "<li> city: " . $_SESSION["city"] . "</li>" ;
				 echo "<li> postal code: " . $_SESSION["postalCode"] . "</li>" ;
				 echo "<li> Gender: " . $_SESSION["gender"] . "</li>" ;
				 echo "<li> Date of birth: " . $_SESSION["DoB"] . "</li>" ;
				 echo "<li> Phone: " . $_SESSION["phone"] . "</li>" ;
			   ?>
            </div>
		</div>
	</div>
</div>
<center>
<strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
</center>
<br>
<br>
<!-- taken from https://bootsnipp.com/snippets/M48pA -->
