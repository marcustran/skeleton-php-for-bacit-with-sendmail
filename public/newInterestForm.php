<?php
/* Register a interess by using the ID */
require_once "config.php";

session_start();

$interestID =  "";
$interestID_err =  "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["interestID"]))){
        $interestID_err = "Please enter a interest number.";
    } else{
        // forbreder select statement
        $sql = "SELECT * FROM interest WHERE interestID = ?";
        
        if($stmt = $mysqli->prepare($sql)){
        
            $stmt->bind_param("s", $param_interestID);
            
            
            $param_interestID = trim($_POST["interestID"]);
            
            
            if($stmt->execute()){
                
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $interestID = trim($_POST["interestID"]);
                } else{
                    $interestID_err = "This interest does not exist ";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            $stmt->close();
        }
    }
    
    


    if(empty($interestID_err)){
    
       

        $sql = "INSERT INTO interest_bridge (interestID, memberID) VALUES (?,?)";
         
        if($stmt = $mysqli->prepare($sql)){
    
            $stmt->bind_param("ii", $param_interestID, $param_memberID);
            
            $param_interestID = $interestID;
            $param_memberID = $_SESSION["memberID"];
            
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <?php echo (!empty($interestID));?>
                <label>Activity Name</label>
                <input type="text" name="interestID"  value="<?php echo $interestID; ?>">
                <p><?php echo $interestID_err; ?></p>

                


                <input type="submit" value="Submit">

        </form>  
</body>
</html>