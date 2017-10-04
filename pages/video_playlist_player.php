<?php require("header.php") ?>

<body>
<?php
  //Get Playlist Name ... Add to DB
  
  //$playlist->name = $_POST["playlist_name"];
 
 $a = "";
 if (isset($_GET["plcode"]))
 {
    $plist = $_GET["plcode"];
    $a = "play"; //JUST a stupid flag to show the list or not.
     
        $sql = "Select playlists.playlist_name, videos.* from playlists 
                INNER JOIN playlists_videos on playlists.playlist_id = playlists_videos.playlist_id
                INNER JOIN videos on videos.video_id = playlists_videos.video_id
                 where playlist_code='" . $plist  . "'";

        $res = mysqli_query($con,$sql);
        echo  mysqli_error($con);
    

 }

?>

<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
            
                <?php
                while(($plv = $res->fetch_object()) && $a="play")
                {            
               
                ?>
                <div class="col-lg-12">
                    <h3 class="page-header center"> <?=$plv->playlist_name ?> </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
             
                <div class="col-md-12">
                <video class="img-responsive" id="video_stage" src="https://goo.gl/9gXP9H" onended="Next()" autoplay >    
                </video>
                    <div class="row center">
                        <button class="btn btn-default btn-lg col-md-4" onclick="Back()"><i class="fa fa-backward"></i> Back </button> &nbsp; &nbsp; &nbsp;
                        <button id="btn_pause" class="btn btn-default btn-lg col-md-4" onclick="Pause()"><i class="fa fa-pause"></i> Pause </button> &nbsp; &nbsp; &nbsp;
                        
                        <button class="btn btn-default btn-lg col-md-4" onclick="Next()"><i class="fa fa-forward"></i> Next </button> &nbsp; &nbsp; &nbsp;
                    </div>
                    

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

    <style>
        .btn {
            background-color: black;
            color: yellow;
        }
        .btn:active , .btn:focus {
            background-color: yellow;
            color: black;
        }
        .center {
            text-align: center;
        }

    </style>

    <script>
        function Pause(){
            var stage = document.getElementById("video_stage");
            var btn = document.getElementById("btn_pause");

            if (!stage.paused) {
                stage.pause();
                btn.innerHTML = "<i class='fa fa-play'></i> Play";
            }
            
            else {
                stage.play();
                btn.innerHTML = "<i class='fa fa-pause'></i> Pause";
            }


            
    
        }

        function Next() {
            alert('Get Next Video');
        }
    </script>

</body>

</html>
