<?php  
include('login.php');
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
$update=false;
$db = mysqli_connect('localhost', 'root', '', 'nisvid');
if (isset($_GET['edit'])) {

	$_SESSION['username2'] = $_GET['edit']; //the username of account to be edited
	$username=$_GET['edit']; 
	$update = true;
	$record = mysqli_query($db, "SELECT * FROM admins WHERE username=$username");

	if ( mysqli_num_rows($record) == 1 ) {
		$n = mysqli_fetch_array($record);
		$_SESSION['password2'] = $n['password']; //the password of account to be edited
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>SIGNUP</title>
	<link rel="stylesheet" type="text/css" href="style/edit4.css">
	<link href="https://fonts.googleapis.com/css?family=Cardo&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style type="text/css">
		.swal-text{
			font-size: 20px;
		}
	</style>
</head>

<body style="padding: 0;margin: 0;height: 625px;">
	<?php
 	if (isset($_SESSION['deleted'])) {?>
		<script type="text/javascript">
			swal("Success!", "User has been deleted", "success");
		</script>
	<?php
	unset($_SESSION['deleted']);}
	?>
	<?php 
	if (isset($_SESSION['updated'])) {?>
		<script type="text/javascript">
			swal("Success!", "User has been edited", "success");
		</script>
	<?php unset($_SESSION['updated']);}
	?>
	<div class="container2" style="background-image: url('images/phon3.jpg');" id="container">
		<?php 
			$results = mysqli_query($db, "SELECT * FROM admins WHERE Developer IS NULL"); #every account except the one of developer
		?>
		<div id="div">
			<table style="text-align: center;" id="table">
				<thead>
					<tr>
						<th >Username</th>
						<th >Name</th>
						<th colspan="2" style="padding-right: 25px;">Action</th>
					</tr>
				</thead>
	
				<?php 
				while ($row = mysqli_fetch_array($results)) { #completes the table?> 
					<tr>
						<td><?php echo $row['Username']; ?></td> <!-- shows username -->
						<td><?php echo $row['surname']."&nbsp".substr($row['name'],0,1)."." ; ?></td> <!-- swows full name as Surname N. -->
						<td>
							<a href="edit.php?edit=<?php echo $row['Username']; ?>" id="edit" class="edit_btn" onclick='edit()' >Edit</a>
						</td>
						<td>
							<a data="login.php?del=<?php echo $row['Username']; ?>" onclick="del(this)" style='cursor: pointer;'  class="del_btn">Delete</a>
						</td> <!-- Uses functions edit and delete -->
					</tr>
				<?php } ?>
	
			</table>
			<span onclick="window.location.href ='register.php';" class="lnr lnr-chevron-left" id="backbutton" style=" position: absolute;cursor: pointer;top:7px;left:5px">  </span>
		</div>

		<div id="forma">
		
		<?php if (isset($_GET['edit'])) {?>
			<script type="text/javascript">
			$('#container').css({
        'justify-content': 'start',
        });
			$('#backbutton').css({
        'display': 'none',
        });
			$('#div').css({
        'left': '20px',
        });
        $('#forma').css({
        'display': 'block',
        });
		</script>
		<?php } ?>
		

			<form method="post" action="login.php" class="form">
				<div class="wrap-input100" style="position: relative">
					<input readonly class="input100" type="text" id="changingus" name="username" placeholder="Username" value="<?php if(isset($_SESSION['username2'])){echo ($_SESSION['username2']);}?>"> <!-- this input is for reading only -->
					<span  class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>
				<div class="wrap-input100">
					<input class="input100" type="text" id="changingpw" name="pass" placeholder="Password" value="<?php if(isset($_SESSION['password2'])){echo ($_SESSION['password2']);}?>" maxlength="30"> <!-- input for new password -->
					<span class="focus-input100" data-placeholder="&#xe80f;"></span> <!-- Linear icons -->
				</div>
					<?php if (isset($_SESSION['msg'])) {?> <!-- when the page is updated, editing form must stay visible.  -->
				<div style="color:red;margin-left: 25px;font-size: 18px;margin-top: 10px;">

					<script>
						$('#container').css({
        					'justify-content': 'start',
        									
        				});
        				$('#div').css({
        					'left': '20px',
        				});
        				$('#backbutton').css({
        					'display': 'none',
        				});
        				$('#forma').css({
        					'display': 'block',
       					});
					</script>

					<?php $message=$_SESSION['msg'];
					echo $message;
					unset($_SESSION['msg']);
					?>
				</div>
				<?php } ?>

				<div class="buttonstyle" style="  justify-content:center;position: relative;">
						
					<input class="button"  type="submit" name="update" value="UPDATE">
					<span onclick="list()" class="lnr lnr-chevron-left" style=" position: absolute;cursor: pointer;top:25px;left:30px">  </span>
				</div>

			</form>
		</div>

	</div>

	<script type="text/javascript">
		function edit(){
			$('#container').css({
        		'justify-content': 'start', //moves to the left
        	});
        	$('#div').css({
        		'left': '20px', // a little margin from left
        	});
        	$('#backbutton').css({
        		'display': 'none', //hides back button
        	});
        	$('#forma').css({
        		'display': 'block', //shows form of editing
        	});
		}
		function list(){
			$('#container').css({
        		'justify-content': 'center',
        	});
        	$('#forma').css({
        		'display': 'none',
        	});
			window.location.href ='edit.php';
		}
	</script>
	<script type="text/javascript">
    	function del(x) {
        	swal({
  				title: "Are you sure?",
  				text: "Once deleted, you will not be able to recover this account!",
  				icon: "warning",
  				buttons: true,
  				dangerMode: true,
			})
			.then((willDelete) => { //if it is confirmed
  		if (willDelete) {
    		window.location.href=x.getAttribute('data'); //take data attribute and head there
  		} else {

    		swal("This account is safe!"); //cancel the action
  		}
			});
        }
    </script>
</body>
</html>