<?php require("header.php"); ?>

<?php 
    $office_id = 1;

   /* $sql="Select video.video_name, video.video_code, pv.playlist_id , playlist_name, playlist_code
          from playlists 
          inner join playlists_videos pv on pv.playlist_id = playlists.playlist_id
          inner join videos video on video.video_id = pv.video_id
          where playlists.office_id= $office_id";
    */
    $sql = "Select  playlists.playlist_id , playlist_name, playlist_code , ifnull(vidcount,0) vidcount
    from playlists 
    left join (Select playlist_id, count(playlist_id) vidcount from playlists_videos group by playlist_id ) as plcounts
     on plcounts.playlist_id = playlists.playlist_id
     where playlists.office_id= $office_id";


    $res = mysqli_query($con,$sql);
    echo  mysqli_error($con);
   // echo "<h1>".  $sql    . "</H1>";

?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
       
            <?php require("menu.php") ?>
       
       

<div id="page-wrapper">
    <h3> Saved Playlists</h3>

    <table class="table">
        <tr>
            <th>Title / Count</th>
            <th>Code</th>
            <th>Action</th>
        </tr>
        <?php
         while ($obj = $res->fetch_object()){

        

?>
        <tr>
            <td> <?=$obj->playlist_name?> <small> ( <?=$obj->vidcount?> )</small></td>
            <td> <?=$obj->playlist_code?></td>
            <td style="font-size:14pt">
            <a href="playlist_share.php?plcode=<?=$obj->playlist_code?>"><i class="large fa fa-share"></i></a> &nbsp;&nbsp;&nbsp;
            <a href="build_playlist_edit.php?plcode=<?=$obj->playlist_code?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
            <a href="video_playlist_player.php?plcode=<?=$obj->playlist_code?>"><i class="fa fa-play-circle"></i></a>
                    
            </td>
        </tr>

        <?php  
            }
         ?>

    </table>
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>


</body>

</html>
