<?php  include('login.php');
ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
$update=false;
$db = mysqli_connect('localhost', 'root', '', 'nisvid');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My videos</title>
    <link rel="stylesheet" type="text/css" href="style/edit5.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <?php /*its for sweetalert*/ ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
        #header-fixed { 
    position: fixed; 
    top: 0px; display:none;
    background-color:white;
}
    </style>
</head>
<body style="font-family: 'Ubuntu', sans-serif;height:100%;padding: 0;margin: 0;">
    <?php if (isset($_SESSION['deleted'])) {?>
            <script type="text/javascript">
                swal("Success!", "The video was deleted", "success");
            </script>
    <?php unset($_SESSION['deleted']); } ?>
        <?php

    $us=$_SESSION['user'];
    $res=mysqli_query($db, "Select * from admins WHERE Username='$us'");
    $row=mysqli_fetch_array($res);
    $results = mysqli_query($db, "SELECT * FROM videos WHERE uploader ='$us'"); 
    if(mysqli_num_rows($results) != 0) {?>
        <div style="position: absolute;height: 100%;">
        <span class="lnr lnr-chevron-left" onclick="window.location.href='upload.php'" style="position: sticky;color: white;z-index: 10;top: 5px;cursor: pointer;" ></ span></div>

        <table id="table-1" style="table-layout: fixed; "><!--table layout does not depend on content-->

            <thead>
                <tr>
                    <th style="width:50%;text-align: center;">Name</th> <!-- widths are set by percent -->
                    <th style="width:10%;text-align: center;">Grade</th>
                    <th style="width:20%;text-align: center;">VIDEO</th>
                    <th style= "width: 10%;text-align: center;">Action</th>
                </tr>
            </thead>
                <?php while ($row = mysqli_fetch_array($results)) {?>
            
                     <tr style="text-align: center;">
                        <td style="max-width: 100%;overflow-x: hidden;text-align: start;padding-left: 5px"> <?php echo $row['name']; ?></td>
                        <td> <?php 
                        $grade=$row['grade'];
                        $results3 = mysqli_query($db, "SELECT * FROM grades WHERE id ='$grade'");
                        $row2 = mysqli_fetch_array($results3); 
                        echo $row2['grade']; ?> 
                        </td>
                        <?php $dvdimage=$row['path'];?>
                        <td style="width: 100%; height: 30px;"> <video height="150px" width="266px" controls> <source src="<?php echo "$dvdimage" ?>" type="video/mp4"> </video>     
                        </td>
                        <td>
                            <a onclick="delet(this)" data="login.php?delete=<?php echo $row['id']; ?>" style='cursor: pointer;' class="del_btn">Delete</a>
                        </td>
                    </tr> 
            <?php } ?>
        </table>
        
        <table id="header-fixed"></table> <!--fixed columns-->
    <?php }else{?> <!-- no videos found -->
                    <table>
                        <thead>
                            <tr>
                                <th style="width:25%;text-align: center;">Name</th>
                                <th style="width:25%;text-align: center;">Grade</th>
                                <th style="width:25%;text-align: center;">VIDEO</th>
                                <th style= "width: 25%;text-align: center;">Action</th>
                            </tr>
                        </thead>
                    </table>
                <script type="text/javascript"> //error message
                    swal("Error!", "You did not upload any videos yet!", "error").then((value) => {window.location.href='upload.php';})
                </script>
    <?php } ?>
                <script type="text/javascript">
                    var tableOffset = $("#table-1").offset().top; 
                    var $header = $("#table-1 > thead").clone(); //takes thead 
                    var $fixedHeader = $("#header-fixed").append($header); //new header in new table

                    $(window).bind("scroll", function() { //when window is scrolled
                        var offset = $(this).scrollTop();

                        if (offset >= tableOffset && $fixedHeader.is(":hidden")) { //if the header is not shown
                            $fixedHeader.show(); //shows clone header
                        }
                        else if (offset < tableOffset) {
                            $fixedHeader.hide(); //hides clone
                        }
                    });
                </script>

    <script type="text/javascript">
        function delet(x) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this video!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href=x.getAttribute('data');
            } else {
                swal("Your video is safe!");
            }
        });
        }
    </script>
</body>
</html>
