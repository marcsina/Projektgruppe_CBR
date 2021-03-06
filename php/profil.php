﻿<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_profile.php';
include_once 'include/functions_history.php';
include_once 'include/functions_upload.php';

$ownProfile = false;

sec_session_start();

if (login_check($mysqli) == true)
{
    $logged = 'in';
    //GET id, username, vorname, nachname, email, beschreibung, profilbild from DB
    $userDataArray = getUserDataByUsername($_SESSION['username'], $mysqli);
    //falls die ProfilSeite die eigene ist, setze Wert auf true

    $ownProfile = true;

    //�berpr�fen ob URL auf Profil verweist
    if(!empty($_GET["username"]))
    {
        //do something when url is pointing to specific profile
        //GET id, username, vorname, nachname, email, beschreibung, profilbild from DB from user in URL
        $userDataArray = getUserDataByUsernameGET($mysqli);
        if($_GET["username"] != $_SESSION['username'])
        {
            $ownProfile = false;
        }
        //�berpr�fen ob Nutzer exisitert, wenn nicht dann...
        if($userDataArray == false)
        {
            //Weitergeleitet auf eigenes Profil, wenn gew�nschter Nutzer nicht vorhanden
            header('Location: http://medausbild.de/php/profil.php');
            exit;
        }
        // wenn er existiert
        else
        {
            //TODO DO YOUR THING
        }
    }
} else
{
    $logged = 'out';
    //�berpr�fen ob URL auf Profil verweist
    if(!empty($_GET["username"]))
    {
        //GET id, username, vorname, nachname, email, beschreibung, profilbild from DB from user in URL
        $userDataArray = getUserDataByUsernameGET($mysqli);
        //�berpr�fen ob Nutzer exisitert, wenn nicht dann...
        if($userDataArray == false)
        {
            //Weitergeleitet auf Startseite wenn Nutzer nicht vorhanden
            header('Location: http://medausbild.de');
            exit;
        }
        // wenn er existiert
        else
        {
            //TODO DO YOUR THING
        }
    }
    else
    {
        header('Location: http://medausbild.de/php/login.php?logged=0');
        exit;
    }
}
?>
<html lang="en">

<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />

    <link href="../css/style2.css" rel="stylesheet" />

    <link href="../css/style_profil.css" rel="stylesheet" />
    <link href="../css/style_button.css" rel="stylesheet" />
</head>
<!-- _______________________________________NavBar_____________________________________________________-->

