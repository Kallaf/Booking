<?php
 

  $db = mysqli_connect('localhost','root','','booking');
  $errors = array();


  if (isset($_SESSION['username'])) 
  {
  	$username = $_SESSION['username'];

    if(isset($_POST['addHotel']))
    {
    	//get location
    	$location = mysqli_real_escape_string($db,$_POST['location']);

    	if(empty($location))
		{
			array_push($errors,"enter hotel location");
		}


		//get stars
		if(isset($_POST['stars']))
		{
			switch($_POST['stars'])
			{
				case "star1":
					$stars = 1;
					break;

				case "star2":
					$stars = 2;
					break;

				case "star3":
					$stars = 3;
					break;

				case "star4":
					$stars = 4;
					break;

				case "star5":
					$stars = 5;
					break;
				default:
					$stars = 0;
			}
		}else{
			array_push($errors,'please select hotel stars');
		}

		//get hotel image
		if(!empty($_FILES['hotel_image']['name']))
		{
			$fileName = $_FILES['hotel_image']['name'];
  			$fileTmpname = $_FILES['hotel_image']['tmp_name'];
  			$fileSize = $_FILES['hotel_image']['size'];
  			$fileError = $_FILES['hotel_image']['error'];
  			$fileType = $_FILES['hotel_image']['type'];
  			$fileExt = explode('.',$fileName);
  			$fileActualExt = strtolower(end($fileExt));
  			$allowed = array('jpg','jpeg','png');

  			if(in_array($fileActualExt,$allowed)){
  				if($fileError === 0)
  				{
  					if($fileSize > 1000000)
  					{
  						array_push($errors,"hotel image file is too big");
  					}
  				}else
  				{
  					array_push($errors,"there was an error uploading hotel image");
  				}
  			}else
  			{
  				array_push($errors,"hotel image format not supported");
  			}	
		}else
		{
			array_push($errors,"please select hotel profile image");
		}
  		
		//get rooms data

		$number = count($_POST["room_type"]);
		$roomType = array();
		$roomNo = array();
		$roomFacilities = array();
		$roomCount = array();
		$roomPrice = array();
		$roomfileNames = array();
		for($i=0; $i<$number; $i++)  
      	{  

      	   array_push($roomType,mysqli_real_escape_string($db,$_POST["room_type"][$i]));
      	   if(in_array($_POST["room_no"][$i],$roomNo))
	      		array_push($errors,"room number can not be repeated");
  	   	   array_push($roomNo,mysqli_real_escape_string($db,$_POST["room_no"][$i]));
		   array_push($roomFacilities,mysqli_real_escape_string($db,$_POST["room_facilities"][$i]));
		   array_push($roomCount,mysqli_real_escape_string($db,$_POST["room_count"][$i]));
		   array_push($roomPrice,mysqli_real_escape_string($db,$_POST["room_price"][$i]));
		   array_push($roomfileNames,$_FILES['room_image']['name'][$i]);




           if(empty($roomType[$i]) || empty($roomNo[$i]) || empty($roomFacilities[$i]) ||empty($roomCount[$i])|| empty($roomPrice[$i]) || empty($roomfileNames[$i]))  
           {  
             	array_push($errors,"please complete room data");
           }
           else
           {
           	   if(!is_numeric($roomNo[$i]))
	           {
	           	 	array_push($errors,"room number must be a real number");
	           }
	           if(!is_numeric($roomCount[$i]))
	           {
	           	 	array_push($errors,"room count must be a real number");
	           }
	           if(!is_numeric($roomPrice[$i]))
	           {
	           	 	array_push($errors,"room price must be a number");
	           }

	           $fileTmpname = $_FILES['room_image']['tmp_name'][$i];
  		   	   $fileSize = $_FILES['room_image']['size'][$i];
  		   	   $fileError = $_FILES['room_image']['error'][$i];
  		       $fileType = $_FILES['room_image']['type'][$i];
  		       $fileExt = explode('.',$roomfileNames[$i]);
  		       $fileActualExt = strtolower(end($fileExt));
  		       $allowed = array('jpg','jpeg','png');

	  		   if(in_array($fileActualExt,$allowed)){
	  				if($fileError === 0)
	  				{
	  					if($fileSize > 1000000)
	  					{
	  						array_push($errors,"room image file is too big");
	  					}
	  				}else
	  				{
	  					array_push($errors,"there was an error uploading room image");
	  				}
	  			}else
	  			{
	  				array_push($errors,"room image format not supported");
	  			}

           }	
		

  		   if(count($errors) != 0)
  		   	break;
      	} 


 		if(count($errors) == 0)
		{
			$file = addslashes(file_get_contents($_FILES["hotel_image"]["tmp_name"]));
			$sql = "UPDATE owners SET location = '$location',stars = '$stars',image = '$file'  WHERE username='$username'";
			mysqli_query($db,$sql);
			$date = date('Y-m-d H:i:s');
			$sql = "INSERT INTO broker_notification (seen,notificationDate,ownername) VALUES (false,'$date','$username')";
			mysqli_query($db,$sql);
			for($i=0; $i<$number; $i++) 
			{
				$file = addslashes(file_get_contents($_FILES['room_image']['tmp_name'][$i]));
				$sql = "INSERT INTO rooms(ownername,type,no,facilities,count,current_price,isReserved,image) VALUES('$username','$roomType[$i]','$roomNo[$i]','$roomFacilities[$i]','$roomCount[$i]','$roomPrice[$i]',false,'$file')"; 
				mysqli_query($db,$sql);
			}
			header('location:../Hotels/index.php');
		}
  }}

?>