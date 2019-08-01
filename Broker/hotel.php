<?php include('../server.php') ?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Bookingjini</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<div class="myform" style = "width:55%;margin-top:2%">
  <img src="../imgs/logo.png" style="width:100%;height:180px;">
  <?php
$conn = mysqli_connect("localhost", "root", "", "booking");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM owners WHERE(username ='$username')";
  $result = $conn->query($sql);
  if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
  }
  else if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {

    echo '<img height ="400" style = "width:100%" src="data:image;base64,'.base64_encode($row["image"]).' ">' ."<br>";
    echo '<div class="rooms-frame">';
  echo '<h2 class="room-title" > Hotel information </h2>';
    echo 'hotel name: '.$row["username"].'</br>';
    echo 'email: '.$row["email"].'</br>';
    if($row["rating"] != NULL)
      echo 'rating: '.$row["rating"].'</br>';
    else
      echo 'rating: no rating yet </br>';
    echo 'stars: '.$row["stars"].'</br>';
    echo 'location: '.$row["location"].'</br>';
    echo 'accountpayable: '.$row["accountpayable"].' L.E.</br>';
    if($row["ishidden"] == true)
      echo 'ishidden: true</br>';
    else
      echo 'ishidden: false</br>';
    echo 'lastPayingDate: '.$row["lastPayingDate"].'</br>';
    echo '</div>';
    $ishidden = $row["ishidden"];
}

  echo ' <div class="rooms-frame">';
  echo '<h2 class="room-title" > Rooms </h2> ';

  $sql = "SELECT * FROM rooms WHERE(ownername ='$username')";
  $result = $conn->query($sql);
  if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
  }
  else if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
      echo ' <div class="room" style="margin-bottom:4%">';
      echo '<img height ="200" style = "width:100%" src="data:image;base64,'.base64_encode($row["image"]).' ">' ."<br>";

      //temp

    echo '<div class="rooms-frame">';
  echo '<h2 class="room-title" > room information </h2>';
    echo 'no: '.$row["no"].'</br>';
    echo 'type: '.$row["type"].'</br>';
    echo 'facilites: '.$row["facilities"].'</br>';
    echo 'count: '.$row["count"].'</br>';
    echo 'current price: '.$row["current_price"].' L.E.</br>';
    if($row["isReserved"] == true)
      echo 'isReserved: true</br>';
    else
      echo 'isReserved: false</br>';
    echo '</div>';

      //temp


    echo '</div> ';

  }

echo '</div>';

}

  if($ishidden)
    echo '<button type="button" name="unsuspend" class="btn" style = "margin-left: 92%;">unsuspend</button>';
  else
    echo '<button type="button" name="suspend" class="btn" style = "margin-left: 92%;">suspend</button>';

} else { echo "Hotel not found"; }


$conn->close();
?>

</div>
</body>
</html>