<?php
include ("include/navbar.php");
?>
<body id="home">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="content-page">
            <div class="profile-banner" style="background-image: url(https://toulouseosteopathe.com/wp-content/uploads/2016/01/mon-osteo-medecine-etude.jpg);">

                <!-- style="background-image: url(http://hubancreative.com/projects/templates/coco/corporate/images/stock/1epgUO0.jpg);"-->
                <div class="col-sm-3 avatar-container">
                    <?php
                    if(strlen($userDataArray['profilbild']) > 5)
                    {
                        echo "<img src='..".$userDataArray['profilbild']."' class='img-circle profile-avatar' alt='User avatar' />";
                    }
                    else
                    {

                        echo "<img src='http://cdn.tictacdoc.ma/assets/images/doc/avatar-female-doc.png' class='img-circle profile-avatar' alt='User avatar' />";
                    }
                    ?>
                </div>

                <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" -->
            </div>
            <div class="content">

                <div class="row">
                    <div class="col-sm-3">
                        <!-- Begin user profile -->
                        <div class="user-profile-2" style="margin-top:120px">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <?php
                                    $nameString ="<h4>";
                                    if($userDataArray["nachname"] != "")
                                    {
                                        $nameString =$nameString.$userDataArray["nachname"];
                                    }
                                    if($userDataArray["vorname"] != "")
                                    {
                                        if($userDataArray["nachname"] != "")
                                        {

                                            $nameString =$nameString.", <b>".$userDataArray["vorname"]."</b>";
                                        }else{

                                            $nameString =$nameString."<b>".$userDataArray["vorname"]."</b>";
                                        }
                                    }
                                    else if(($userDataArray["nachname"] == "" )&& ($userDataArray["vorname"] == ""))
                                    {
                                        $nameString =$nameString.$userDataArray["username"];
                                    }
                                    $nameString =$nameString."</h4>";
                                    echo $nameString;
                                    ?>
                                    <h5>Student, Medical science</h5>
                                </li>
                                <li class="list-group-item">
                                    <span class="badge">
                                        <?php
                                        echo getCountOfPeopleFollowingME($mysqli, $userDataArray['id']);
                                        ?>
                                    </span>
                                    Followers
                                </li>
                                <li class="list-group-item">
                                    <span class="badge">
                                        <?php
                                        echo getCountOfPeopleFollowing($mysqli, $userDataArray['id']);
                                        ?>
                                    </span>
                                    Following
                                </li>
                                <li class="list-group-item">
                                    <span class="badge">
                                        <?php
                                        echo getCountOfForumPostByUserID($userDataArray['id'], $mysqli);
                                        ?>
                                    </span>
                                    posts
                                </li>
                            </ul>

                            <!-- User button -->
                            <div class="user-button">
                                <div class="row">

                                    <?php

                                    if(checkIFAlreadyFollowing($mysqli, $_SESSION['user_id'], $userDataArray['id']))
                                    {
                                        if(!$ownProfile)
                                        {
                                            $s1 = $_SESSION['user_id'];
                                            $s2 = $userDataArray['id'];
                                            echo "<div class='col-lg-6'>
                                            <form action='' method='post'>
                                                <input type='hidden' name='id1' value='".$s1."'>
                                                <input type='hidden' name='id2' value='".$s2."'>
                                                <input type='submit' class='btn btn-default btn-sm btn-block' name='deleteFollowing' value='Nicht mehr folgen'>
                                            </form>
                                         </div>";
                                        }
                                    }
                                    else
                                    {
                                        if(!$ownProfile)
                                        {
                                            $s1 = $_SESSION['user_id'];
                                            $s2 = $userDataArray['id'];
                                            echo "<div class='col-lg-6'>
								                <form action='' method='post'>
									                <input type='hidden' name='id1' value='".$s1."'>
									                <input type='hidden' name='id2' value='".$s2."'>
									                <input type='submit' class='btn btn-default btn-sm btn-block' name='addFollowing' value='Folgen'>
								                </form>
                                            </div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div><!-- End div .user-button -->
                        </div><!-- End div .box-info -->
                    </div><!-- End div .col-sm-4 -->

                    <div class="col-sm-9">
                        <div class="widget widget-tabbed">
                            <!-- Nav tab -->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#about" data-toggle="tab">
                                        <i class="fa fa-user"></i> Über
                                    </a>
                                </li>
                                <li>
                                    <a href="#user-activities" data-toggle="tab">
                                        <i class="fa fa-laptop"></i> Aktivitäten
                                    </a>
                                </li>

                                <?php
                                if($ownProfile)
                                {

                                    //Statistic of this week and month
                                    echo "<li>
                                                <a href='#user-statistic' data-toggle='tab'>
                                                    <i class='fa fa-bar-chart'></i> Statistik
                                                </a>
                                            </li>";

                                    //achievements
                                    echo "<li>
                                                <a href='#user-achievements' data-toggle='tab'>
                                                    <i class='fa fa-trophy'></i> Erfolge
                                                </a>
                                            </li>";


                                    //Edit profile
                                    echo "<li>
                                                <a href='#edit_profil' data-toggle='tab'>
                                                    <i class='fa fa-edit'></i>Bearbeiten
                                                </a>
                                            </li>";

                                }
                                ?>
                            </ul>
                            <!-- End nav tab -->

                            <!-- Tab panes -->
                            <div class="tab-content">
                                



                                <!-- Tab about -->
                                <div class="tab-pane animated fadeInRight active" id="about">
                                    <div class="user-profile-content">
                                        <h5>
                                            <strong>ABOUT</strong> ME
                                        </h5>
                                        <p>
                                            <?php
                                            if($userDataArray["beschreibung"] !="")
                                            {
                                                echo $userDataArray["beschreibung"];
                                            }
                                            else{
                                                echo "Keine Beschreibung vorhanden";
                                            }?>
                                        </p>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>
                                                    <strong>CONTACT</strong> ME
                                                </h5>
                                                <?php
                                                if($userDataArray['email'] != ""){
                                                    echo " <address>
                                                            <strong>Email</strong>
                                                            <br />
                                                            <a href='mailto:".$userDataArray['email']."'>".
                                                    $userDataArray["email"]."
                                                            </a>
                                                        </address>";
                                                }
                                                else
                                                {
                                                    echo " <address>
                                                            <strong>Email</strong>
                                                            <br />
                                                            <p>Keine Email hinterlegt</p>
                                                        </address>";
                                                }
                                                if($userDataArray['website'] != "")
                                                {
                                                    echo"<address>
                                                        <strong>Website</strong>
                                                        <br />
                                                        <a href='http://".$userDataArray['website']."'>".
                                                    $userDataArray["website"]."
                                                        </a>
                                                    </address>";
                                                }
                                                else
                                                {
                                                    echo " <address>
                                                            <strong>Website</strong>
                                                            <br />
                                                            <p>Keine Website hinterlegt</p>
                                                        </address>";
                                                }
                                                ?>
                                            </div>
                                        </div><!-- End div .row -->
                                    </div><!-- End div .user-profile-content -->
                                </div><!-- End div .tab-pane -->
                                <!-- End Tab about -->


                                
                                <!-- Tab user activities -->
                                <div class="tab-pane animated fadeInRight" id="user-activities">
                                    <div class="scroll-user-widget">
                                        <ul class="media-list">
                                            <?php

                                            //get all history arrays
                                            $activitiesChecker = getHistory_Checker($mysqli, $userDataArray["id"]);
                                            $activitiesArticle = getHistory_Article($mysqli, $userDataArray["id"]);
                                            $activitiesForum = getHistory_Forum($mysqli, $userDataArray["id"]);
                                            $activitiesSPQuiz = getHistory_SP_Quiz($mysqli, $userDataArray["id"]);
                                            $activitiesMPQuiz = getHistory_MP_Quiz($mysqli, $userDataArray["id"]);

                                            //combine and sort them
                                            $sortedHistoryArray = combine_Historys($activitiesChecker, $activitiesArticle, $activitiesForum, $activitiesMPQuiz, $activitiesSPQuiz);

                                            $count_week_forum =0;
                                            $count_month_forum =0;
                                            $count_all_forum =0;

                                            $count_week_artikel =0;
                                            $count_month_artikel =0;
                                            $count_all_artikel =0;

                                            $count_week_quiz =0;
                                            $count_month_quiz =0;
                                            $count_all_quiz =0;

                                            $count_week_checker =0;
                                            $count_month_checker =0;
                                            $count_all_checker =0;
                                            $nextWeek = 604800;

                                            foreach($sortedHistoryArray as &$activity)
                                            {
                                                //date_default_timezone_set('MESZ');
                                                $t1 = strtotime("now");
                                                $t2 = strtotime($activity['time']);

                                                //Sommerzeit oder iwas anderes was die Zeit um 1 Stunde verschiebt
                                                if(date('I') == 1)
                                                {
                                                    $t1 = $t1 - 3600;
                                                }
                                                $diff = $t1-$t2;
                                                //Tage
                                                if($diff > 86400)
                                                {
                                                    if($diff < 86400*1.5)
                                                    {
                                                        $msg = " vor einem Tag";
                                                    }
                                                    else
                                                    {
                                                        $msg = " vor ".round($diff / 86400)." Tagen";
                                                    }
                                                }
                                                //Stunde/Minuten/Sekunden
                                                else
                                                {
                                                    $msg = " vor ".date("H \h i \m s \s",$t1-$t2);
                                                }

                                                $echoString = "";
                                                switch($activity['type'])
                                                {

                                                    case "Checker":

                                                        //----Insert Achievements
                                                        //All Time
                                                        $count_all_checker++;
                                                        //Month
                                                        if((strtotime($activity['time'])+abs(strtotime("-1 month")-strtotime("now"))) >= time())
                                                        {
                                                            $count_month_checker++;
                                                        }
                                                        //Week
                                                        if((strtotime($activity['time'])+$nextWeek) >= time())
                                                        {
                                                            $count_week_checker++;
                                                        }
                                                        //-------------------------------------------------------------
                                                        $echoString ="
                                                             <li class='media'>
                                                                <p>
                                                                    <strong>".$userDataArray['username']."</strong> hat ".$msg." den ".$activity['page']." genutzt, mit dem Ergebnis ".$activity['case_name']." bei ".$activity['percentage']." %
                                                                        <br>
                                                                </p>
                                                             </li>
                                                              ";

                                                        break;
                                                    case "Article":

                                                        //----Insert Achievements
                                                        //All Time
                                                        $count_all_artikel++;
                                                        //Month
                                                        if((strtotime($activity['time'])+abs(strtotime("-1 month")-strtotime("now"))) >= time())
                                                        {
                                                            $count_month_artikel++;
                                                        }
                                                        //Week
                                                        if((strtotime($activity['time'])+$nextWeek) >= time())
                                                        {
                                                            $count_week_artikel++;
                                                        }
                                                        //-------------------------------------------------------------

                                                        $echoString ="
                                                                <li class='media'>
                                                                    <a href='artikel_show.php?id=".$activity['fk_id']."'>
                                                                        <p>
                                                                            <strong>".$userDataArray["username"]."</strong> hat ".$activity['title']." gelesen
                                                                            <br>
                                                                            ".$msg."
                                                                        </p>
                                                                    </a>
                                                                </li>";
                                                        break;
                                                    case "Forum":

                                                        //----Insert Achievements
                                                        //All Time
                                                        $count_all_forum++;
                                                        //Month
                                                        if((strtotime($activity['time'])+abs(strtotime("-1 month")-strtotime("now"))) >= time())
                                                        {
                                                            $count_month_forum++;
                                                        }
                                                        //Week
                                                        if((strtotime($activity['time'])+$nextWeek) >= time())
                                                        {
                                                            $count_week_forum++;
                                                        }
                                                        //-------------------------------------------------------------

                                                        $echoString ="
                                                                <li class='media'>
                                                                    <a href='forum_demenz.php?topic=".$activity['fk_id']."'>
                                                                        <p>
                                                                            <strong>".$userDataArray["username"]."</strong> hat ".$msg." im Forum den Topic ".$activity['fk_id']." kommentiert.
                                                                            <br>
                                                                        </p>
                                                                    </a>
                                                                </li>";
                                                        break;
                                                    case "MP":
                                                        //----Insert Achievements
                                                        //All Time
                                                        $count_all_quiz++;
                                                        //Month
                                                        if((strtotime($activity['time'])+abs(strtotime("-1 month")-strtotime("now"))) >= time())
                                                        {
                                                            $count_month_quiz++;
                                                        }
                                                        //Week
                                                        if((strtotime($activity['time'])+$nextWeek) >= time())
                                                        {
                                                            $count_week_quiz++;
                                                        }
                                                        $echoString ="
                                                                <li>
                                                                        <p>
                                                                            <form class='history_form' action='Quiz_Endseite.php' method='post'>
												                                <input type='hidden' name='Profil_Quiz_ID' value='".$activity['fk_id']."'>
												                                <input type='hidden' name='Profil_Quiz_Type' value='".$activity['type']."'>
												                                <input class='history_button' type='submit' value='".$userDataArray["username"]." hat ".$msg." ein Multiplayer Quiz mit der ID ".$activity['fk_id']." abgeschlossen.'>
											                                </form>
                                                                        </p>
                                                                </li>";
                                                        break;
                                                    case "SP":
                                                        //----Insert Achievements
                                                        //All Time
                                                        $count_all_quiz++;
                                                        //Month
                                                        if((strtotime($activity['time'])+(strtotime("-1 month")-strtotime("now"))) >= time())
                                                        {
                                                            $count_month_quiz++;
                                                        }
                                                        //Week
                                                        if((strtotime($activity['time'])+$nextWeek) >= time())
                                                        {
                                                            $count_week_quiz++;
                                                        }
                                                        $echoString ="
                                                                <li>

                                                                            <form class='history_form' action='Quiz_Endseite.php' method='post'>
												                                <input type='hidden' name='Profil_Quiz_ID' value='".$activity['fk_id']."'>
												                                <input type='hidden' name='Profil_Quiz_Type' value='".$activity['type']."'>
												                                <input class='history_button' type='submit' value='".$userDataArray["username"]." hat ".$msg." ein Singleplayer Quiz mit der ID ".$activity['fk_id']." abgeschlossen.'>
											                                </form>
                                                                </li>";
                                                        break;
                                                }

                                                echo $echoString;
                                            }

                                            ?>
                                        </ul>
                                    </div><!-- End div .scroll-user-widget -->
                                </div><!-- End div .tab-pane -->
                                <!-- End Tab user activities -->


                                <!-- Tab statistic -->
                                <div class="tab-pane animated fadeInRight" id="user-statistic">
                                    <div class="user-profile-content">
                                        <?php
                                        echo "  <div class='row' id='Achieve_Buttons'>

                                                        <div class='col-md-6 col-xs-6 center_button'><button id='Achieve-Week-Button' type='button' onclick='Achieve_Week_func()' class='btn-basic btn-basic-blue btn-basic-m' >Woche</button></div>
                                                        <div class='col-md-6 col-xs-6 center_button'><button  id='Achieve-Month-Button' type='button' onclick='Achieve_Month_func()' class='btn-basic btn-basic-blue btn-basic-m'>Monat</button></div>
                                                </div>

                                                <div id='Achieve-Week'>";
                                        $gold = 10;
                                        //--------------------------------------Checker--------------------------------------------------------


                                        //Gold Checker
                                        if($count_week_checker >= $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diese Woche viel mit dem Checker gelernt. Insgesamt ".$count_week_checker." Durchläufe";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_week_checker > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast den Checker diese Woche noch nicht so oft genutzt. Insgesamt ".$count_week_checker." Durchläufe";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal den Checker ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }

                                        //----------------------------------------------------------------------------------------------------------

                                        //--------------------------------------Forum--------------------------------------------------------
                                        //Gold Forum

                                        if($count_week_forum >= $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diese Woche viel im Forum geschrieben. Insgesamt ".$count_week_forum." Nachrichten.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_week_forum > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast das Forum diese Woche noch nicht so oft genutzt. Insgesamt ".$count_week_forum." Nachrichten.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal das Forum ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        //----------------------------------------------------------------------------------------------------------

                                        //--------------------------------------Quiz--------------------------------------------------------
                                        //Gold Quiz
                                        if($count_week_quiz >= $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diese Woche viele Quiz Matches gespielt. Insgesamt ".$count_week_quiz." Spiele.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_week_quiz > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast diese Woche noch nicht viele Quiz Matches gespielt. Insgesamt ".$count_week_quiz." Spiele.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal das Quiz ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        //----------------------------------------------------------------------------------------------------------

                                        //--------------------------------------Artikel--------------------------------------------------------
                                        if($count_week_artikel > $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diese Woche schon viel im Classroom gelesen. Insgesamt ".$count_week_artikel." Texte.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_week_artikel > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast diese Woche nur wenig im Classroom gelesen. Insgesamt ".$count_week_artikel." Texte.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal den Classroom ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        //----------------------------------------------------------------------------------------------------------
                                        echo"</div>

                                                <div id='Achieve-Month' >";
                                        $gold =30;
                                        //--------------------------------------Checker--------------------------------------------------------
                                        //Gold Checker



                                        if($count_month_checker >= $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diesen Monat viel mit dem Checker gelernt. Insgesamt ".$count_month_checker." Durchläufe";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_month_checker > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast den Checker diesen Monat noch nicht so oft genutzt. Insgesamt ".$count_week_checker." Durchläufe";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal den Checker ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }

                                        //----------------------------------------------------------------------------------------------------------

                                        //--------------------------------------Forum--------------------------------------------------------
                                        //Gold Forum
                                        if($count_month_forum >= $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diesen Monat viel im Forum geschrieben. Insgesamt ".$count_week_forum." Nachrichten.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_month_forum > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast das Forum diesen Monat noch nicht so oft genutzt. Insgesamt ".$count_week_forum." Nachrichten.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal das Forum ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        //----------------------------------------------------------------------------------------------------------

                                        //--------------------------------------Quiz--------------------------------------------------------

                                        if($count_month_quiz >= $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diesen Monat viele Quiz Matches gespielt. Insgesamt ".$count_week_quiz." Spiele.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_month_quiz > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast diesen Monat noch nicht viele Quiz Matches gespielt. Insgesamt ".$count_week_quiz." Spiele.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal das Quiz ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        //----------------------------------------------------------------------------------------------------------

                                        //--------------------------------------Artikel--------------------------------------------------------

                                        if($count_month_artikel > $gold)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-up.png' class='Achievement_Img' >";
                                            echo "Du hast diesen Monat schon viel im Classroom gelesen. Insgesamt ".$count_week_artikel." Texte.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else if($count_month_artikel > 0)
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<img src='../img/achievements/thumb-left.png' class='Achievement_Img' >";
                                            echo "Du hast diesen Monat nur wenig im Classroom gelesen. Insgesamt ".$count_week_artikel." Texte.";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                            echo "<div class='Achievement_Img'></div>";
                                            echo "Benutz doch mal den Classroom ;)";
                                            echo "<br>";
                                            echo "</div>";
                                        }
                                        //----------------------------------------------------------------------------------------------------------
                                        echo "</div>";

                                        ?>

                                    </div><!-- End div .user-profile-content -->
                                </div><!-- End div .tab-pane -->
                                <!-- End Tab statistic -->


                                <?php
                                if($ownProfile)
                                {
                                    //$article_week_percent = get_Article_TimePeriod($mysqli,$_SESSION['user_id'], 1);
                                    //$article_month_percent = get_Article_TimePeriod($mysqli,$_SESSION['user_id'], 4);
                                    //$article_all_percent = get_Article_TimePeriod($mysqli,$_SESSION['user_id'], 1000);

                                    echo "<div class='tab-pane animated fadeInRight' id='user-achievements'>



                                    <div class='row' >";

                                    $red = 60;
                                    $gold = 20;
                                    $grey = 10;
                                    //--------------------------------------Checker--------------------------------------------------------
                                    //Gold Checker

                                    if($count_all_checker >= $red)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/ascending_red.png' class='Achievement_Img' >";
                                        echo "Du bist der Checker Gott mit ".$count_all_checker." Durchläufen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Silber Checker
                                    else if($count_all_checker >= $gold)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/ascending_gold.png' class='Achievement_Img' >";
                                        echo "Du bist ein Checker Experte mit ".$count_all_checker." Durchläufen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Bronze Checker
                                    else if($count_all_checker >= $grey)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/ascending_grey.png' class='Achievement_Img' >";
                                        echo "Du hast dich schon mit dem Checker vertraut gemacht mit ".$count_all_checker." Durchläufen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else if($count_all_checker > 0)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Du hast die ersten Versuche mit dem Checker gemacht mit ".$count_all_checker." Durchläufen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Benutz doch mal den Checker ;)";
                                        echo "<br>";
                                        echo "</div>";
                                    }

                                    //----------------------------------------------------------------------------------------------------------

                                    //--------------------------------------Forum--------------------------------------------------------
                                    //Gold Forum
                                    if($count_all_forum >= $red)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/Conversation_red.png' class='Achievement_Img' >";
                                        echo "Du bist der Forum Gott mit ".$count_all_forum." Nachrichten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Silber Forum
                                    else if($count_all_forum >= $gold)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/Conversation_gold.png' class='Achievement_Img' >";
                                        echo "Du bist ein Forum Experte mit ".$count_all_forum." Nachrichten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Bronze Forum
                                    else if($count_all_forum >= $grey)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/Conversation_grey.png' class='Achievement_Img' >";
                                        echo "Du hast dich schon mit dem Forum vertraut gemacht mit ".$count_all_forum." Nachrichten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else if($count_all_forum > 0)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Du hast die ersten Versuche mit dem Forum gemacht mit ".$count_all_forum." Nachrichten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Benutz doch mal das Forum ;)";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //----------------------------------------------------------------------------------------------------------

                                    //--------------------------------------Quiz--------------------------------------------------------
                                    //Gold Quiz
                                    if($count_all_quiz >= $red)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/Dice_red.png' class='Achievement_Img' >";
                                        echo "Du bist der Quiz Gott mit ".$count_all_quiz." Spielen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Silber Quiz
                                    else if($count_all_quiz >= $gold)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/Dice_gold.png' class='Achievement_Img' >";
                                        echo "Du bist ein Quiz Experte mit ".$count_all_quiz." Spielen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Bronze Quiz
                                    else if($count_all_quiz >= $grey)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/Dice_grey.png' class='Achievement_Img' >";
                                        echo "Du hast dich schon mit dem Quiz vertraut gemacht mit ".$count_all_quiz." Spielen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else if($count_all_quiz > 0)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Du hast die ersten Versuche mit dem Quiz gemacht mit ".$count_all_quiz." Spielen";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Benutz doch mal das Quiz ;)";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //----------------------------------------------------------------------------------------------------------

                                    //--------------------------------------Artikel--------------------------------------------------------
                                    //Artikel
                                    if($count_all_artikel >= $red)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/bookmark_red.png' class='Achievement_Img' >";
                                        echo "Du bist der Classroom Gott mit ".$count_all_artikel." gelesenen Texten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Artikel
                                    else if($count_all_artikel >= $gold)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/bookmark_gold.png' class='Achievement_Img' >";
                                        echo "Du bist ein Classroom Experte mit ".$count_all_artikel." gelesenen Texten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //Artikel
                                    else if($count_all_artikel >= $grey)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/bookmark_grey.png' class='Achievement_Img' >";
                                        echo "Du hast dich schon mit dem Classroom vertraut gemacht mit ".$count_all_artikel." gelesenen Texten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else if($count_all_artikel > 0)
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Du hast die ersten Versuche mit dem Classroom gemacht mit ".$count_all_artikel." gelesenen Texten";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-6 col-xs-6 Achievement_div'>";
                                        echo "<img src='../img/achievements/questionmark.png' class='Achievement_Img' >";
                                        echo "Benutz doch mal den Classroom ;)";
                                        echo "<br>";
                                        echo "</div>";
                                    }
                                    //----------------------------------------------------------------------------------------------------------

                                    echo "</div>
                                            </div>";
                                }

                                ?>

                                <?php
                                if($ownProfile)
                                {
                                    echo "<div class='tab-pane animated fadeInRight' id='edit_profil'>

							<form class='form' action='' method='post' id='editForm'>

								<div class='form-group'>
									<div class='col-xs-6'>Vorname</label>
										<input type='text' class='form-control' name='first_name' id='first_name' placeholder='first name' title='Vornamen eingeben' value='". $userDataArray['vorname'] . "'>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-xs-6'>
										<label for='last_name'>Nachname</label>
										<input type='text' class='form-control' name='last_name' id='last_name' placeholder='last name' title='Nachnamen eingeben' value='". $userDataArray['nachname'] . "'>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-xs-6'>
										<label for='email'>Email</label>
										<input type='email' class='form-control' name='email' id='email' placeholder='you@email.com' title='Emailadresse eingeben' value='". $userDataArray['email'] . "'>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-xs-6'>
										<label for='website'>Webseite</label>
										<input type='text' class='form-control' name='website' id='website' placeholder='enter your website' title='Eigene Webseite eingeben' value='". $userDataArray['website'] . "'>
									</div>
								</div>
                                <div class='form-group'>
									    <div class='col-xs-12'>
										<label for='beschreibung'>Beschreibung</label>
										    <textarea form='editForm' class='form-control' name='beschreibung' id='beschreibung' style='resize: vertical;'>". $userDataArray['beschreibung'] . "</textarea>
									    </div>
                                    </div>
								<div class='form-group'>
									<div class='col-xs-6'>
										<br>
										<button class='btn btn-md btn-success pull-right' type='submit' name='editProfile'><i class='glyphicon glyphicon-ok-sign'></i> Save</button>
										<button class='btn btn-md' type='reset'><i class='glyphicon glyphicon-repeat'></i> Reset</button>
									</div>
								</div>
							</form>

                            <form class='form col-xs-12' action='' method='post' enctype='multipart/form-data'>
                                Wähle ein Bild zum Hochladen als Profilbild aus:
                                <input type='file' name='fileToUpload' id='fileToUpload' value='Durchsuchen'>
                                <input class='btn btn-md btn-success' type='submit' value='Ausgewähltes Bild hochladen' name='submit'>
                            </form>
						</div>";
                                }?>
                            </div><!-- End div .tab-content -->
                        </div><!-- End div .box-info -->
                    </div>
                </div>

                <!--____________________________________________________________________________________________________-->

                <!-- Scripts -->
                <script src="../js/jquery-2.2.2.min.js"></script>
                <script src="../js/bootstrap.min.js"></script>

                <script type="text/javascript">

                    $(function () {
                        $("[data-toggle='tooltip']").tooltip();
                    })
                </script>
                <script>

                    function Achieve_Week_func()
                    {
                        clear_Achieve();
                        document.getElementById("Achieve-Week").style.display = 'block';
                        document.getElementById("Achieve-Week-Button").style.borderColor = '#fff200';
                    }

                    function Achieve_Month_func()
                    {
                        clear_Achieve();
                        document.getElementById("Achieve-Month").style.display = 'block';
                        document.getElementById("Achieve-Month-Button").style.borderColor = '#fff200';
                    }

                    function clear_Achieve()
                    {
                        document.getElementById("Achieve-Week").style.display = 'none';
                        document.getElementById("Achieve-Month").style.display = 'none';

                        document.getElementById("Achieve-Week-Button").style.borderColor = 'white';
                        document.getElementById("Achieve-Month-Button").style.borderColor = 'white';

                    }
                </script>
</body>
</html>