<?php

require("../pages/db_connect.php");

$vid = $_POST["vid"];
$plid = $_POST["plid"];


$sql = "Insert into playlists_videos(video_id, playlist_id) values($vid, $plid) ";
$con->query($sql);




?>
