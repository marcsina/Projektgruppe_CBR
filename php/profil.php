<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_profile.php';
include_once 'include/functions_history.php';

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
            header('Location: http://141.99.248.92/Projektgruppe/profil.php');
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
            header('Location: http://141.99.248.92/Projektgruppe');
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
        header('Location: http://141.99.248.92/Projektgruppe/php/login.php?logged=0');
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
</head>
<!-- _______________________________________NavBar_____________________________________________________-->

<?php
include ("include/navbar.php");
?>
<body id="home" style="background-color:#e9ebee" ;>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="content-page">
            <div class="profile-banner" style="background-image: url(https://toulouseosteopathe.com/wp-content/uploads/2016/01/mon-osteo-medecine-etude.jpg);">

                <!-- style="background-image: url(http://hubancreative.com/projects/templates/coco/corporate/images/stock/1epgUO0.jpg);"-->
                <div class="col-sm-3 avatar-container">
                    <img src="http://cdn.tictacdoc.ma/assets/images/doc/avatar-female-doc.png" class="img-circle profile-avatar" alt="User avatar" />
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
                                    <h4>
                                        <?php echo $userDataArray["nachname"]; ?>,
                                        <b>
                                            <?php echo $userDataArray["vorname"]; ?>
                                        </b>
                                    </h4>
                                    <h5>Student, Medical science</h5>
                                </li>
                                <li class="list-group-item">
                                    <span class="badge"><?php
                                                        echo getCountOfPeopleFollowingME($mysqli, $userDataArray['id']);
                                                        ?></span>
                                    Followers
                                </li>
                                <li class="list-group-item">
                                    <span class="badge"><?php
                                                        echo getCountOfPeopleFollowing($mysqli, $userDataArray['id']);
                                                        ?></span>
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
                                    <div class="col-lg-6">
                                        <form action="" method="post">
                                            <input type="submit" class="btn btn-primary btn-sm btn-block" value="Nachricht abschicken" />
                                        </form>
                                    </div>
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
                                        <i class="fa fa-user"></i> About
                                    </a>
                                </li>
                                <li>
                                    <a href="#user-activities" data-toggle="tab">
                                        <i class="fa fa-laptop"></i> Activities
                                    </a>
                                </li>
                                <?php
                                if($ownProfile)
                                {
                                    echo "<li><a href='#edit_profil' data-toggle='tab'><i class='fa fa-edit'></i> edit profil</a></li>";
                                }?>
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
                                            <?php echo $userDataArray["beschreibung"]; ?>
                                        </p>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5>
                                                    <strong>CONTACT</strong> ME
                                                </h5>
                                                <!--<address>
                                                <strong>Phone</strong><br>
                                                <abbr title="Phone">+49 123 456 789 </abbr>
                                            </address>-->
                                                <address>
                                                    <strong>Email</strong>
                                                    <br />
                                                    <a href="mailto:<?php echo $userDataArray["email"]; ?>">
                                                        <?php echo $userDataArray["email"]; ?>
                                                    </a>
                                                </address>
                                                <address>
                                                    <strong>Website</strong>
                                                    <br />
                                                    <a href="http://<?php echo $userDataArray['website']; ?>">
                                                        <?php echo $userDataArray["website"]; ?>
                                                    </a>
                                                </address>
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

                                            $activitiesChecker = getHistory_Checker($mysqli, $_SESSION['user_id']);
                                            $activitiesArticle = getHistory_Article($mysqli, $_SESSION['user_id']);
                                            $activitiesForum = getHistory_Forum($mysqli, $_SESSION['user_id']);
                                            $activitiesSPQuiz = getHistory_SP_Quiz($mysqli, $_SESSION['user_id']);
                                            $activitiesMPQuiz = getHistory_MP_Quiz($mysqli, $_SESSION['user_id']);

                                            $sortedHistoryArray = combine_Historys($activitiesChecker, $activitiesArticle, $activitiesForum, $activitiesMPQuiz, $activitiesSPQuiz);

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
                                                        $echoString ="
                                                             <li class='media'>
                                                                <p>
                                                                    <strong>".$_SESSION['username']."</strong> hat ".$msg." den ".$activity['page']." genutzt, mit dem Ergebnis ".$activity['case_name']." bei ".$activity['percentage']." %
                                                                        <br>
                                                                </p>
                                                             </li>
                                                              ";

                                                        break;
                                                    case "Article":
                                                        $echoString ="
                                                                <li class='media'>
                                                                    <a href='".$activity['fk_id']."'>
                                                                        <p>
                                                                            <strong>".$_SESSION['username']."</strong> hat sich einen ".$activity['type']." angesehen
                                                                            <br>
                                                                            ".$msg."
                                                                        </p>
                                                                    </a>
                                                                </li>";
                                                        break;
                                                    case "Forum":
                                                        $echoString ="
                                                                <li class='media'>
                                                                    <a href='forum_demenz.php?topic=".$activity['fk_id']."'>
                                                                        <p>
                                                                            <strong>".$_SESSION['username']."</strong> hat ".$msg." im Forum den Topic ".$activity['fk_id']." kommentiert.
                                                                            <br>
                                                                        </p>
                                                                    </a>
                                                                </li>";
                                                        break;
                                                    case "MP":
                                                        $echoString ="
                                                                <li>
                                                                        <p>
                                                                            <form class='history_form' action='Quiz_Endseite.php' method='post'>
												                                <input type='hidden' name='Profil_Quiz_ID' value='".$activity['fk_id']."'>
												                                <input type='hidden' name='Profil_Quiz_Type' value='".$activity['type']."'>
												                                <input class='history_button' type='submit' value='".$_SESSION['username']." hat ".$msg." ein Multiplayer Quiz mit der ID ".$activity['fk_id']." abgeschlossen.'>
											                                </form>
                                                                        </p>
                                                                </li>";
                                                        break;
                                                    case "SP":
                                                        $echoString ="
                                                                <li>

                                                                            <form class='history_form' action='Quiz_Endseite.php' method='post'>
												                                <input type='hidden' name='Profil_Quiz_ID' value='".$activity['fk_id']."'>
												                                <input type='hidden' name='Profil_Quiz_Type' value='".$activity['type']."'>
												                                <input class='history_button' type='submit' value='".$_SESSION['username']." hat ".$msg." ein Singleplayer Quiz mit der ID ".$activity['fk_id']." abgeschlossen.'>
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

                    $( function ()
                    {
                        $( "[data-toggle='tooltip']" ).tooltip();
                    } )
                </script>
</body>
</html>