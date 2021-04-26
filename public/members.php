<?php
/* listing members and sorting them */
//etablishing connection
include("config.php");
// Initialize the session
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



<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
echo $i;
$i = $_POST["sort"];
    switch($i) {
        case "Default";
            $sql = "SELECT * FROM member";
            echo $sql;
            $result = $mysqli->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<H2>" . " Firstname: ". $row["firstName"] . " Lastname: ". $row["lastName"] . " Email: " .  $row["email"] . " StreetName: " . $row["streetName"] . " City: "  .   $row["city"] . " PostalCode " . $row["postalCode"] . " Gender: " . $row["gender"]  . " Date of Birth: " . $row["DoB"] . " Phone: " .  $row["phone"] . " " .  "</H2>";

                };
            };
            break;
        case "Status":
            $sql = "SELECT * FROM member ORDER BY status";
            echo $sql;
            $result = $mysqli->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<H2>" . " Firstname: ". $row["firstName"] . " Lastname: ". $row["lastName"] . " Email: " .  $row["email"] . " StreetName: " . $row["streetName"] . " City: "  .   $row["city"] . " PostalCode " . $row["postalCode"] . " Gender: " . $row["gender"]  . " Date of Birth: " . $row["DoB"] . " Phone: " .  $row["phone"] . " " .  "</H2>";

                };
            };
            break;
        case "DoB":
            $sql = "SELECT * FROM member ORDER BY DoB ASC";
            echo $sql;
            $result = $mysqli->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<H2>" . " Firstname: ". $row["firstName"] . " Lastname: ". $row["lastName"] . " Email: " .  $row["email"] . " StreetName: " . $row["streetName"] . " City: "  .   $row["city"] . " PostalCode " . $row["postalCode"] . " Gender: " . $row["gender"]  . " Date of Birth: " . $row["DoB"] . " Phone: " .  $row["phone"] . " " .  "</H2>";

                };
            };
            break;
    }}
    else {
        echo "heo";
    }



$mysqli->close();



?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
    <body>
        <div>
            Sort after
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <select for="sort" name="sort" required>
                <option value="Default">Default</option>
                <option value="Status">Status</option>
                <option value="DoB">Birthdate</option>
            </select>
            <input type="submit"/>
            </form>
        </div>
    </body>
</html>

