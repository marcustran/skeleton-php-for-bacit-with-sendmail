<?php
/* Payment confirmation page  */

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
<html lang="no">
<head>
    <title>Welcome</title>
</head>
<body>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["firstName"]); ?></b>. your payment have been accepted.</h1>

    <p>
        <a href="welcome.php" class="container">Back to welcome screen</a>
    </p>
</body>
</html>