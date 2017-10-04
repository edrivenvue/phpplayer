<?php require("header.php")?>

<body>
<?php
  //Get Playlist Name ... Add to DB
$playlist  = new stdClass();
$usr = $_SESSION["currentUser"];
$plcode = $_GET["plcode"];

 if (isset($_POST["playlist_id"])) {
     $playlist->playlist_id = $_POST["playlist_id"];
 }
 else {
    $sql = "SELECT * FROM playlists WHERE playlist_code='" . $_GET["plcode"] . "'";
    $res = mysqli_query($con,$sql);
    $playlist = $res->fetch_object();

 }

$a = ""; 
 if (isset($_POST["action"])){

    $a = $_POST["action"];
    
 }



if ($a == "add") {
    
    $sql_ins = "INSERT INTO playlists (playlist_name,office_id,user_id)
                values('$playlist->name','$usr->office_id','$usr->user_id') ";
    $con->query($sql_ins);
    echo "<h1>".  mysqli_error($con) . "</H1>";
    $last_id = $con->insert_id;
    $code =  str_pad(dechex($last_id),5,"0",STR_PAD_LEFT);
    $playlist->code = "EPL" . $code;
    $playlist->playlist_id = $last_id;

    $sql_update = "Update playlists set playlist_code= '" . $playlist->code . "'  where playlist_id =" .  $last_id;
    $con->query($sql_update);
    echo "<h1>".  mysqli_error($con)    . "</H1>";


}
 //If sent from the same post. 
if ($a == "search") {
    // print_r("searching....");
        $category = $_POST['category'];
        $area = $_POST["area"];

        $sql = "Select * from videos where video_categories like '%|" . $category  . "|%' or video_areas like '%" . $area . "%'";
        $res = mysqli_query($con,$sql);

        $playlist_sql = "Select * from playlists where playlist_code='" . $plcode . "'";
        $playlist_res = mysqli_query($con,$playlist_sql);
        $playlist = $playlist_res->fetch_object();

       // echo  mysqli_error($con);

       
}

$pla_sql = "Select playlist_video_id, videos.* from playlists_videos pv
INNER JOIN playlists p on p.playlist_id = pv.playlist_id
INNER JOIN videos on videos.video_id = pv.video_id
WHERE p.playlist_code='" . $plcode . "'";
$plres = mysqli_query($con,$pla_sql);

?>

<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Playlist - <?=$playlist->playlist_name?> </h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!---------  SHOW  LIST OF VIDEOS LINKED ------>
            <?php if (mysqli_num_rows($plres)) {
               
            ?>
            <div class="row">
                    <div class="col-xs-3 sm-header"> Title </div>

                    <div class="col-xs-3 right sm-header"> Length </div>
                    <div class="col-xs-3 right sm-header-icon"><i class="fa fa-refresh"></i> </div>



            </div>
            <?php
                 while ($pla = $plres->fetch_object()) {
            ?>                                         
            <div class="row">
                    <div class="col-xs-3"> <?=$pla->video_name?> </div>

                    <div class="col-xs-3 right"> <?=$pla->video_length?> </div>
                    <div class="col-xs-3 center"><a href="#" onclick="removeItem(<?=$pla->playlist_video_id?>);"><i class="remove-icon fa fa-minus-circle"></i>  </a> </div>



            </div>

             <?php
                 }
                }
             ?>
            <!----   END LIST ------------------------ -->


            <div class="row">
                <div class=".">
                    <form role="form" class="form-inline" METHOD="POST">
                        <input type=hidden name="action" value="search">
                        <input type=hidden name="playlist_name" id="playlist_name" value="<?=$playlist->name?>">
                        <input type=hidden name="playlist_id" id="playlist_id" value="<?=$playlist->playlist_id?>">
                        <input type="hidden" id="plcode" name="plcode" value="<?=$playlist->code?>">

                        <div class="">
                            
                            <select name="category" id="channel" class="form-control col-md-4">
                                <option value="">Channel</option>
                                <option>Optometric</option>
                                <option>Nutrition</option>
                                <option>Vitamins</option>
                            </select>
                            <select name="area" id="area" class="form-control col-md-4">
                                <option value="">Area</option>
                                <option>Conditions</option>
                                <option>Treatments</option>
                                <option>Definitions</option>
                            </select>
                            <button type="submit" class="btn btn-danger  col-md-2">
                                <i class="fa fa-search"></i> &nbsp; Search</button>
                        </div>
                                       
                       
                                        
                    </form>

                </div>

                <?php
               if ($a == "search" && mysqli_num_rows($res) >0) {
                while($row = $res->fetch_object())
                {
                    $video_code = "";
                    $video_code = $row->video_code ;
                    $video_uri =  "video_single_player.php?video=" . $video_code;
                    $video_id = $row->video_id;

                    //$video_uri = "search.php";
               
            ?>
            <hr>
            <div class="panel container ">
                
                <img  src="/thumbnails/<?=$row->video_thumbnail?>" alt="Thumbnail" class="lst_thumb">
                <div class="d-flex w-100 justify-content-between">
                    <h4 class="center"><b> <?=$row->video_name?></b> </h4>
                   
                </div>
                    <p class="mb-1 small padding"><?=$row->video_description?></p>
                    <button class="btn btn-default" onclick="addToPlaylist(this,'<?=$playlist->playlist_id?>' , '<?=$video_id?>');"> <i class="fa fa-plus-circle"></i> Add </button>
                   
               
         
            </div>
            <?php
                }}
            ?>
                                
            <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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

<script>

    function addToPlaylist(obj,plid,videoid) {

        var plcode = document.getElementById("plcode").value;
        console.log(document.getElementById("playlist_id").value);
        console.log(plcode);


        if (obj.innerHTML.indexOf('ADDED') > 0 ) {
            alert('ALREADY ADDED !!!!');
        }
        else {
            var postdata = {};
                postdata["vid"] = videoid;
                postdata["plid"] = plid;
                console.log(postdata);

            $.post("/api/pl_add.php", postdata,
            function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
            });
        }

        obj.innerHTML = " <i class=\"fa fa-check\"></i>  ADDED ";
        


    }

    function removeItem(pvid){
        var postdata = {};
            postdata["pvid"] = pvid;

            $.post("/api/pl_removeitem.php", postdata,
            function(data, status){
                location.reload();
            });

    }

</script>
