<?php include('login.php');
$db = mysqli_connect('localhost', 'root', '', 'nisvid');
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
$results3=""; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Videos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/videos2.css">	
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link href="https://fonts.googleapis.com/css?family=Cardo&display=swap" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
</head>
<body style="font-family: 'Cardo', serif;font-style: italic;margin:0;padding:0;height:100%;background-color: #282025;overflow: auto;max-width: 100%">
<?php if (isset($_SESSION['error'])): ?>
	<script type="text/javascript">
		swal("Error!", "<?php echo $_SESSION['error'] ?>", "error");
	</script>
	<?php unset($_SESSION['error']); ?>
<?php endif ?>


	<div  class="top">
		<a href="index.php"  style="width: 180px;margin-left: 10px"><img border="0" src="images/Logo.png" height="100%"></a>
		<?php if (!empty($_SESSION['user'])) {?>
		<div style="color: #f6ab00;font-size: 30px;margin: auto;">
		<?php 
		$username1=$_SESSION['user'];
		$query=mysqli_query($db, "SELECT * from admins WHERE Username='$username1'");
    	$row = mysqli_fetch_array($query);
    	$username2=$row['name'];
    	$usersurname=$row['surname'];
		echo $usersurname."&nbsp".substr($username2,0,1)."." ; ?>
		<a href="login.php?out" ><img border="0" src="images/logout.webp" width="25" height="20"></a>
		 
	</div>
		<?php }?>
		<div class="motiv"  style="color: #f6ab00">It's your time to study! 
	</div>
	</div>

   	<div class="header">
	<nav>
		 <a class="navlink" style="color: #f6ab00" href="index.php">Main</a>
		 <a class="navlink" style="color: #f6ab00" href=https://vk.com/id402129353>Contact</a>
		 <a class="navlink" style="color: #f6ab00" href="tasks.php">Tasks</a>
		 <a class="navlink" style="color: #f6ab00" href="olymp.php">Olympiads</a>
		 <?php if (!empty($_SESSION['user'])) {?>
		 	<a class="navlink" href="upload.php" style="color: #f6ab00" >Cabinet</a>
		 	<?php if (!empty($_SESSION['developer'])){?>
		 	<a class="navlink" href="register.php" style="color: #f6ab00">Add teacher</a>
		 <?php }?>
		 	 <?php }else { ?>
			<a class="navlink" style="color: #f6ab00" href="acc.php">LOGIN</a>
	    <?php }?>
     </nav>

</div>
<section id="section1" style="height: 100%;max-width: 50%;">

  <div class="hi" id="video" style="left: 50%;transform: translateX(50%);padding-top:0;margin-top: 0;padding-bottom: 0;">
  	<span onclick="window.location.href ='videos.php';" class="lnr lnr-cross-circle" id="backbutton" style=" position: absolute;cursor: pointer;color:#f6ab00;right: 25px;top: 5px;font-size: 40px;z-index: 5 ">  </span>
  	<?php
		$idvideo = $_GET['open'];
		$record = mysqli_query($db, "SELECT * FROM videos WHERE id=$idvideo");
			$n = mysqli_fetch_array($record);
			$path = $n['path'];
			?>
<video style="margin-left: 30px;padding-top: 7px;" height="340px" width="560px" controls> <source src="<?php echo "$path" ?>" type="video/mp4"></video>
  </div>

</section>


</body>
</html>