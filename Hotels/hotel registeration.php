<?php include('../server.php') ?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	
    <script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
</head>
<body>
<script type="text/javascript">

$(document).ready(function(){

	 $('#add_room').click(function(){  
	 	$('#rooms').append(' <div class="room"><h2 class="room-title"> New room </h2><div class="input-group"><label>type</label><input type="text" name="room_type[]"></div><div class="input-group"><label>room number</label><input type="text" name="room_no[]"></div><div class="input-group"><label>facilities</label><input type="text" name="room_facilities[]"></div><div class="input-group"><label>count</label><input type="text" name="room_count[]"></div><div class="input-group"><label>current price</label><input type="text" name="room_price[]"></div><div class="input-group"><label>room profile image</label></div><input type="file" name="room_image[]"><button type="button" class="btn remove" style = "margin-left: 87%; background:#bf0000; font-size:15px;">remove</button></div> ');
      });  

	$(document).on('click', '.remove', function(){
		$(this).parent('div').remove();  
      }); 

});

</script>

<form method="post" action="hotel registeration.php" style = "width:55%;margin-top:2%"  enctype="multipart/form-data" >

	<img src="../imgs/logo.png" style="width:100%;height:180px;">

	<div class="input-group">
		<label>profile image</label>
	</div>
	<input type="file" name="hotel_image"  upload="upload">

	<div class="input-group" style="margin-top:5%;">
		<label>location</label>
		<input type="text" name="location" value = "<?php if(isset($_POST['location']))echo $location; ?>">
	</div>

	 <p style="margin-top:5%;">         
	 	Stars:  
     	<input type = "radio"
       	       name = "stars"
               id = "star1Btn"
               value = "star1" 
               <?php
    				if (isset($_POST['stars']) && $_POST['stars']=="star1") {
        				echo 'checked="checked"';
    				}
				?>
               />
      	<label for = "star1Btn">1 star</label>
      	<input type = "radio"
       	       name = "stars"
               id = "star2Btn"
               value = "star2"
               <?php
    				if (isset($_POST['stars']) && $_POST['stars']=="star2") {
        				echo 'checked="checked"';
    				}
				?>
                />
      	<label for = "star2Btn">2 stars</label>
      	<input type = "radio"
       	       name = "stars"
               id = "star3Btn"
               value = "star3" 
               <?php
    				if (isset($_POST['stars']) && $_POST['stars']=="star3") {
        				echo 'checked="checked"';
    				}
				?>
               />
      	<label for = "star3Btn">3 stars</label>
      	<input type = "radio"
       	       name = "stars"
               id = "star4Btn"
               value = "star4" 
               <?php
    				if (isset($_POST['stars']) && $_POST['stars']=="star4") {
        				echo 'checked="checked"';
    				}
				?>
               />
      	<label for = "star4Btn">4 stars</label>
      	<input type = "radio"
       	       name = "stars"
               id = "star5Btn"
               value = "star5" 
               <?php
    				if (isset($_POST['stars']) && $_POST['stars']=="star5") {
        				echo 'checked="checked"';
    				}
				?>
               />
      	<label for = "star5Btn">5 stars</label>
    </p>  

	<div class="rooms-frame">
		<div id="rooms">
			<h2 class="room-title" > Rooms </h2>
			
			<div class="room">
					<h2 class="room-title""> New room </h2>

					<div class="input-group">
						<label>type</label>
						<input type="text" name="room_type[]">
					</div>
					<div class="input-group">
						<label>room number</label>
						<input type="text" name="room_no[]">
					</div>
						<div class="input-group">
						<label>facilities</label>
						<input type="text" name="room_facilities[]">
					</div>

					<div class="input-group">
						<label>count</label>
						<input type="text" name="room_count[]">
					</div>

					<div class="input-group">
						<label>current price</label>
						<input type="text" name="room_price[]">
					</div>

					<div class="input-group">
						<label>room profile image</label>
					</div>
					<input type="file" name="room_image[]">
			</div>
		</div>
		<button type="button" class='btn' name='add_room' id='add_room' style = "margin-left: 73%;width:25%;font-size:15px;">add room</button>
	</div>

	<?php if(count($errors) > 0): ?>
		<div class="error">
			<p>Errors:</p>
			<?php  foreach($errors as $error): ?>
				<p><?php echo $error; ?></p>
			<?php endforeach ?>
		</div>
	<?php endif ?>

	<button type="submit" name="addHotel" class='btn' style = "margin-left: 92%;">submit</button>
</form>
</body>
</html>