<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>

<form method="post" action="login.php">
	<div class="input-group">
		<label>username/email</label>
		<input type="text" name="username"  value = "<?php echo $username; ?>">
	</div>

	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div>

	 <p>         
	 	login as:  
     	<input type = "radio"
       	       name = "userType"
               id = "customerBtn"
               value = "customer"
               checked = "checked" />
      	<label for = "customerBtn">Customer</label>
      	<input type = "radio"
        	   name = "userType"
               id = "OwnerBtn"
               value = "owner" />
      	<label for = "OwnerBtn">hotel owner</label>
    </p>  

	<?php if(count($errors) > 0): ?>
		<div class="error">
			<?php  foreach($errors as $error): ?>
				<p><?php echo $error; ?></p>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	
	<div class="change-page">
		<p>
			Already a have account? <a href="sign up.php">sign up</a>
			<button type="submit" name="login" class='btn' >login</button>
		</p>
	</div>
</form>

</body>
</html>