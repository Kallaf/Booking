<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Create account</h2>
	</div>

<form method="post" action="sign up.php">
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value = "<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>email</label>
		<input type="text" name="email" value = "<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>

	 <p>         
	 	sign up as:  
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
			Already a have account? <a href="login.php">login</a>
			<button type="submit" name="sign_up" class='btn' >sign up</button>
		</p>
	</div>
</form>

</body>
</html>