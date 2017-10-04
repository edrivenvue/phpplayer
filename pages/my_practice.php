<?php require("header.php")?>

<body>


<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header center">My Practice</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" action="build_select.php">
                        <div class="form-group">
                            <label>Company Name</label>                
                            <input name="office_name" id="office_name" required class="form-control">
                           
                        </div>
                        <div class="form-group">
                            <label>Website</label>                
                            <input name="office_website" id="office_website" required class="form-control">
                           
                        </div>
                        <div class="form-group">
                            <label>Phone</label>                
                            <input name="office_phone" id="office_phone"  class="form-control">
                           
                        </div>

                        <div class="form-group">
                            <label>Address</label>                
                            <textarea name="office_address" id="office_address"  class="form-control">
                            </textarea>                                
                            
                           
                        </div>

                                       
                        <button type="submit" class="btn btn-primary">Save</button>
                                        
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
