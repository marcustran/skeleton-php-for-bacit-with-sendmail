<?php
/* The activities that you have signed up */
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

<h1>The button element - Styled with CSS</h1>

<button onclick="window.location.href='activityForm.php'" class="button button1">Add new activity</button>
<button onclick="window.location.href='enrollForm.php'" class="button button1">Enroll on a activity</button>


</body>
</html>



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
<?php
$sql = "
SELECT activities.activityDescription, activities.startDate, 
activities.endDate, activities.activityName
from activities
join activities_bridge on activities_bridge.activityID = activities.activityID
join member on member.memberID = activities_bridge.memberID
  Where member.memberID = '{$_SESSION['memberID']}'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<H2>" . $row["activityName"] . "</H2>";
    echo "Start: " . $row["startDate"]. " end: " . $row["endDate"]. "<br>";
    echo "<p></p>";
    echo "<h3> Description </h3> ";
    echo "<p>" . $row["activityDescription"] . "</p>";

  }
} else {
  echo "0 results";
}
$mysqli->close();

?>
