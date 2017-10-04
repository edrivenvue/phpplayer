<?php require("header.php")?>

<body>
<?php
  //Get Playlist Name ... Add to DB
  
 //$playlist->name = $_POST["playlist_name"];
 
 $a = "";
 if (isset($_POST["action"]))
 {
    $a = $_POST["action"];
    if ($a == "search") {
     // print_r("searching....");
        $category = $_POST['category'];
        $area = $_POST["area"];

        $sql = "Select * from videos where video_categories like '%|" . $category  . "|%' or video_areas like '%" . $area . "%'";
        $res = mysqli_query($con,$sql);
        echo  mysqli_error($con);
    }

 }

?>

<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header center">Browse Videos </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class=".">
                    <form role="form" class="form-inline" action="browse.php" method="POST">
                       
                        <div class="">
                        <input type=hidden name="action" value="search">
                            <select name="category" id="channel" style="width:140px;" class="form-control col-xs-4">
                                <option value="%-">Category</option>
                                <option>Optometric</option>
                                <option>Nutrition</option>
                                <option>Vitamins</option>
                            </select>
<!--
                            <select name="subject" id="subject" class="form-control col-md-4">
                                <option value="--">Subject</option>
                                <option>Dry Eye</option>
                                <option>Glacouma</option>
                                <option>Pink Eye</option>
                            </select>
-->
                            <select name="area" id="area"  style="width:140px;"  class="form-control col-xs-4">
                                <option value="%">Area</option>
                                <option>Conditions</option>
                                <option>Treatments</option>
                                <option>Definitions</option>
                            </select>
                            <button type="submit" class="btn btn-success  col-xs-4">
                                <i class="fa fa-search"></i> &nbsp; Search</button>
                        </div>
                                       
                       
                                        
                    </form>
                </div>
                                
            <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="divider">
                <br><br>
            </div>

            <?php
               if ($a == "search" && mysqli_num_rows($res) >0) {
                while($row = $res->fetch_object())
                {
                    $video_code = "";
                    $video_code = $row->video_code ;
                    $video_uri =  "video_single_player.php?video=" . $video_code;
                    //$video_uri = "search.php";
               
            ?>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <img class="float-left lst_thumb" src="/thumbnails/<?=$row->video_thumbnail?>" alt="Thumbnail">
                <div class="d-flex w-100 justify-content-between">
                    <h4 class="mb-1"><b> <?=$row->video_name?></b> </h4>
                   
                </div>
                    <p class="mb-1 small"><?=$row->video_description?></p>
                    <button onclick="window.location.href='<?=$video_uri?>';"> <i class="fa fa-play"></i> Play </button>
                   
                </a>
         
            </div>
            <?php
                }}
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
