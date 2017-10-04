<?php require("../pages/db_connect.php") ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eDriven VUE Player</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<?php
  //Get Playlist Name ... Add to DB
  
  //$playlist->name = $_POST["playlist_name"];
 
 $a = "";
 if (isset($_GET["x"]))
 {
    $plist = $_GET["x"];
    
    $sql = "Select playlists.playlist_name, videos.* from playlists 
    INNER JOIN playlists_videos on playlists.playlist_id = playlists_videos.playlist_id
    INNER JOIN videos on videos.video_id = playlists_videos.video_id
     where playlist_code='" . $plist  . "'";

    $res = mysqli_query($con,$sql);
    echo  mysqli_error($con);

       

        echo  mysqli_error($con);
    

 }

?>

<div id="wrapper">
   
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
               <video class="img-responsive"  width="700" id="vidplay" height="900" controls muted autoplay loop preload>
               
                    <source src="<?=$vid->video_url?>" type="video/mp4"> 
                    <source src="http://techslides.com/demos/sample-videos/small.webm" type="video/webm">  
                </video>
               
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
