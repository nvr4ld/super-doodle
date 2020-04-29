<?php
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

session_start(); #starts session for user
$db = mysqli_connect('localhost', 'root', '', 'nisvid');
$username = "";
$password ="";
$name = "";


if (isset($_POST['enter'])) { 
	$password = $_POST['pass']; #password
	$username = $_POST['username']; #username
	
	if (empty($username)){
		$_SESSION['message'] = "Empty username"; #will be shown in div of the form
		header('location:acc.php'); #goes back to login page
	} 
	elseif (empty($password)) {
		$_SESSION['username']=$username; #user does not need to write the username second time
		$_SESSION['message'] = "Empty password"; 
		header('location:acc.php');
	}
	else{$query = "SELECT * FROM admins WHERE Username = '$username' AND password = '$password'";
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array($result);
		if (mysqli_num_rows($result) == 1) { #if there is a user with the same data as was input
			if (!empty($row['Developer'])) {
			$_SESSION['developer']='yes';
			}
			$_SESSION['user'] = $row['Username']; #if this session value is set, it provides access
			header('location:index.php'); 
			$_SESSION['message'] = "Successful login. Welcome, " . $row['surname']." ".$row['name']."!"  ;} 
		else {
			$_SESSION['password']=$password;
			$_SESSION['username']=$username;
 			$_SESSION['message'] = "Invalid login or password"; 
			header('location:acc.php');
		}
	}
}

if (isset($_GET['out'])) {
	session_destroy();
	session_start();
	$_SESSION['logout'] = "You successfully logged out"; 
	header('location:index.php');?>
<?php }

if (isset($_POST['save'])) {
		$username = $_POST['username'];
		$password = $_POST['pass'];
		$name = $_POST['name'];
		$surname=$_POST['surname'];
		if ((empty($username)) || (strlen((string)$username)!=12)){
			$_SESSION['message'] = "Please, type username correctly";
			$_SESSION['usernamereg']=$username; #saves each field
				$_SESSION['pwreg']=$password;
				$_SESSION['surnamereg']=$surname;
				$_SESSION['namereg']=$name;
			header('location:register.php');
		} 
		elseif (empty($password)) {
			$_SESSION['message'] = "Please, write password correctly"; 
			$_SESSION['usernamereg']=$username; #saves each field
				$_SESSION['pwreg']=$password;
				$_SESSION['surnamereg']=$surname;
				$_SESSION['namereg']=$name;
			header('location:register.php');
		}
		elseif (empty($surname)) {
			$_SESSION['message'] = "Please, write the surname"; 
			$_SESSION['usernamereg']=$username; #saves each field
				$_SESSION['pwreg']=$password;
				$_SESSION['surnamereg']=$surname;
				$_SESSION['namereg']=$name;
			header('location:register.php');
		}
		elseif (empty($name)) {
			$_SESSION['message'] = "Please, write the name"; 
			header('location:register.php');
			$_SESSION['usernamereg']=$username; #saves each field
				$_SESSION['pwreg']=$password;
				$_SESSION['surnamereg']=$surname;
				$_SESSION['namereg']=$name;
		}
		else{
			$query = "SELECT * FROM admins WHERE Username = '$username'" ;
			$result = mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			if (mysqli_num_rows($result) == 1) {
				$_SESSION['failure'] = "This username was already registered before"; 
				$_SESSION['usernamereg']=$username; #saves each field
				$_SESSION['pwreg']=$password;
				$_SESSION['surnamereg']=$surname;
				$_SESSION['namereg']=$name;
				header('location:register.php');
			} else{
				mysqli_query($db, "INSERT INTO admins (Username, password, surname, name) VALUES ('$username', '$password','$surname','$name')"); 
				$_SESSION['success'] = "Account has been registered successfully";  #successful registration
				header('location: register.php');}
		}
}

