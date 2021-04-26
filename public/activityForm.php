<?php
/* ADD A NEW ACTIVITY */
require_once "config.php";

session_start();

$startDate = $endDate = $activityDescription =  "";
$startDate_err = $endDate_err = $activityDescription_err =  "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 


    if(empty(trim($_POST["startDate"]))){
        $startDate_err = "Please enter the start date.";
    } else{
        $startDate = trim($_POST["startDate"]);
    }


    if(empty(trim($_POST["endDate"]))){
        $endDate_err = "Please enter the end date.";
    } else{
        $endDate = trim($_POST["endDate"]);
    }


     if(empty(trim($_POST["activityDescription"]))){
        $activityDescription_err = "Please enter the activity description.";
    } else{
         $activityDescription = trim($_POST["activityDescription"]);
    }
    
    if(empty(trim($_POST["activityName"]))){
        $activityName_err = "Please enter the activity description.";
    } else{
         $activityName = trim($_POST["activityName"]);
    }


    
    


    if(empty($startDate_err) ){
        
        
        $sql = "INSERT INTO activities (startDate, endDate, activityDescription) VALUES (?,?,?)";
         
        if($stmt = $mysqli->prepare($sql)){
            
            $stmt->bind_param("sss", $param_startDate, $param_endDate, $param_activityDescription);
            
        
            $param_startDate = $startDate;
            $param_endDate = $endDate;
            $param_activityDescription = $activityDescription;
            //$param_activityName = $activityName;
            
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

    $mysqli->close();
}
?>
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


            <?php echo (!empty($startDate));?>
                <label>Start date</label>
                <input type="date" name="startDate"  value="<?php echo $startDate; ?>">
                <p><?php echo $startDate_err; ?></p>

            <?php echo (!empty($endDate));?>
                <label>End date</label>
                <input type="date" name="endDate"  value="<?php echo $endDate; ?>">
                <p><?php echo $endDate_err; ?></p>


            <?php echo (!empty($activityDescription));?>
                <label>description</label>
                <input type="text" name="activityDescription"  value="<?php echo $activityDescription; ?>">
                <p><?php echo $activityDescription_err; ?></p>

            <?php echo (!empty($activityName));?>
                <label>Activity Name</label>
                <input type="text" name="activityName"  value="<?php echo $activityName; ?>">
                <p><?php echo $activityName_err; ?></p>

                


                <input type="submit" value="Submit">

        </form>  
</body>
</html>