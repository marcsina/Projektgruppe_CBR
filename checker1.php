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
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>





        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link href="css/style3.css" rel="stylesheet">

    </head>

    <body id="home">
        <!-- _______________________________________NavBar_____________________________________________________-->

        <?php
        include ("php/include/navbar.php");
        ?>

        <!-- _________________________Content________________________________-->
        <br>
        <br>

        <!-- every content should be nested in a way like the example below  -->

        <!-- nested columns -->
        <div class="row first-after-navbar">

        <div class="col-md-offset-4 col-md-4 col-sm-8" >
            <h3 class="checken">Wie wollen sie checken</h3>
           
            </br>
            <div class="row">
                <div class="col-md-5 col-sm-5"><a href="checkereinhacken.php" type="bouton" class="btn btn-danger btn-lg"></br>symptom</br> checker</a></div> 
               <div class="col-md-offset-2 col-md-5 col-sm-5"><a href="checkertext.php" type="bouton" class="btn btn-danger btn-lg"></br></br>fall checker</a></div> 
              

        </div>
            
        </div>

           
        </div>



        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/german-porter-stemmer.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>