if (isset($_POST['update'])) {
	$username = $_POST['username'];
	$password = $_POST['pass'];
	if ((empty($password))) {
		$_SESSION['msg'] = "Please, enter the password"; //shown in the form
		header('location: edit.php');
	} else{
		mysqli_query($db, "UPDATE admins SET password='$password' WHERE Username='$username'");
		$_SESSION['updated'] = "Account has been updated!"; //shown as an alert
		unset($_SESSION['username2']); //unsets the username of edited account
		header('location: edit.php');  //goes back to the page
	}
}

if (isset($_GET['del'])) {
	$username = $_GET['del'];
	mysqli_query($db, "DELETE FROM admins WHERE Username='$username'");
	$_SESSION['deleted'] = "Account has been deleted"; 
	header('location: edit.php');
}
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	mysqli_query($db, "DELETE FROM videos WHERE id='$id'");
	$_SESSION['deleted']='true';
	header('location: mydocuments.php');
}

if (isset($_GET['download'])) {//if download button is clicked
	$id = $_GET['download'];
	$query=mysqli_query($db, "SELECT * from tasks WHERE id='$id'"); //take task with given id
	$row = mysqli_fetch_array($query);
	if (mysqli_num_rows($query) == 1) {
		$file=$row['path'];   //takes location of file from path
    	$filetype=filetype($file);
    	$filename=basename($file);
    	header ("Content-Type: ".$filetype);
    	header ("Content-Length: ".filesize($file));
    	header ("Content-Disposition: attachment; filename=".$filename);
    	readfile($file);//downloads file
	}
	header('location: tasks.php');
}
if (isset($_GET['downl'])) {
	$id = $_GET['downl'];
	$query=mysqli_query($db, "SELECT * from olympiads WHERE id='$id'");
	$row = mysqli_fetch_array($query);
	if (mysqli_num_rows($query) == 1) {
	   $file=$row['path'];   
       $filetype=filetype($file);
       $filename=basename($file);
       header ("Content-Type: ".$filetype);
       header ("Content-Length: ".filesize($file));
       header ("Content-Disposition: attachment; filename=".$filename);
       readfile($file);
	}
	header('location: olymp.php');
}



if (isset($_POST['uploadvideo'])) {
	$filename= basename($_FILES["fileToUpload"]["name"]); //saves name of the file, then checks input data
	if (empty($_POST['videoname']))  {
		$_SESSION['error']="Please, write the name of the video";
		header('location:uploadvideo.php');
	} 
	elseif(empty($filename)){
		$_SESSION['error']="Please, show the link to your video";
		header('location:uploadvideo.php');
	}
	elseif(empty($_POST['grades'])){
		$_SESSION['error']="Please, show the grade";
		header('location:uploadvideo.php');
	}
	elseif(empty($_POST['adv']) && empty($_POST['groups']) ){
		$_SESSION['error']="Please, show the study group";
		header('location:uploadvideo.php');}
	else{
		$target_dir = "uploads/"; //the file where video will be uploaded first
		$username1=$_SESSION['user'];
		$videoname=$_POST['videoname'];
		$allowed = array('wav', 'mp4'); //allowed extensions for video file
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed)) { //if its extension does not match given ones
    			$_SESSION['error']="not right extension";
 				header('location:uploadvideo.php');
		} else{ //if everything is OK
				$target_file = $target_dir . $filename;
    			if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) { //moves file to the uploads folder
    				$selected_grade=$_POST['grades'];
    				if (empty($_POST['adv'])) {
    						foreach ($_POST['groups'] as $selected_group){ //stores the data for each chosen group, if they are multiple
    							$query = "SELECT * FROM grades WHERE grade = '$selected_grade' AND studygroup = '$selected_group'" ;
								$result = mysqli_query($db,$query);
								$row = mysqli_fetch_array($result);
								$username1=$_SESSION['user'];//uploader
								$group=$row['id'];//grades id
    							mysqli_query($db, "INSERT INTO videos (name, path, uploader, grade) VALUES ('$videoname', '$target_file', '$username1', '$group')");
    						}
    						$_SESSION['Success2']="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
 							header('location:uploadvideo.php');
    				} else {
    					foreach ($_POST['adv'] as $selected_group){//if 11 or 12 chosen
    							$query = "SELECT * FROM grades WHERE grade = '$selected_grade' AND studygroup = '$selected_group'" ;
								$result = mysqli_query($db,$query);
								$row = mysqli_fetch_array($result);
								$username1=$_SESSION['user'];//uploader
								$group=$row['id'];//grades id
    							mysqli_query($db, "INSERT INTO videos (name, path, uploader, grade) VALUES ('$videoname', '$target_file', '$username1','$group')");
    					}
    				$_SESSION['Success2']="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
 					header('location:uploadvideo.php');
    				}
    			}
    	 		else {
    			$_SESSION['error']="Sorry, there was an error uploading your file.P";
 				header('location:uploadvideo.php');
				}
		}
	}
}

