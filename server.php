<?php	
	session_start();
	$username = "";
	$email = "";
	$errors = array();

	$db = mysqli_connect('localhost','root','','booking');

	if(isset($_POST['sign_up']))
	{
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db,$_POST['password_2']);


		if(empty($username))
		{
			array_push($errors,"Enter username please");
		}
		if(empty($email))
		{
			array_push($errors,"Enter email please");
		}
		
		$customername_check =  "SELECT * FROM customers WHERE username = '$username'";
		$ownername_check =  "SELECT * FROM owners WHERE username = '$username'";

		$results1 = mysqli_query($db, $customername_check);
		$results2 = mysqli_query($db, $ownername_check);
		if (mysqli_num_rows($results1) != 0 || mysqli_num_rows($results2) != 0)
			array_push($errors,"username is aready taken");

		$customer_email_check =  "SELECT * FROM customers WHERE email = '$email'";
		$owner_email_check =  "SELECT * FROM owners WHERE email = '$email'";

		$results1 = mysqli_query($db, $customer_email_check);
		$results2 = mysqli_query($db, $owner_email_check);
		if (mysqli_num_rows($results1) != 0 || mysqli_num_rows($results2) != 0)
			array_push($errors,"email is aready used login instead");


		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors,"email is no valid");
		}
		if(empty($password_1))
		{
			array_push($errors,"Enter password please");
		}
		if($password_1 != $password_2)
		{
			array_push($errors,"passwords are not matching");
		}

		if(count($errors) == 0)
		{
			$password = md5($password_1);
			$date = date('Y-m-d H:i:s');
			if (isset($_POST['userType']) && $_POST['userType']=="customer")
				$sql = "INSERT INTO customers (username,email,password) VALUES ('$username','$email','$password')";
			else 
				$sql = "INSERT INTO owners (username,email,password,lastPayingDate,ishidden,accountPayable) VALUES ('$username','$email','$password','$date',false,0)";
			mysqli_query($db,$sql);
			$_SESSION['username'] = $username;
			if (isset($_POST['userType']) && $_POST['userType']=="customer")
				header('location: Customers/index.php');
			else
				header('location:Hotels/hotel registeration.php');
		}


	  }


	  
		if (isset($_POST['login'])) 
		{
		  $name = mysqli_real_escape_string($db, $_POST['username']);
		  $password = mysqli_real_escape_string($db, $_POST['password']);

		  if (empty($name)) {
		  	array_push($errors, "Username/email is required");
		  }
		  if (empty($password)) {
		  	array_push($errors, "Password is required");
		  }

		  if (count($errors) == 0) {
		  	$password = md5($password);
		  	if (isset($_POST['userType']) && $_POST['userType']=="customer")
		  		$query = "SELECT * FROM customers WHERE (username='$name' OR email='$name') AND password='$password'";
		  	else
		  		$query = "SELECT * FROM owners WHERE (username='$name' OR email='$name')  AND password='$password'";
		  	$results = mysqli_query($db, $query);
		  	if (mysqli_num_rows($results) == 1) {
		  	  $_SESSION['username'] = $name;
		  	  if (isset($_POST['userType']) && $_POST['userType']=="customer")
		  	  		header('location: Customers/index.php');
		  	  else
		  	  		header('location: Hotels/index.php');
		  	}else {
		  		array_push($errors, "Wrong username/password combination");
		  	}
		  }
		}


	
?>