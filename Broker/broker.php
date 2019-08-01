<!DOCTYPE html>
<html>
<head>
 <title>Table with database</title>
 <link rel="stylesheet" type="text/css" href="style.css">
 <style>
  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 25px;
   text-align: left;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
  <label>Hotel owner Information</label>
 <table>
 <tr>
  <th>username</th> 
  <th>email</th>
  <th>rating</th> 
  <th>stars</th> 
  <th>location</th> 
  <th>accontpayable</th> 
  <th>images</th> 
  <th>ishidden</th> 
 </tr>



<?php
$conn = mysqli_connect("localhost", "root", "", "booking");
  // Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT username, email, rating, stars, location, accountpayable, image, ishidden FROM owners";
  $result = $conn->query($sql);
  if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
  }
  else if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {

   echo "<tr><td>" . $row["username"]. "</td><td>" . $row["email"] . "</td><td>" . "</td><td>" . $row["rating"]. "</td><td>" . $row["stars"]. "</td><td>" 
    . $row["location"]. "</td><td>" . $row["accountpayable"]. "</td><td>" .'<img height ="200" width ="300" src="data:image;base64,'.base64_encode($row["image"]).' ">' ."<br>". "</td><td>" . $row["ishidden"]. "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>

<?php 
  $con = mysqli_connect("localhost","root","","Booking");
  $sql = "select image FROM owners";
  $res =mysqli_query($con,$sql);
  while ($row=mysqli_fetch_array($res))
    echo '<img height ="200" width ="300" src="data:image;base64,'.base64_encode($row["image"]).' ">' ."<br>";
?>



</body>
</html>