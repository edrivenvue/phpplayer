<?php require("header.php");
    $usr = $_SESSION["currentUser"];

    if (isset($_POST["action"])){

        $usr->user_name = $_POST["user_name"];
        $usr->user_email = $_POST["user_email"];

        $sql=" Update users set user_name='" . $usr->user_name . "' , user_email='" .$usr->user_email . "'
               where  user_id = " . $usr->user_id;
        $_SESSION["currentUser"] = $usr;

        $con->query($sql);
       
    }
?>

<body>


<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header center">My Information</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" method="POST">
                        <div class="form-group">
                            <label>My Name</label>
                            <input type="hidden" name="action" value="update">
                            <input name="user_name" id="user_name" required class="form-control" value="<?=$usr->user_name?>">
                           
                        </div>
                        <div class="form-group">
                            <label>Phone</label>                
                            <input name="user_phone" id="user_phone" required class="form-control">
                           
                        </div>
                        <div class="form-group">
                            <label>Email</label>                
                            <input name="user_email" id="user_email"  class="form-control" value="<?=$usr->user_email?>">
                           
                        </div>

                                       
                        <button href="build_select.php" type="submit" class="btn btn-primary">Save</button>
                                        
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
