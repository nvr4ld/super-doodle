 <?php include('login.php'); ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Login</title>
 	<link rel="stylesheet" type="text/css" href="style/login.css">
 	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
 	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
 	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
 </head>
 <body style="font-family: 'Ubuntu', sans-serif;height:100%;padding: 0;margin: 0;">
 	<div class="container" style="background-image: url('images/phon3.jpg');">
 		<div class="loginform" >
 			<div class="text">
 				Account login
 			</div>
 			
 			<form method="post" action="login.php" class="form"> <!-- actions will take place in the separate login.php -->
				<div class="wrap-input100" style="position: relative"> <!-- Username input -->
					<input class="input100" type="text" name="username" placeholder="Username" value="<?php if(isset($_SESSION['username'])){echo($_SESSION['username']);unset($_SESSION['username']);} ?>"> 
						<span class="focus-input100" data-placeholder="&#xe82a;"></span> <!-- This is the icon of account -->
				</div>
				<div class="wrap-input100"> <!-- Password input -->
					<input class="input100" type="password" name="pass" placeholder="Password" value="<?php if(isset($_SESSION['password'])){echo($_SESSION['password']);unset($_SESSION['password']);} ?>">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span> <!-- This is the icon of password -->
				</div>
			<?php if (isset($_SESSION['message'])) {?> <!-- Set by login.php -->
				<div style="color:red;margin-left: 35px;font-size: 18px;margin-top: 5px;">
					<?php 
					$message=$_SESSION['message'];
					echo $message;
					unset($_SESSION['message']); #shouldn't be shown second time, so it is unset
					?>
				</div>
					<?php } ?>

				<div class="buttonstyle" style="  justify-content:center;position: relative;">
						
					<input class="button"  type="submit" name="enter" value="LOGIN"> <!-- Button to start authentication -->
						<span onclick="window.location.href ='index.php';" class="lnr lnr-home" style="position: absolute;left: 30px;font-size: 25px;cursor: pointer;">  <!-- This span is the icon of home and used as "home" button, as it leads to main page -->
						</span>
				</div>

			</form>
 		</div>
 			
 	</div>
 </body>
 </html>