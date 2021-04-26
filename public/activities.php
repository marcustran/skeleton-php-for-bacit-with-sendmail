<?php
/* Listing all the activities that is availible */
//etablishing connection
include("config.php");
// Initialize the session
session_start();
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
<!DOCTYPE html>
<html>
<head>
<link href="stylesheet.css" rel="stylesheet">
</head>
<body>

<h1>Activities</h1>

<button onclick="window.location.href='activityForm.php'" class="button button1">Add new activity</button>
<button onclick="window.location.href='enrollForm.php'" class="button button1">Enroll on a activity</button>


</body>
</html>



<?php
$sql = "SELECT * FROM activities
  Where startDate > NOW() LIMIT 100";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<H2>" . $row["activityName"] . "</H2>";
    echo "Start: " . $row["startDate"]. " end: " . $row["endDate"]. "<br>";
    echo "<p></p>";
    echo "<h4> Description </h4> ";
    echo "<p>" . $row["activityDescription"] . "</p>";
    echo "<h4>" . " ID: " . $row["activityID"] .  "</h4> ";

  }
} else {
  echo "0 results";
}
$mysqli->close();

?>

