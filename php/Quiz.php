<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_quiz.php';

sec_session_start();

debug_to_console("QuizID: ".$_SESSION["quiz_id"]."Playernumber: ".$_SESSION['player']."Type ".$_SESSION['type']);

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<html lang="de">

<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>




    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <link href="../css/style3.css" rel="stylesheet">

    <!-- animate.CSS -->
    <link rel="stylesheet" href="../css/animate.css" />

    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />




</head>
<!-- _______________________________________NavBar_____________________________________________________-->
    <?php
    include ("include/navbar.php");
    ?>

<body id="home" style="">

    <div class="container">

        <!-- nested columns -->
        <div class="row">

            <header class=" col-md-12" style="font-weight: 15px; font-size: 30px; text-align: center ; color: brown; animation-duration: 0s; animation-delay: 0s; animation-iteration-count: 0;" title=" a small Quiz">
                <b> Topic: </b> What do you know about Demenz ?
            </header>
        </div>
        <!-- "" MIni menu leftside and question box" -->

        <div class="row">
            <!-- "" reasearch bar" -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <br>
                <!-- Timer-->
                <div class="col-md-12">
                    <p id="timer" class=" " title=" Time-left" style="text-align: center; font-size: 40px; color: green; animation-duration: s; animation-delay: s; animation-iteration-count: ;"> </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" questionsection " id="1" style=" padding-left: 10px ; padding-right: 10px;">
                <h3 style=" color: blue;">
                    <b>Frage</b> <span id="span_QuestionNumber" style=" color: red; ">1</span> of 12: <span class="animated fadeIn" style=" color: #ff7f00 ; animation-duration: 3s; animation-delay: 0s; animation-iteration-count: ; ">(Fall-beschreibung)</span>
                </h3>
                <!-- "progress bar" -->
                <div class="progress">
                    <?php

                        $array = getProgressionData($mysqli, $_SESSION['type'], $_SESSION['user_id'], $_SESSION['quiz_id'], $_SESSION['player']);
                        $currentQuestionNumber = $array[0]['countAnsweredQuestions'];
                        $maximumQuestions = $array[0]['countQuestions'];
                    ?>
                    <div class="progress-bar progress-bar-info progress-bar-striped active massive-font" role="progressbar" aria-valuenow="<?php echo $currentQuestionNumber;?>" aria-valuemin="0" aria-valuemax="<?php echo $maximumQuestions;?>" style='<?php echo "width:".(($currentQuestionNumber / $maximumQuestions)*100)."%";?>'>
                        <?php echo (($currentQuestionNumber / $maximumQuestions) *100)."%";?>
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

						$questionData = getQuizData($mysqli, $_SESSION['type'], $_SESSION["quiz_id"], $_SESSION['player']);

						//Quiz running
						if($questionData != "Finish")
						{
							echo "". $questionData[0]['questionString'];
						}
						//Quiz Finished
						else if($questionData == "Finish")
						{
							if($_SESSION['type'] == "SP")
							{
								endSPQuiz($mysqli, $_SESSION['user_id']);
							}
							else
							{
								endMPQuiz($mysqli, $_SESSION["quiz_id"], $_SESSION['user_id']);
							}
                            echo "<script type='text/javascript'> document.location = 'Quiz_Endseite.php'; </script>";
                            exit();
						}
						//Quiz Error
						else
						{
						//TODO: DELETE QUIZ
						//header("Refresh:0");
						}

						$answerData = shuffleAnswers($questionData[0]['answer1'],$questionData[0]['answer2'],$questionData[0]['answer3'],$questionData[0]['answer4']);



                    ?>
                </div>
                <!-- " Answer section" -->
                <h2 style="text-align: center"> <b> Antwort </b></h2>
                <!-- TODO BUTTONS einfÃ¼gen-->
                <form action="" method="post">
					<input type='hidden' name='positionAnswer1' value='<?php echo $answerData['positionAnswer1'];?>'>
                    <input type='hidden' name='positionAnswer2' value='<?php echo $answerData['positionAnswer2'];?>'>
                    <input type='hidden' name='positionAnswer3' value='<?php echo $answerData['positionAnswer3'];?>'>
                    <input type='hidden' name='positionAnswer4' value='<?php echo $answerData['positionAnswer4'];?>'>
                    <input type="submit" class="btn btn-default btn-sm btn-block" name="antwort1_Button" value="<?php echo $answerData['antwort1'];?>">
                    <input type="submit" class="btn btn-default btn-sm btn-block" name="antwort2_Button" value="<?php echo $answerData['antwort2'];?>">
                    <input type="submit" class="btn btn-default btn-sm btn-block" name="antwort3_Button" value="<?php echo $answerData['antwort3'];?>">
                    <input type="submit" class="btn btn-default btn-sm btn-block" name="antwort4_Button" value="<?php echo $answerData['antwort4'];?>">
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
    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>


</body>

</html>