if (isset($_POST['uploadtask'])) {
	$filename=basename($_FILES["fileToUpload2"]["name"]);
	if (empty($_POST['taskname'])) {
		$_SESSION['error']="Please, write the name of the task";
		header('location:uploadtask.php');
	} 
	elseif(empty($filename)){
		$_SESSION['error']="Please, show the link to your task";
		header('location:uploadtask.php');
	}
	elseif(empty($_POST['grades'])){
		$_SESSION['error']="Please, show the grade";
		header('location:uploadtask.php');
	}
	elseif(empty($_POST['adv']) && empty($_POST['groups']) ){
		$_SESSION['error']="Please, show the study group";
		header('location:uploadtask.php');
	}
	else{
		$target_dir = "uploads/";
		$username1=$_SESSION['user'];
		$taskname=$_POST['taskname'];
		$allowed = array('docx');
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed)) {
    		$_SESSION['error']="not right extension";
 			header('location:uploadtask.php');
		} else{
			$target_file = $target_dir . $filename;
    		if (move_uploaded_file($_FILES['fileToUpload2']['tmp_name'], $target_file)) {
    			$selected_grade=$_POST['grades'];
    			if (empty($_POST['adv'])) {
    				foreach ($_POST['groups'] as $selected_group){
    					$query = "SELECT * FROM grades WHERE grade = '$selected_grade' AND studygroup = '$selected_group'" ;
						$result = mysqli_query($db,$query);
						$row = mysqli_fetch_array($result);
						$group=$row['id'];
    					mysqli_query($db, "INSERT INTO tasks (name, path, uploader, grade) VALUES ('$taskname', '$target_file', '$username1', '$group')");}
    				$_SESSION['Success2']="The file ". basename( $_FILES["fileToUpload2"]["name"]). " has been uploaded.";
 					header('location:uploadtask.php');
    			} else {
    				foreach ($_POST['adv'] as $selected_group){
    					$query = "SELECT * FROM grades WHERE grade = '$selected_grade' AND studygroup = '$selected_group'" ;
						$result = mysqli_query($db,$query);
						$row = mysqli_fetch_array($result);
						$group=$row['id'];
    					mysqli_query($db, "INSERT INTO tasks (name, path, uploader, grade) VALUES ('$taskname', '$target_file', '$username1', '$group' )");}
    				$_SESSION['Success2']="The file ". basename( $_FILES["fileToUpload2"]["name"]). " has been uploaded.";
 					header('location:uploadtask.php');
    			}		
    		} else {
    			$_SESSION['error']="Sorry, there was an error uploading your file.";
 				header('location:uploadtask.php');
    		}
		}
	}
}
if (isset($_POST['uploadolymp'])) {
	$filename= basename($_FILES["fileToUpload3"]["name"]);
	$datetime=date("Y-m-d");
	if (empty($_POST['olympiadname'])) {
		$_SESSION['error']="Please, write the name of the olympiad";
		header('location:uploadolymp.php');
	} 
	elseif(empty($_POST['date'])){
		$_SESSION['error']="Please, show the date";
		header('location:uploadolymp.php');}
	elseif ($_POST['date']<$datetime) {
		$_SESSION['error']="This contest is already past";
		header('location:uploadolymp.php');
	}
	elseif(empty($filename)){
		$_SESSION['error']="Please, show the link to the file-description";
		header('location:uploadolymp.php');
	}
	elseif(empty($_POST['grades'])){
		$_SESSION['error']="Please, show the grade";
		header('location:uploadolymp.php');}
	else{
		$target_dir = "uploads/";
		$olympname=$_POST['olympiadname'];
		$allowed = array('docx');
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed)) {
    		$_SESSION['error']="not right extension";
 			header('location:uploadolymp.php');
		} else{
			$date = $_POST['date'];
			$target_file = $target_dir . $filename;
    		if (move_uploaded_file($_FILES['fileToUpload3']['tmp_name'], $target_file)) {
    			foreach ($_POST['grades'] as $selected_grade){
    				$result=mysqli_query($db,"SELECT * FROM grades WHERE grade='$selected_grade'");
    				while ( $row=mysqli_fetch_array($result)) {
    					$id=$row['id'];
    					mysqli_query($db, "INSERT INTO olympiads (name, date, path, grade) VALUES ('$olympname', '$date', '$target_file', '$id' )"); }
    				$_SESSION['Success2']="The file ". basename( $_FILES["fileToUpload3"]["name"]). " has been uploaded.";}
 				header('location:uploadolymp.php');
    		} else {
    			$_SESSION['error']="Sorry, there was an error uploading your file.";
 				header('location:uploadolymp.php');
    		}
		}
	}
}

