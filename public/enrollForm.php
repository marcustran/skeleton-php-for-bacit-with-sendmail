<?php
/* Form to registrer to a activity by using activity ID */
require_once "config.php";

session_start();

$activityID =  "";
$activityID_err =  "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["activityID"]))){
        $activityID_err = "Please enter a username.";
    } else{
        // forbreder select statement
        $sql = "SELECT * FROM activities WHERE activityID = ?";
        
        if($stmt = $mysqli->prepare($sql)){
        
            $stmt->bind_param("s", $param_activityID);
            
            
            $param_activityID = trim($_POST["activityID"]);
            
            
            if($stmt->execute()){
                
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $activityID = trim($_POST["activityID"]);
                } else{
                    $activityID_err = "This activity does not exist ";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            $stmt->close();
        }
    }
    
    


    if(empty($activityID_err)){
    
       

        $sql = "INSERT INTO activities_bridge (activityID, memberID) VALUES (?,?)";
         
        if($stmt = $mysqli->prepare($sql)){
    
            $stmt->bind_param("ii", $param_activityID, $param_memberID);
            
            $param_activityID = $activityID;
            $param_memberID = $_SESSION["memberID"];
            
            if($stmt->execute()){
                
                header("location: activities.php");
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <?php echo (!empty($activityID));?>
                <label>Activity Name</label>
                <input type="text" name="activityID"  value="<?php echo $activityID; ?>">
                <p><?php echo $activityID_err; ?></p>

                


                <input type="submit" value="Submit">

        </form>  
</body>
</html>