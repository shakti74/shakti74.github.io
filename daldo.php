<?php
$username = $_POST['name'];
$password = $_POST['pass1'];

$host = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbname = "cupcake";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
	 $SELECT = "SELECT username From details Where username = ? Limit 1";
     $INSERT = "INSERT Into details (username, password) values(?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $username);
     $stmt->execute();
     $stmt->bind_result($username);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      echo "New record inserted sucessfully";
      document.write("Done");
     } else {
      echo "Someone already register using this username";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
