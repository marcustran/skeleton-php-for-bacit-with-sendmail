<?php
/* List all availible interests */
//etablishing connection
include("config.php");
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  echo(" you dont have the access to this page atm redirecting to index.php");
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
</ul>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<link href="stylesheet.css" rel="stylesheet">
</head>
<body>

<h1>Interest</h1>
<p> In this page you can manage ur interest, if you cant find yours in the list just add one :)</p>

<button onclick="window.location.href='interestForm.php'" class="button button1">Add new interest</button>
<button onclick="window.location.href='newInterestForm.php'" class="button button1">Fill in ur interest</button>


</body>
</html>



<?php
$sql = "SELECT * FROM interest";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "<h1> This is a list of all the availible interest </h1>";
  while($row = $result->fetch_assoc()) {
    echo "<h2>" . " InterestName ". $row["interestName"] . " intrestID : " . $row["interestID"]  .  "</h2>";

  }
} else {
  echo "0 results";
}
$mysqli->close();

?>

