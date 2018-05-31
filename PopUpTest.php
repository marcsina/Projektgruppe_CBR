<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';

 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!doctype html>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>





        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link href="css/style.css" rel="stylesheet">


    </head>

    <body id="home">
		
		<!-- include Navbar -->
		<?php
			include ("php/include/navbar.php");
		?>

		


        <!-- _________________________Content________________________________-->
        <br>
        <br>
        <br>
        <br>

        <!-- every content should be nested in a way like the example below   -->

        <!-- nested columns -->
        <div class="row first-after-navbar">
            <form>
                <!-- first nested column -->
                <div class="col-md-4">

                </div>

                <!-- second nested column -->
                <div id="firstDiv" class="col-md-4">
                    <!-- column content -->
                    <button type="button" id="zoom">PopUp</button>


                </div>
				<!-- second nested column -->
                <div class="col-md-4">
                    <!-- column content -->


                </div>


        </div>


        <!-- Scripts -->

        <script src="js/jquery-2.2.2.min.js"></script>
		<script src="js/TweenMax.min.js"></script>
		<script src="js/popup.js"></script>

		

    </body>

</html>