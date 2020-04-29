 <?php  include('login.php'); ?>
<?php ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
$db = mysqli_connect('localhost', 'root', '', 'nisvid');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload</title>
	<link rel="stylesheet" type="text/css" href="style/upload3.css">
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<link href="https://fonts.googleapis.com/css?family=Cardo&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="font-family: 'Ubuntu', sans-serif;height:100%;padding: 0;margin: 0;">
	<div class="container" style="background-image: url('images/phon3.jpg');justify-content: center;display: flex;" id="cont">	

		<div style="text-align: center;width: 100%;padding-top: 175px;font-size: 23px;color: white" id="div45">
 			What do you want to upload?
 		</div>
		<form method="post" action="login.php" class="form" style="margin-top: 30px;max-height: 200px;padding-top: 30px;padding-bottom: 10px;width: 270px; " id="formtype">
			<div style="border-bottom: 1px solid #e6e6e6;">
				<input type="radio" id="video" name="filetype" value="video" > <!-- Same names for radiobuttons -->
				<label for="video">Video</label><br>
			</div>
			<div style="line-height: 50%;">
			<br>
			</div>
			<div style="border-bottom: 1px solid #e6e6e6;">
				<input type="radio" id="task" name="filetype" value="task" > <!-- Same names for radiobuttons -->
				<label for="task">Task</label><br>
			</div>
			<div style="line-height: 50%;">
			<br>
			</div>
			<div style="border-bottom: 1px solid #e6e6e6;">
				<input type="radio" id="olympiad" name="filetype" value="Olympiad"> <!-- Same names for radiobuttons -->
				<label for="olympiad">Olympiad</label><br>
			</div>
			<div style="line-height: 50%;">
			<br>
			</div>
			<?php if (isset($_SESSION['error'])) {
				$error=$_SESSION['error'];
				?>
				<h6 style="color: red;margin: 0px;margin-top: -6px;padding: 5px;"> <?php echo "$error"; ?> </h6>
				<?php unset($_SESSION['error']);
			} ?>
			<div style="display: flex;right: 50%;margin-top: 0;align-items: flex-start;justify-content: center;">
						
				<input class="button" style="width: 100px;"  type="submit" name="hey" value="Go">
				<a href="mydocuments.php" style="position: absolute;top: 0;right: 5px;font-size: 20px;text-decoration: none;">My videos--></a>
						
			</div>
			<span onclick="window.location.href ='index.php';" class="lnr lnr-home" style="position: absolute;cursor: pointer;bottom:30px">  </span>
  			<div style="line-height: 45%;">
			<br>
			</div>
			
		</form>
	</div>
</body>
</html>