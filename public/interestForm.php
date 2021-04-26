<?php
/* Add a interest if not allready in the list */
require_once "config.php";

session_start();

$interestName = "";
$interestName_err =  "";
 
// prosseserer formen
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["interestName"]))){
        $interestName_err = "Please enter the activity description.";
    } else{
         $interestName = trim($_POST["interestName"]);
    }


    if( empty($activityDescription_err) ){
        
        //USING IGNORE IN CASE DUPLICATE ENTRIES
        $sql = "INSERT IGNORE INTO interest (interestName) VALUES (?)";
         
        if($stmt = $mysqli->prepare($sql)){
            
            $stmt->bind_param("s", $param_interestName);
            
        
            $param_interestName = $interestName;
            
            if($stmt->execute()){
                header("location: interest.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            
            $stmt->close();
        }
    } else {
        echo "NOE GIKK GALT SOM FAEN";
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
        <h2>Add interest</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <?php echo (!empty($interestName));?>
                <label>Sumbit ur interest</label>
                <input type="text" name="interestName"  value="<?php echo $interestName; ?>">
                <p><?php echo $interestName_err; ?></p>

                


                <input type="submit" value="Submit">

        </form>  
</body>
</html>