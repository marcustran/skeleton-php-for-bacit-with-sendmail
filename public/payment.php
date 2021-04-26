<?php
/* Testing for payment system will set status as active if payment is fulfilled in this case if the creditcard = greedisgood */
require_once "config.php";

session_start();





$creditCard =  "";
$creditCard_err =  "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["creditCard"]))){
        $creditCard_err = "please fill in your creditcard credentials";
    } else{
        $creditCard = trim($_POST["creditCard"]);
    }
    


    if($creditCard == "GreedIsGood"){
    
       

        $sql = "UPDATE member 
        SET status = 'Active'
        WHERE
        memberID= '{$_SESSION['memberID']}'";
         
         if($mysqli->query($sql) === true){
            header("location: paymentConfirmed.php");
            exit;
        } else{
            echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
        }
    } else {
        echo "Payment failed broke BOOI!";
    }
    
    // lukker connection
    $mysqli->close();
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

<!DOCTYPE html>
<!-- HTML FORMEN som blir brukt -->
<html lang="no">
<head>
</head>
<body>    
        <h2>Payment</h2>
        <p>Please fill your credentials to renew ur membership 10$.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <?php echo (!empty($creditCard_err));?>
                <label>Activity Name</label>
                <input type="text" name="creditCard"  value="<?php echo $creditCard; ?>">
                <p><?php echo $creditCard_err; ?></p>

                


                <input type="submit" value="Submit">

        </form>  
</body>
</html>