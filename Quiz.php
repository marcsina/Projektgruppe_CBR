<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';
include_once 'php/include/functions_quiz.php';


sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
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


        <link href="css/style3.css" rel="stylesheet">

        <!-- animate.CSS -->
        <link rel="stylesheet" href="css/animate.css" />

        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>




    </head>
    <!-- _______________________________________NavBar_____________________________________________________-->
    <?php
    include ("php/include/navbar.php");
    ?>

    <body id="home" style= "">

        <div class="container">

            <!-- nested columns -->
            <div class="row" >

                <header class=""  class=" col-md-12" style="font-weight: 15px; font-size: 30px; text-align: center ; color: brown; animation-duration: 0s; animation-delay: 0s; animation-iteration-count: 0;" title=" a small Quiz">
                    <b> Topic: </b> What do you know about Demenz ?
                </header>
            </div>
            <!-- "" MIni menu leftside and question box" --> 

            <div class="row">
                <!-- "" reasearch bar" -->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br>
                    <!-- Timer-->   
                    <div class="col-md-12" >
                        <p id="timer" class=" " title=" Time-left" style="text-align: center; font-size: 40px; color: green; animation-duration: s; animation-delay: s; animation-iteration-count: ;"> </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" questionsection " id="1" style=" padding-left: 10px ; padding-right: 10px;">                    
                    <h3 style=" color: blue;"> <b>Frage</b> <span id="span_QuestionNumber" style=" color: red; ">1</span> of 12: <span  class="animated fadeIn" style=" color: #ff7f00 ; animation-duration: 3s; animation-delay: 0s; animation-iteration-count: ; ">(Fall-beschreibung)</span>
                    </h3>
                    <!-- "progress bar" -->
                    <div class="progress" >
                        <div class="progress-bar progress-bar-info progress-bar-striped active massive-font" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=" width:5%">
                            5%
                        </div>
                    </div>


                </div>
            </div>
            <!-- "" Question section" -->
            <div class="row">
                <div class=" col-md-12">

					<!-- eigentliche Frage -->
                    <div id="div_question">
						<?php
						$questionData = loadRandomQuestion($mysqli);
						echo utf8_decode("Welches ist ein stark ausgeprägtes Symptom in dem Fall ". $questionData['casename'] . "?");		 
						?>
					</div>
                    <!-- " Answer section" -->               
                    <h2 style="text-align: center"> <b> Antwort </b></h2>
					<!-- TODO BUTTONS einfügen-->
                    <form action="" method="post">
						<input type="hidden" name="correctanswer" value="<?php echo $questionData['correctAnswerPosition'];?>"/>
                        <input type="submit" class="btn btn-default btn-sm btn-block" name="antwort1_Button" value="<?php echo $questionData['antwort1'];?>"/>
						<input type="submit" class="btn btn-default btn-sm btn-block" name="antwort2_Button" value="<?php echo $questionData['antwort2'];?>"/>
						<input type="submit" class="btn btn-default btn-sm btn-block" name="antwort3_Button" value="<?php echo $questionData['antwort3'];?>"/>
						<input type="submit" class="btn btn-default btn-sm btn-block" name="antwort4_Button" value="<?php echo $questionData['antwort4'];?>"/>                          
                    </form>                            
                </div>

                <div class="col-md-4">
                    <!-- " TODO Bild Section " -->                 
                    <h2 style="font-weight: bold;font-size:20px; color: brown; text-align: center;"></h2>
                    <div id="image">
                    </div>
                </div>
            </div>			            
        </div>




        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/Quiz.js"></script>


    </body>

</html>