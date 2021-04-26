<?php
require_once "config.php";
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 

// REMEMBER TO ADD THE VARIABLES 
$userName = $password = $confirm_password = $email = $firstName = $lastName = $streetName = $city = $postalCode =
$gender = $DoB = $phone =  "";

 
// prosseserer formen
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    // navn sjekker
    if(empty(trim($_POST["firstName"]))){
        $firstName = $_SESSION["firstName"];
    } else{
        $firstName = trim($_POST["firstName"]);
    }
    // navn sjekker
    if(empty(trim($_POST["lastName"]))){
            $lastName = $_SESSION["lastName"];
    } else{
            $lastName = trim($_POST["lastName"]);
    }
    // Checks the streetname
    if(empty(trim($_POST["streetName"]))){
        $streetName = $_SESSION["streetName"];
    } else {
        $streetName= trim($_POST["streetName"]);
    }

    // Checks the city
    if(empty(trim($_POST["city"]))){
        $city = $_SESSION["city"];
    } else {
        $city= trim($_POST["city"]);
    }
        
    // Checks the streetname
    if(empty(trim($_POST["postalCode"]))){
        $postalCode = $_SESSION["postalCode"];
    } else {
        $postalCode= trim($_POST["postalCode"]);
    }


    // mail sjekker
    if(empty(trim($_POST["email"]))){
        $email = $_SESSION["email"];
    } else{
        $email = trim($_POST["email"]);
    }

    // checks gender
    if(empty(trim($_POST["gender"]))){
        $gender = $_SESSION["gender"];
    } else{
        $gender = trim($_POST["gender"]);
    }

    // checks DoB
    if(empty(trim($_POST["DoB"]))){
        $DoB = $_SESSION["DoB"];
    } else{
        $DoB = trim($_POST["DoB"]);
    }


    // checks phonenumber
    if(empty(trim($_POST["phone"]))){
        $phone = $_SESSION["phone"];
    } else{
        $phone = trim($_POST["phone"]);
    }

}
    ?>
    <?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "UPDATE member 
        SET
        email = '$email' , firstName = '$firstName',
         lastName = '$lastName', streetName = '$streetName',
          city = '$city' , postalCode = $postalCode, 
          gender = '$gender' , DoB = '$DoB', phone = $phone
        WHERE
        memberID= '{$_SESSION['memberID']}' ";

if($mysqli->query($sql) === true){
    echo "Records were updated successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

}
    

    $mysqli->close();
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
</head>
<body>    
        <h2>Change details</h2>
        <p>Please fill this form to change details.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
   


                <label>email</label>
                <input type="text" name="email"  value="<?php echo $email; ?>">
                <p></p>

            
                <label>Firstname</label>
                <input type="text" name="firstName"  value="<?php echo $firstName; ?>">
                <p></p>


                <label>lastname</label>
                <input type="text" name="lastName"  value="<?php echo $lastName; ?>">
                <p></p>

                <label>Streetname</label>
                <input type="text" name="streetName"  value="<?php echo $streetName; ?>">
                <p></p>

                <label>City</label>
                <input type="text" name="city"  value="<?php echo $city; ?>">
                <p></p>

                <label>Postalcode</label>
                <input type="number" name="postalCode"  value="<?php echo $postalCode; ?>">
                <p></p>

                <label>Gender</label>
                <select for="gender" name="gender"  value="<?php echo $gender; ?>">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    </select>
                <p></p>

                <label>Date of birth</label>
                <input type="date" name="DoB"  value="<?php echo $DoB; ?>">
                <p></p>


                <label>phone</label>
                <input type="number" name="phone"  value="<?php echo $phone; ?>">
                <p></p>

                


                <input type="submit" value="Submit">
                <input type="reset"  value="Reset">

        </form>  
</body>
</html>