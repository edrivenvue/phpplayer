<?php session_start();

if (isset($_SESSION["currentUser"])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eDriven VUE - Videos</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

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
   

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" METHOD="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input type="hidden" name="action" value="login">
                                    <div class="hidden" id="errmsg">
                                        <strong>Opps!</strong> Invalid login and password.
                                    </div>
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>
<?php

        require("db_connect.php");

      if (isset($_POST["action"])){

        $action = $_POST["action"];

        $login = $_POST["email"];
        $pwd = $_POST["password"];

        $sql = "Select users.* , user_name, user_password  FROM users 
                INNER JOIN offices on offices.office_id = users.office_id        
                where user_status='active' and  user_email='" 
                . $login . "'  and user_password=md5('" . $pwd . "') ";

        $res = mysqli_query($con,$sql);
        echo  mysqli_error($con);
        echo $sql;

        $i =  mysqli_num_rows($res);
        ?>
        <script>
           document.getElementById("errmsg").className = "hidden";
        </script>
        <?php
        if ($i == 0 ) {
            //Set Error Message
            ?>
            <script>
               document.getElementById("errmsg").className = "alert alert-danger";
            </script>
            <?php
            $errmsg = "Invalid Email or Password";
        }
        else {

            //Set User Object Session
            $_SESSION["currentUser"] = $res->fetch_object();

            var_dump($_SESSION["currentUser"]);
             
            header("Location: index.php");

        }
            
      }



    ?>
</html>
