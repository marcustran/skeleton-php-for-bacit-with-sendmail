<?php
/* Startpage can choose to log in og register if allready in a session will get redirected to homepage */
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
     header("location: welcome.php");
     exit;
 }
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["userName"]))){
        $userName_err = "Please enter username.";
    } else{
        $userName = trim($_POST["userName"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($userName_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT memberID, userName, password FROM member WHERE userName = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepa(red statement as parameters
            $stmt->bind_param("s", $param_userName);
            
            // Set parameters
            $param_userName = $userName;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($memberID, $userName, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["memberID"] = $memberID;
                            $_SESSION["userName"] = $userName;                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $userName_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
 <!DOCTYPE html>
<html lang="no">
<head>
<title>New member</title>
    <body>
        <h1>Register new user</h1>
        <p> Velkommen til tidenes klubb! </>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="container">
    <b>Username</b>
    <input type="text" placeholder="Enter Username" name="userName" value ="<?php echo $userName; ?>">
    <?php echo $userName_err; ?>

    <?php echo (!empty($password_err));?>
    <b>Password</b>
    <input type="password" placeholder="Enter Password" name="password">
    <?php echo $password_err; ?>

    <input type="submit" value="Log in" />
<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>  </div>
            </form>
        </div>
    </body>
</html>