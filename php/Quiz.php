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
    header('Location: http://141.99.248.92/Projektgruppe/php/login.php?logged=0');
	exit;
}
?>
<html lang="de">

<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />

    <!--<link href="../css/style3.css" rel="stylesheet">-->

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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" style="border: 2px solid #007bff ;">
                <div class="row">
                    <!-- "" reasearch bar" -->
                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;">
                        <div class=" questionsection " id="1">
                            <?php

                            $array = getProgressionData($mysqli, $_SESSION['type'], $_SESSION['user_id'], $_SESSION['quiz_id'], $_SESSION['player']);
                            $currentQuestionNumber = $array[0]['countAnsweredQuestions'];
                            $maximumQuestions = $array[0]['countQuestions'];
                            ?>
                            <h3 style=" color: #007aff;">
                                <b>Frage</b>
                                <span id="span_QuestionNumber">
                                    <?php echo $currentQuestionNumber+1;?>
                                </span> of <?php echo $maximumQuestions;?>:
                                <span class="animated fadeIn" style=" color: #ff7f00 ; animation-duration: 3s; animation-delay: 0s;">
                                    (Wählen Sie bitte die richtige (
                                    <span class="glyphicon glyphicon-ok"></span> ) Antwort)
                                </span>
                            </h3>
                            <br />
                            <!--
                            <div class="progress">
                                <div class="progress-bar progress-bar-info progress-bar-striped active massive-font" role="progressbar" aria-valuenow="<?php echo $currentQuestionNumber;?>" aria-valuemin="0" aria-valuemax="<?php echo $maximumQuestions;?>" style='<?php echo "width:".(($currentQuestionNumber / $maximumQuestions)*100)."%";?>'>
                                    <?php echo (($currentQuestionNumber / $maximumQuestions) *100)."%";?>
                                </div>
                            </div>-->
                        </div>

                        <!-- "" Question section" -->

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- eigentliche Frage -->
                            <div class="col-lg-12 col-md-12 col-sm-12" id="div_question">
                                <h3>
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
                                </h3>
                            </div>
                            <br />
                            <br />
                            <br />

                            <!-- " Answer section" -->

                            <h3 style="text-align: center;">
                                <b> Anworten </b>
                            </h3>

                            <br />

                            <!-- TODO BUTTONS einfÃ¼gen-->

                            <form action="" method="post">
                                <input type='hidden' name='positionAnswer1' value='<?php echo $answerData['positionAnswer1'];?>' />
                                <input type='hidden' name='positionAnswer2' value='<?php echo $answerData['positionAnswer2'];?>' />
                                <input type='hidden' name='positionAnswer3' value='<?php echo $answerData['positionAnswer3'];?>' />
                                <input type='hidden' name='positionAnswer4' value='<?php echo $answerData['positionAnswer4'];?>' />

                                <div class="form" style=" text-align: center;">

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input style="text-align: center; font-style: italic; background:#007bff;color: white;"
                                            type="submit" class=" form-control btn btn-info" name="antwort1_Button" value="<?php echo $answerData['antwort1'];?>" />
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input style="text-align: center; font-style: italic; background:#007bff;color: white;"
                                            type="submit" class=" form-control btn btn-info" name="antwort2_Button" value="<?php echo $answerData['antwort2'];?>" />
                                    </div>

                                    <!-- Force next columns to break to new line -->
                                    <div class="w-100"></div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input style="text-align: center; font-style: italic; background:#007bff;color: white;"
                                            type="submit" class="form-control btn btn-info" name="antwort3_Button" value="<?php echo $answerData['antwort3'];?>" />
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                        <input style="text-align: center; font-style: italic; background:#007bff;color: white; "
                                            type="submit" class="form-control btn btn-info " name="antwort4_Button" value="<?php echo $answerData['antwort4'];?>" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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