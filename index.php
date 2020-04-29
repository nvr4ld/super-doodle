<?php include('login.php');
$db = mysqli_connect('localhost', 'root', '', 'nisvid');
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
$results3=""; 
$datetime=date("Y-m-d"); //todays date
$query=mysqli_query($db, "DELETE FROM olympiads WHERE date<'$datetime'");
?>

<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
	<meta charset="UTF-8">
	<title>Main Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style/hello3.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style/hello2.css">
	<link href="https://fonts.googleapis.com/css?family=Cardo&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">//это для исчезновения дива</script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?> 
</head>
<body id="bod" style="font-family: 'Ubuntu', serif;font-style: italic;margin:0;padding:0;height:100%;background-color: #f5f5dc;">
  <?php if (isset($_SESSION['message'])){?>
      <script type="text/javascript">
      swal("Success!", "<?php echo $_SESSION['message'] ?>", "success");
    </script>
    <?php unset($_SESSION['message']);
    }?>

    <?php if (isset($_SESSION['logout'])){?>
      <script type="text/javascript">
      swal("Success!", "You successfully logged out", "success");
    </script>
    <?php unset($_SESSION['logout']);
    }?>
  <section id="main">
	
    <div style="background-image: url(images/phonnis.png);height:625px;background-repeat: no-repeat;background-size: 100% 100%; ">

      <div  class="top"	>
		    <a href="index.php" style="width: 180px;margin-left: 10px"><img border="0" src="images/Logo.png" height="100%"></a>
		    <?php if (!empty($_SESSION['user'])) {?>
		      <div style="color: #ffffff;font-size: 30px;margin: auto;">
		        <?php 
		        $username1=$_SESSION['user'];
		        $query=mysqli_query($db, "SELECT * from admins WHERE Username='$username1'");
    	      $row = mysqli_fetch_array($query);
    	      $username2=$row['name'];
    	      $usersurname=$row['surname'];
		        echo $usersurname."&nbsp".substr($username2,0,1)."." ;
             ?>
		        <a href="login.php?out" style="text-decoration: none;">
              <span class="lnr lnr-exit" style="font-size: 25px;color: #ffffff;margin-left: 5px"></span>
            </a>
		 
	       </div>
		    <?php }?>
		      <div class="motiv" style="color: #ffffff;">It's your time to study! 
	        </div>
	    </div>

    <div class="header">
      <ul class="nav">
        <li id="active">
		      <a style="color: #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" href="index.php" >Main</a>
        </li>
        <li>
		      <a style="color: #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" href="index.php#section4">About</a>
        </li>
        <li>
		      <a style="color: #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" href=#>Contact</a>
          <ul>
            <li>
              <a style="color: #ffffff;;font-size: 20px;"  href=https://vk.com/id402129353>Vkontakte</a>
            </li>
             <li>
              <a style="color: #ffffff;font-size: 20px;" href=https://www.instagram.com/nvr4ld/?hl=ru>Instagram</a>
            </li>
            <li>
              <a style="color:#ffffff;font-size: 20px;" href="mailto:aldeken.nur.2003@gmail.com">Email</a>
            </li>
          </ul>
        </li>
		 
        <?php if (!empty($_SESSION['user'])) {?> <!-- if user is authenticated -->
          <li>
		 	      <a href="upload.php" style="color: #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" >Cabinet</a>
          </li>
          <?php if (!empty($_SESSION['developer'])){?> <!-- if user is developer/main admin -->
            <li>
		 	        <a href="register.php" style="color: #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);">Add teacher</a></li>

		      <?php }?>
		    <?php }else { ?>
          <li>
            <a style="color: #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" href="acc.php">LOGIN</a></li>

        <?php }?>
      </ul>

    </div>

   	<div>
      <nav style=" margin-left: 800px;border:0px;padding: 0;margin-top: 0">

		    <a style="font-size: 40px;color:  #ffffff;text-shadow: 3px 3px 3px rgba(150, 150, 150, 1)" class="navlink" href="videos.php">Videos</a>
		    <br>
		    <br>
		 
		    <a style="font-size: 40px;color:  #ffffff; text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" class="navlink" href="tasks.php">Tasks</a>
		 
		    <br>
		    <br>
		    <a style="font-size: 40px;color:  #ffffff; text-shadow: 3px 3px 3px rgba(150, 150, 150, 1);" class="navlink" href="olymp.php">Olympiad information</a>
		  </nav>
    </div>


    
    
    </div>
  </section>

  <section id="section4" style="height: 625px;width: 100%;position: absolute;">
    <br>
    <h1 style="width: 100%;text-align: center;border-bottom: 1px solid #000;line-height: 0.1em;margin: 10px 0 20px; "><span style=" background:#f5f5dc; padding:0 10px; ">What is NisVid?</span></h1>
	
    <section class="container" >
      <div class="left-half">
        <div class="cont">
          <img src="images/hi1.jpg" class="image">
          <div class="overlay">
          <div class="text">NisVid - is the modern solution of the problem of lack of resources</div>
          </div>
        </div>
      </div>
      <div class="right-half">
        <div class="cont">
          <img src="images/hi2.jpg" class="image">
          <div class="overlay">
            <div class="text">NisVid - is a new step towards reaching independent learning</div>
          </div>
        </div>
      </div>
    </section>

    <section class="container">
      <div class="left-half">
        <div class="cont">
          <img src="images/hi3.jpg" class="image">
          <div class="overlay">
            <div class="text">NisVid - is your helper that you can approach to any time you want</div>
          </div>
  	    </div>
      </div>
      <div class="right-half">
        <div class="cont">
          <img src="images/hi7.jpg" class="image">
          <div class="overlay">
            <div class="text">NisVid - is a result of hours of hard work of both students and teachers that will support education for many years</div>
          </div>
  	    </div>
      </div>
    </section>

  </section>
  <button onclick="window.location.href = '#main'"; id="myBtn" title="Go to top">Top</button>
  <script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
      } else {
      mybutton.style.display = "none";
      }
    }


  </script>

</body>
</html>
