<?php require("header.php") ?>

<body>
<?php
  //Get Playlist Name ... Add to DB
  
  //$playlist->name = $_POST["playlist_name"];
 
 $a = "";
 if (isset($_GET["video"]))
 {
    $vid = $_GET["video"];
    
     
        $sql = "Select * from videos where video_code='" . $vid  . "'";
        $res = mysqli_query($con,$sql);
       

        echo  mysqli_error($con);
    

 }

?>

<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
            
                <?php
                while($vid = $res->fetch_object())
                {            
               
                ?>
                <div class="col-lg-12">
                    <h3 class="page-header center"> <?=$vid->video_name?> </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
             
                <div class="col-md-12">
               <!-- <video class="img-responsive" src="https://goo.gl/9gXP9H" autoplay loop/> -->
               <video class="img-responsive" src="<?=$vid->video_url?>" autoplay loop/>
               <?=$vid->video_url?>
                </div>
            
                 
         
            </div>
            <?php
                }
            ?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
