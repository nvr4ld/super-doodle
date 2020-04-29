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
		      <a style="color: #241e1f;" href="olymp.php">Olympiads</a>
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
<section id="section1" style="height: 100%;width: 100%;">
<form action="login.php" method="post" style="margin-bottom: 0;margin-top: 35px;border:none;padding-left: 0; ">
	<div class="box">
	<select  id="grades" name="grades" onchange="myFunction()" > <!--function if value is changed-->
		 <option  value="" selected disabled hidden>Choose a grade</option>
  <?php $query=mysqli_query($db, "SELECT DISTINCT grade FROM grades"); //gets each grade number without repetition
    	while ($row = mysqli_fetch_array($query)) { 
  ?><option value="<?php echo $row['grade'] ?>"><?php echo $row['grade']; ?></option><?php }?> 
</select>
</div>
<div class="box" style="display: none;" id="groups">
<select name="groups"> <!-- not multiple select -->
	 <option  value="" selected disabled hidden>Choose a group</option>
  <?php $query=mysqli_query($db, "SELECT DISTINCT studygroup FROM grades WHERE grade!=11 and grade!=12 ");
    	while ($row = mysqli_fetch_array($query)) { 
  ?><option value="<?php echo $row['studygroup'] ?>"><?php echo $row['studygroup']; ?></option><?php }?> 
</select>
</div>
<div class="box" style="display: none;" id="advanc">
<select name="adv" > <!-- not multiple select -->
	 <option value="" selected disabled hidden>Choose a group</option>
  <?php $query=mysqli_query($db, "SELECT DISTINCT studygroup FROM grades");
    	while ($row = mysqli_fetch_array($query)) { 
  ?><option value="<?php echo $row['studygroup'] ?>"><?php echo $row['studygroup']; ?></option><?php }?> 
</select>
</div>
<script type="text/javascript">
	function myFunction() { //if first select has got value
		var x = document.getElementById("grades").value;
    if (x == "11" || x=="12") {
    	document.getElementById("advanc").style.display = "block";// выходят селекты
    	document.getElementById("groups").style.display = "none";
    } else{
    document.getElementById("groups").style.display = "block";
	document.getElementById("advanc").style.display = "none";}
}
</script>
<input type="submit" id="success" name="grade1" class="myButton" style="font-family: 'Ubuntu', sans-serif;" value="FIND">
</form>
<?php if (!empty($_SESSION['videograde']) && !empty($_SESSION['videogroup'])): ?> <!--if variables have values-->
<section class="container">
  <div style="position: relative;padding-top:0;margin-top: 0;padding-bottom: 0;margin: auto; width: 55%;left: 10px;">
    <?php
		$grade=$_SESSION['videograde'];
		$studygroup=$_SESSION['videogroup'];
		 $query = "SELECT * FROM grades WHERE grade = '$grade' and studygroup='$studygroup'";
		$results3 = mysqli_query($db,$query);
		$row=mysqli_fetch_array($results3);
		$gradeuploader=$row['id'];
		 $query = "SELECT * FROM videos WHERE grade='$gradeuploader'"; //take videos where grade is as chosen
		$results3 = mysqli_query($db,$query);?>
		<ul style="max-height: 290px;overflow-y: auto;color: #241e1f; " id="list"> <!--creates the list-->
		<?php if (mysqli_num_rows($results3)!=0) {
		while ($row = mysqli_fetch_array($results3)) { 
			$videolistname=$row['name'];
			$uploader=$row['uploader'];
		$query4 = "SELECT * FROM admins WHERE Username='$uploader' ";
		$results4 = mysqli_query($db,$query4);
		$row2=mysqli_fetch_array($results4);
		$uploader=$row2['surname']." ". substr($row2['name'],0,1). "."; 
			?>
		<li > <a style="color: #241e1f;text-decoration: none;font-size: 20px;" href="videoshow.php?open=<?php echo $row['id']; ?>#section1"> <?php 
		//first list element is link to these video
		echo 
		$videolistname;//its text is videos name?>
		<br> 
		<?php
		echo " (Uploaded &nbsp by &nbsp". $uploader. ")"//and the uploader
		?>  </a> </li>

		
	<?php }} else{//if there are no videos?>
	<script type="text/javascript">
            swal("Error!", "There is no material for this grade yet", "error");//creates error alert
        </script>
	<?php unset($_SESSION['videograde']); 
	unset($_SESSION['videogroup']); ?>
	<?php
}?>
</ul>
  </div>
  <?php endif ?>
 

</section>

</section>

</body>
</html>