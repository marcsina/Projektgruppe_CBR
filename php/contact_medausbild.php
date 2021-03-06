﻿<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

include_once 'include/functions_contact.php';
//ini_set ("display_errors", "1");
//error_reporting(E_ALL);

sec_session_start();
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include ('include/header.php');
    ?>

        <!-- Bootstrap CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles -->
        <link href="../css/style-responsive.css" rel="stylesheet" />
        <link href="../css/jquery-ui-1.10.4.min.css" rel="stylesheet">

</head>

<?php
 include ('include/navbar.php');
?>
<body>
    <!-- container section start -->
    <!--logo end-->
    

        <!-- page start-->
        <div class="container">
            <!--
            <div class="col-lg-offset-1 col-lg-5">
                <div class="recent">
                    <h3>Send us a Message</h3>
                </div>
                <div id="sendmessage">Your message has been sent. Thank you!</div>
                <div id="errormessage"></div>
                <form action="" method="post" role="form" class="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" style="resize: vertical; min-height: 200px;"></textarea>
                        <div class="validation"></div>
                    </div>

                    <div class="text-center"><button type="submit" class="btn btn-primary btn-lg">Send message</button></div>
                </form>
            </div>-->

            <div class="col-lg-12">
                <div class="recent">
                    <h3>Contact</h3>
                </div>
                <div class="">
                    <p>Habt Ihr Fragen oder Anregungen zu Medausbild.de, so könnt ihr uns über folgende Daten erreichen:</p>

                    <h4>Address:</h4>
                    Universität Siegen
                    <br>
                    Institut für Wissensbasierte Systeme und Wissensmanagement 
                    <br>
                    Fakultät IV, Department für Elektrotechnik und Informatik 
                    <br>
                    Hölderlinstrasse 3 
                    <br>
                    D-57076 Siegen
                    <h4>Telefon:</h4>
                    (+49) 271 740-2642
                    <h4>Email:</h4>
                    <a href="mailto:sara.nasiri@uni-siegen.de">sara.nasiri@uni-siegen.de</a>
                </div>
            </div>
        </div>

        <!-- javascripts -->
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <!-- nice scroll -->
        <script src="../js/jquery.scrollTo.min.js"></script>
        <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
        <!--custome script for all page-->
        <script src="../js/scripts.js"></script>

</body>

</html>
