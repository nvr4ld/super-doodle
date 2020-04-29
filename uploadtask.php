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
    <link rel="stylesheet" type="text/css" href="style/upload3.css">
    <link rel="stylesheet" type="text/css" href="style/login2.css">
    <link rel="stylesheet" type="text/css" href="style/select2.css">
    <title>Tasks</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="font-family: 'Ubuntu', sans-serif;height:100%;padding: 0;margin: 0;font-size: 22px;">
    <?php if (isset($_SESSION['Success2'])) {?>
        <script type="text/javascript">
            swal("Success!", "<?php echo $_SESSION['Success2'] ?>", "success");
        </script>
    <?php unset($_SESSION['Success2']);}
    ?>
    <?php if (isset($_SESSION['error'])) {?>
        <script type="text/javascript">
            swal("Error!", "<?php echo $_SESSION['error'] ?>", "error");
        </script>
    <?php unset($_SESSION['error']);}
    ?>
    <div class="container" style="background-image: url('images/phon3.jpg');justify-content: center;display: flex;" id="cont">
        <form action="login.php" method="post" enctype="multipart/form-data" class="form">
            Select task to upload:
            <br>
            <label for="fileToUpload2" class="custom-file-upload" style="margin-top: 5px"> <span class="lnr lnr-cloud-upload">  </span>Upload</label>
            <input type="file" name="fileToUpload2" id="fileToUpload2">
            <br>
            Write the topic of your task:
            <br>
            <input type="text" name="taskname">
            <br>
            Select the grade:
            <br>
            <div class="box">
                <select id="grades" name="grades" style="vertical-align: top;" onchange="myFunction()">
                    <option value="" selected disabled hidden>Choose a grade</option>
                    <?php $query=mysqli_query($db, "SELECT DISTINCT grade FROM grades");
                    while ($row = mysqli_fetch_array($query)) { 
                        ?><option value="<?php echo $row['grade'] ?>"><?php echo $row['grade']; ?></option><?php }?> 
                </select>
             </div>
            <div class="box">
                <select id="groups" name="groups[]" style="display: none;vertical-align: top;margin-top:5px;overflow-y: auto;" multiple size='2'>
                <?php $query=mysqli_query($db, "SELECT DISTINCT studygroup FROM grades WHERE grade!=11 and grade!=12 ");
                while ($row = mysqli_fetch_array($query)) { 
                    ?><option style="padding: 5px" value="<?php echo $row['studygroup'] ?>"><?php echo $row['studygroup']; ?></option><?php }?> 
                </select>
            </div> 
            <div class="box">
                <select id="advanc" name="adv[]" style="display: none;vertical-align: top;margin-top:5px" multiple size="4">
                <?php $query=mysqli_query($db, "SELECT DISTINCT studygroup FROM grades");
                     while ($row = mysqli_fetch_array($query)) { 
                        ?><option style="padding: 0px;" value="<?php echo $row['studygroup'] ?>"><?php echo $row['studygroup']; ?></option><?php }?> 
                </select>
            </div>
            <script type="text/javascript">
                function myFunction() {
                    var x = document.getElementById("grades").value;
                    if (x == "11" || x=="12") {
                        document.getElementById("advanc").style.display = "block";// выходят селекты
                        document.getElementById("groups").style.display = "none";
                    } else{
                        document.getElementById("groups").style.display = "block";
                        document.getElementById("advanc").style.display = "none";}
                }
            </script>
            <div style="line-height: 25%">
                <br>
            </div >
            <div style="justify-content: center;display: flex">
            <input style="vertical-align: top;" class="button2" type="submit" value="Upload task" name="uploadtask">
            <span onclick="window.location.href ='upload.php';" class="lnr lnr-chevron-left" style="position: absolute;bottom: 30px;left: 10px;font-size: 25px;cursor:  pointer;">  </span>
            </div>
        </form>
    </div>
</body>
</html>