if (isset($_POST['hey'])) {
	

	switch($_POST['filetype']) {
        case "video":
			header('location:uploadvideo.php');
        break;
        case "task":
            header('location:uploadtask.php');
        break;
        case "Olympiad":
            header('location:uploadolymp.php');
        break;
        default:
    		$_SESSION['error']="Please, choose one type";
    		header('location:upload.php');
    	break;
    }
}
   
if (isset($_POST['grade2'])) {
	unset($_SESSION['taskgrade']);//чтобы когда нажимал отправить еще раз, видео исчезали
	unset($_SESSION['taskgroup']);
	if(empty($_POST['grades'])){
		$_SESSION['message']="Please, show the grade";
		header('location:tasks.php');}
		elseif(empty($_POST['adv']) && empty($_POST['groups']) ){
		$_SESSION['message']="Please, show the study group";
		header('location:tasks.php');}
		else{
			$_SESSION['taskgrade']=$_POST['grades'];
            				if (empty($_POST['groups'])) {
            					$_SESSION['taskgroup']=$_POST['adv'];}
            				else{
            					$_SESSION['taskgroup']=$_POST['groups'];	
            					}
	header('location:tasks.php');}
}
if (isset($_POST['grade1'])) {
	unset($_SESSION['videograde']);//when clicks find one more time, list is removed
	unset($_SESSION['videogroup']);
	if(empty($_POST['grades'])){
		$_SESSION['error']="Please, show the grade";
		header('location:videos.php');}
		elseif(empty($_POST['adv']) && empty($_POST['groups']) ){
		$_SESSION['error']="Please, show the study group";
		header('location:videos.php');}
		else{
			$_SESSION['videograde']=$_POST['grades'];
            				if (empty($_POST['groups'])) { //if the adv select is shown
            					$_SESSION['videogroup']=$_POST['adv'];}
            				else{//if the groups select is shown
            					$_SESSION['videogroup']=$_POST['groups'];	
            					}
	header('location:videos.php');}
}
if (isset($_POST['grade3'])) {
	unset($_SESSION['olympgrade']);//чтобы когда нажимал отправить еще раз, видео исчезали
	if(empty($_POST['grades'])){
		$_SESSION['message']="Please, show the grade";
		header('location:olymp.php');}
		else{
			$_SESSION['olympgrade']=$_POST['grades'];
header('location:olymp.php');
}}   
	?>