<?php

require("../pages/db_connect.php");

$pvid = $_POST["pvid"];



$sql = "Delete from  playlists_videos Where playlist_video_id = $pvid ";
$con->query($sql);




?>
