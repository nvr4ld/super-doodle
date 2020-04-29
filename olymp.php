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
	<link rel="stylesheet" type="text/css" href="style/videos4.css">	
	<link rel="stylesheet" type="text/css" href="style/hello4.css">
  <link rel="stylesheet" type="text/css" href="style/hello.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link href="https://fonts.googleapis.com/css?family=Cardo&display=swap" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
</head>
<body style="font-family: 'Cardo', serif;font-style: italic;margin:0;padding:0;height:100%;background:#f5f5dc;overflow: auto;color: #241e1f;">
<?php if (isset($_SESSION['error'])): ?>
	<script type="text/javascript">
		swal("Error!", "<?php echo $_SESSION['error'] ?>", "error");
	</script>
	<?php unset($_SESSION['error']); ?>
<?php endif ?>


	<div  class="top">
		<a href="index.php"  style="width: 180px;margin-left: 10px"><img border="0" src="images/Logo.png" height="100%"></a>
		<?php if (!empty($_SESSION['user'])) {?>
		<div style="font-size: 30px;margin: auto;">
		<?php 
		$username1=$_SESSION['user'];
		$query=mysqli_query($db, "SELECT * from admins WHERE Username='$username1'");
    	$row = mysqli_fetch_array($query);
    	$username2=$row['name'];
    	$usersurname=$row['surname'];
		echo $usersurname."&nbsp".substr($username2,0,1)."." ; ?>
		<a href="login.php?out" style="text-decoration: none;">
              <span class="lnr lnr-exit" style="font-size: 25px;margin-left: 5px;color: #241e1f;"></span>
            </a>
		 
	</div>
		<?php }?>
		<div class="motiv"  >It's your time to study! 
	</div>
	</div>

   <div class="header">
      <ul class="nav">
        <li id="active">
		      <a style="color: #241e1f;" href="index.php" >Main</a>
        </li>
        <li>
		      <a style="color: #241e1f;" href="index.php#section4">About</a>
        </li>
        <li>
		      <a style="color: #241e1f;" href=#>Contact</a>
          <ul>
            <li>
              <a style="color: #241e1f;font-size: 20px;"  href=https://vk.com/id402129353>Vkontakte</a>
            </li>
             <li>
              <a style="color: #241e1f;font-size: 20px;" href=https://www.instagram.com/nvr4ld/?hl=ru>Instagram</a>
            </li>
            <li>
              <a style="color: #241e1f;font-size: 20px;" href="mailto:aldeken.nur.2003@gmail.com">Email</a>
            </li>
          </ul>
        </li>
        <li>
		      <a style="color: #241e1f;" href="tasks.php">Tasks</a>
        </li>
        <li>
		      <a style="color: #241e1f;" href="videos.php">Videos</a>
        </li>
		 
        <?php if (!empty($_SESSION['user'])) {?>
          <li>
		 	      <a href="upload.php" style="color: #241e1f;" >Cabinet</a>
          </li>
          <?php if (!empty($_SESSION['developer'])){?>
            <li>
		 	        <a href="register.php" style="color: #241e1f;">Add teacher</a></li>

		      <?php }?>
		    <?php }else { ?>
          <li>
            <a style="color: #241e1f;" href="acc.php">LOGIN</a></li>

        <?php }?>
      </ul>

    </div>
<section id="section3" style="height: 100%;width: 100%;">
<form action="login.php" method="post" style="margin-bottom: 0;margin-top: 35px;border:none;padding-left: 0; ">
	<div class="box">
	<select  id="grades" name="grades">
		 <option  value="" selected disabled hidden>Choose a grade</option>
  <?php $query=mysqli_query($db, "SELECT DISTINCT grade FROM grades");
    	while ($row = mysqli_fetch_array($query)) { 
  ?><option value="<?php echo $row['grade'] ?>"><?php echo $row['grade']; ?></option><?php }?> 
</select>
</div>

<input type="submit" id="success" name="grade3" class="myButton" style="font-family: 'Ubuntu', sans-serif;" value="FIND">
</form>
<?php if (!empty($_SESSION['olympgrade'])): ?>
<section class="container">
  <div style="position: relative;padding-top:0;margin-top: 0;padding-bottom: 0;margin: auto; width: 55%;left: 10px;">
		<?php
		$grade=$_SESSION['olympgrade'];
		$results=mysqli_query($db,"SELECT * FROM grades WHERE grade = '$grade'");?>
		<table style="width: 50%;margin: 30px auto;border-collapse: collapse;text-align: left;height: 300px;overflow-y: auto;font-size: 20px;">
			
		<?php while ( $row=mysqli_fetch_array($results)) {
			$id=$row['id'];
		
		 $query = "SELECT * FROM olympiads WHERE grade = '$id'";
		$results3 = mysqli_query($db,$query);
		?>
		<?php if (mysqli_num_rows($results3)!=0) {		
		while ($row = mysqli_fetch_array($results3)) { 
			$olymplistname=$row['name'];
			$date = $row['date'];
			?>
			<tr style="border-bottom: 1px solid #cbcbcb;">
			<td style="border: none;height: 15px;padding: 2px;"> <?php echo "$olymplistname"; ?></td>
			<td style="
			border: none;height: 15px;padding: 2px;"> <?php echo "$date"; ?></td>
			<td style="border: none;height: 15px;padding: 2px;">
				<a href="login.php?downl=<?php echo $row['id']; ?>" class="edit_btn" >Download</a>
			</td>
		</tr>
	<?php }} else{?>
	<script type="text/javascript">
            swal("Error!", "There is no material for this grade yet", "error");
        </script>
	<?php unset($_SESSION['videograde']); 
	unset($_SESSION['videogroup']); ?>
	<?php
}}?>
	</table>
</div>
</section>

  <?php endif ?>
 

</section>

