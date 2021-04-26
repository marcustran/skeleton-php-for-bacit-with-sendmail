<?php
/* Welcomepage can also set their profile picture  */
//etablishing connection
include("config.php");
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$sql = "SELECT email, firstName, lastName, streetName, city, postalCode, gender, DoB, phone FROM eksamen2020.member WHERE memberID = ? ";

if($stmt = $mysqli->prepare($sql)){
    $stmt->bind_param("i", $param_memberID);

    $param_memberID = $_SESSION['memberID'];

    if($stmt->execute()){
        $stmt->store_result();

        if($stmt->num_rows == 1){
            $stmt-> bind_result($email, $firstName, $lastName, $streetName, $city, $postalCode, $gender, $DoB, $phone);
            if($stmt->fetch()){
                $_SESSION["email"] = $email;
                $_SESSION["firstName"] = $firstName;
                $_SESSION["lastName"] = $lastName; 
                $_SESSION["streetName"] = $streetName;
                $_SESSION["city"] = $city;
                $_SESSION["postalCode"] = $postalCode;
                $_SESSION["gender"] = $gender;
                $_SESSION["DoB"] = $DoB;
                $_SESSION["phone"] = $phone;



            }
        }

    }
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

 <?php

if(isset($_POST['but_upload'])){
 
  $name = $_FILES['file']['name'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);


  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  $extensions_arr = array("jpg","jpeg","png","gif");


  if( in_array($imageFileType,$extensions_arr) && $_FILES["file"]["size"] < 500000 ){
 

     $query = "UPDATE member
     SET name= ('".$name."')
     WHERE memberID='{$_SESSION['memberID']}'";
     mysqli_query($mysqli,$query);
  

     move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

  }else{
      echo "file couldnt be uploaded";
  }
 
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <title>Welcome</title>
</head>
<body>
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["firstName"]); ?></b>. Welcome to our site.</h1>

    <p>
        <a href="logout.php" class="container">Sign Out of Your Account</a>
    </p>
</body>
</html>
<form method="post" action="" enctype='multipart/form-data'>
  <input type='file' name='file' />
  <input type='submit' value='Save name' name='but_upload'>
</form>

<?php

$sql = "select name from member where memberID='{$_SESSION['memberID']}'";
$result = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_array($result);

$image = $row['name'];
$image_src = "upload/".$image;
$_SESSION["image"] = $image;
$_SESSION["image_src"] = $image_src;
?>
