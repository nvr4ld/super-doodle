<?php include('login.php'); ?>
<!DOCTYPE html>
<html lang="en"><?php #it links to the framework and makes work easier ?>
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style/login.css">
 		<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
 		<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <?php #без этого скрипт не работает ?>
 		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!--its for sweetalert-->
</head>
<body style="font-family: 'Ubuntu', sans-serif;height:100%;padding: 0;margin: 0;">
	<?php if (isset($_SESSION['success'])) {?> <!-- Uses Sweetalert -->
		<script>
			swal("Success!", "User has been registered", "success");
  		</script>
	<?php unset($_SESSION['success']);} 
	elseif (isset($_SESSION['failure'])) {?>
		<script type="text/javascript">
  			swal("Failure!", "User was already registered before", "error");
		</script>
	<?php unset($_SESSION['failure']); } ?>

 	<div class="container" style="background-image: url('images/phon3.jpg');">
 		<div class="loginform" >
 			<div class="text" style="margin-top: 0;padding-bottom: 19px;">
 				Registration form
 			</div>

 			<form method="post" action="login.php" class="form">
				<div class="wrap-input100" style="position: relative;  height: 30px;">
					<input class="input100" type="text" name="username" placeholder="Username" value="<?php if (isset($_SESSION['usernamereg'])){echo $_SESSION['usernamereg'];unset($_SESSION['usernamereg']);} ?>" maxlength="30"> <!-- controls max length, field for username -->
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>

				<div class="wrap-input100" style="position: relative;  height: 30px;">
					<input class="input100" type="password" name="pass" placeholder="Password" value="<?php if (isset($_SESSION['pwreg'])){echo $_SESSION['pwreg'];unset($_SESSION['pwreg']);} ?>" maxlength="30"> <!-- controls max length, field for password -->
					<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>
				<div class="wrap-input100" style="position: relative;  height: 30px;">
					<input class="input100" type="text" name="surname" placeholder="Surname" value="<?php if (isset($_SESSION['surnamereg'])){echo $_SESSION['surnamereg'];unset($_SESSION['surnamereg']);} ?>" maxlength="30"> <!-- controls max length, field for surname -->
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>
				<div class="wrap-input100" style="position: relative;  height: 30px;">
					<input class="input100" type="text" name="name" placeholder="Name" value="<?php if (isset($_SESSION['namereg'])){echo $_SESSION['namereg'];unset($_SESSION['namereg']);} ?>" maxlength="30"> <!-- controls max length, field for name -->
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>
				<?php if (isset($_SESSION['message'])) {?> <!-- if some fields are empty -->
					<div style="color:red;margin-left: 35px;font-size: 18px;margin-top: 10px;">
						<?php 
						$message=$_SESSION['message'];
						echo $message;
						unset($_SESSION['message']); #not shown second time
						?>
					</div>
				<?php } ?>

				<div class="buttonstyle" style="  justify-content:center;position: relative;">

					<input class="button" type="submit" name="save" value="Register">
					<span onclick="window.location.href ='edit.php';" class="lnr lnr-pencil" style="position: absolute;right: 30px;font-size: 25px;cursor: pointer;">  <!-- button with pencil icon -->
					</span>
					<span onclick="window.location.href ='index.php';" class="lnr lnr-home" style="position: absolute;left: 30px;font-size: 25px;cursor: pointer;">
					</span> <!-- button with home icon -->
				</div>


			</form>
 		</div>
 			
 	</div>
</body>
</html>