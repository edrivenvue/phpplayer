<?php require("header.php");
 require ('../vendor/autoload.php');
 use Twilio\Rest\Client;
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
// Your Account SID and Auth Token from twilio.com/console
$sid = 'ACb8b520af870054c62246a0d08e43451c';
$token = 'bf5392bbc5ac84ecba978cac5dc4e17a';
$client = new Client($sid, $token);

//echo var_dump($_SESSION["currentUser"]);
$usr = $_SESSION["currentUser"];
$txt_msg  ="";

?>

<body>
<?php
  //Get Playlist Name ... Add to DB
  
  //$playlist->name = $_POST["playlist_name"];
 
 $a = "";

 $pl = new stdClass();
 $plcode = $_GET["plcode"];
 

$pl->playlist_name = "DEMO PLAYLIST";

 if (isset($_POST["action"]))
 {
    $a = "send";
    $sms_number = "";
    $email = "";
    $txt_msg = "Dr. ". $usr->user_name . " from ___ has shared a VUE playlist with you. http://p.edrivenvue.com/pp?x=" . $plcode;

    if (isset($_POST["sms_number"])){
        $sms_number = $_POST["sms_number"];
       
        

       
       

       // Use the client to do fun stuff like send text messages!
       $client->messages->create(
           // the number you'd like to send the message to
           $sms_number,
           array(
               // A Twilio phone number you purchased at twilio.com/console
               'from' => '+15137709327 ',
               // the body of the text message you'd like to send
               'body' => $txt_msg
           )
       );
       $sendmsg = "SMS Sent: " . $sms_number;

    }

    if (isset($_POST["email"])){
        $email = $_POST["email"];

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.sendgrid.net';
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'apikey';                 // SMTP username
            $mail->Password = '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';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('noreply@edrivenvue.com', $usr->user_name);
            $mail->addAddress($email);     // Add a recipient
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your Shared Playlist';
            $mail->Body    = $txt_msg;

            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
           // echo 'Message has been sent';
           $sendmsg .= "   Email Sent:". $email ;
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }


    }
    
    

    ?>
    <script>alert("<?=$sendmsg?> ");</script>
    <?php 
         
 }

?>

<div id="wrapper">

        <?php  require("menu.php") ?>
   
        <div id="page-wrapper">
            <div class="row">
            
                <div class="col-lg-12">
                    <h3 class="page-header center"> Share Playlist
                         <small> <?=$pl->playlist_name?>   &nbsp; {<?=$plcode?> } </small></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
             
                <div class="col-md-12 center">
                    <form action="" method="POST" class="form-inline">
                        <input type="hidden" name="action" value="send">
                        <div class="input-group">
                            <label> SMS: </label>
                            <input type="text" class="form-control" name="sms_number" placeholder="555-333-1234">
                        </div>
                        <br><br>
                        <h4> AND/OR </h4>

                        <br><br>
                        <div class="input-group">
                            <label> Email: </label>
                            <input type="email" class="form-control" name="email" placeholder="name@server.com">
                        </div>

                        <div>
                            <button class="btn btn-primary" type=submit><i class="fa fa-share"></i> Share </button>

                        </div>
                    </form>
                </div>
            
                 
         
            </div>
            <?php
              
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
