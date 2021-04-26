<?php
/* register form */
require_once "config.php";

// REMEMBER TO ADD THE VARIABLES 
$userName = $password = $confirm_password = $email = $firstName = $lastName = $streetName = $city = $postalCode =
$gender = $DoB = $phone =  "";
$userName_err = $password_err = $confirm_password_err = $email_err = $firstName_err = $lastName_err = 
$streetName_err = $city_err = $postalCode_err = $gender_err = $DoB_err = $phone_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["userName"]))){
        $userName_err = "Please enter a username.";
    } else{

        $sql = "SELECT memberID FROM member WHERE userName = ?";
        
        if($stmt = $mysqli->prepare($sql)){
        
            $stmt->bind_param("s", $param_userName);
            
            
            $param_userName = trim($_POST["userName"]);
            
            
            if($stmt->execute()){
                
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $userName_err = "This username is already taken.";
                } else{
                    $userName = trim($_POST["userName"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            $stmt->close();
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["firstName"]))){
        $firstName_err = "please fill in your mail";
    } else{
        $firstName = trim($_POST["firstName"]);
    }

    if(empty(trim($_POST["lastName"]))){
            $lastName_err = "please fill in your mail";
    } else{
            $lastName = trim($_POST["lastName"]);
    }

    if(empty(trim($_POST["streetName"]))){
        $streetName_err = "please fill in your streetname";
    } else {
        $streetName= trim($_POST["streetName"]);
    }


    if(empty(trim($_POST["city"]))){
        $city_err = "please fill in your city";
    } else {
        $city= trim($_POST["city"]);
    }

    if(empty(trim($_POST["postalCode"]))){
        $postalCode_err = "please fill in your postalcode";
    } else {
        $postalCode= trim($_POST["postalCode"]);
    }



    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email";
    } else{
        $email = trim($_POST["email"]);
    }


    if(empty(trim($_POST["gender"]))){
        $gender_err = "Please enter your gender.";
    } else{
        $gender = trim($_POST["gender"]);
    }


    if(empty(trim($_POST["DoB"]))){
        $DoB_err = "Please enter your date of birth.";
    } else{
        $DoB = trim($_POST["DoB"]);
    }



    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    } else{
        $phone = trim($_POST["phone"]);
    }


    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // && empty($email_err) && empty($firstName_err) && empty($lastName_err)
    //  && empty($streetName_err) && empty($city_err) && empty($postalCode_err) && empty($gender_err) && empty($DoB_err) && empty($phone_err)
    // sjekke for input errors før INSERT i databasen
    if(empty($userName_err) && empty($password_err) && empty($confirm_password_err) ){
        
        
        $sql = "INSERT INTO member (userName, password, email, firstName, lastName, streetName, city, postalCode, gender, DoB, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            
            $stmt->bind_param("sssssssissi", $param_userName, $param_password, $param_email, $param_firstName, 
            $param_lastName, $param_streetName, $param_city, $param_postalCode, $param_gender, $param_DoB, $param_phone);
            
            
            $param_userName = $userName;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_email = $email;
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_streetName = $streetName;
            $param_city = $city;
            $param_postalCode = $postalCode;
            $param_gender = $gender;
            $param_DoB = $DoB;
            $param_phone = $phone;

            
            if($stmt->execute()){

                header("location: index.php");
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
<!DOCTYPE html>

<html lang="no">
<head>
</head>
<body>    
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php echo (!empty($userName_err));?>
                <label>Username</label>
                <input type="text" name="userName" value="<?php echo $userName; ?>">
                <p><?php echo $userName_err; ?></p>    


            <?php echo (!empty($password_err));?>
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <p><?php echo $password_err; ?></p>

            <?php echo (!empty($confirm_password_err));?>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password"  value="<?php echo $confirm_password; ?>">
                <p><?php echo $confirm_password_err; ?></p>


            <?php echo (!empty($email_err));?>
                <label>email</label>
                <input type="text" name="email"  value="<?php echo $email; ?>">
                <p><?php echo $email_err; ?></p>

            


            <?php echo (!empty($firstName_err));?>
                <label>Firstname</label>
                <input type="text" name="firstName"  value="<?php echo $firstName; ?>">
                <p><?php echo $firstName_err; ?></p>

            <?php echo (!empty($lastName_err));?>
                <label>lastname</label>
                <input type="text" name="lastName"  value="<?php echo $lastName; ?>">
                <p><?php echo $lastName_err; ?></p>

            <?php echo (!empty($streetName_err));?>
                <label>Streetname</label>
                <input type="text" name="streetName"  value="<?php echo $streetName; ?>">
                <p><?php echo $streetName_err; ?></p>

            <?php echo (!empty($city_err));?>
                <label>City</label>
                <input type="text" name="city"  value="<?php echo $city; ?>">
                <p><?php echo $city_err; ?></p>

            <?php echo (!empty($postalCode_err));?>
                <label>Postalcode</label>
                <input type="number" name="postalCode"  value="<?php echo $postalCode; ?>">
                <p><?php echo $postalCode_err; ?></p>

            <?php echo (!empty($gender_err));?>
                <label>Gender</label>
                <select for="gender" name="gender"  value="<?php echo $gender; ?>">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                    </select>
                <p><?php echo $gender_err; ?></p>

            <?php echo (!empty($DoB));?>
                <label>Date of birth</label>
                <input type="date" name="DoB"  value="<?php echo $DoB; ?>">
                <p><?php echo $DoB_err; ?></p>


            <?php echo (!empty($phone_err));?>
                <label>phone</label>
                <input type="number" name="phone"  value="<?php echo $phone; ?>">
                <p><?php echo $phone_err; ?></p>

                


                <input type="submit" value="Submit">
                <input type="reset"  value="Reset">

            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>  
</body>
</html>