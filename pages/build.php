<?php require("header.php")?>

<body>


<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header center">Enter A Name For Your Playlist</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" action="build_select.php" METHOD="POST">
                        <div class="form-group">
                            <input type="hidden" name="action" value="add">
                            <input name="playlist_name" id="playlist_name" required class="form-control">
                            <p class="help-block">ex: Name - Condition - Date</p>
                        </div>
                                       
                        <button href="build_select.php" type="submit" class="btn btn-primary">Next</button>
                                        
                    </form>
                </div>
                                
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
