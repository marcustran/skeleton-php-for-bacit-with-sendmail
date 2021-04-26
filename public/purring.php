<? 
/* Sends mail to all the unactive members reminding them to pay so they can be set to active. */


require_once "config.php";

session_start(); ?> 

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


<?
$sql = "SELECT * FROM member LIMIT 100";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["memberID"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. "<br>";
    if($row["status"] == "Inactive"){
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "test@gmail.com";
    $to = $row["email"];
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    //$headers = "From:" . $from;
    $headers = 'From:' . $from . "\r\n" .
    'Reply-To: dacluv@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($to,$subject,$message, $headers);
    echo "A overdue notice have been sent to " . $row["firstName"] ;
    }}
} else {
  echo "0 results";
}?>