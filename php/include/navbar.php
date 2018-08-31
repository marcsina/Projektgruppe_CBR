<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once ($path . '/Projektgruppe/php/include/conn.php');
include_once ($path . '/Projektgruppe/php/include/functions_login.php');
include_once ($path . '/Projektgruppe/php/include/quiz_countPendingChallenges.php');
//ini_set ("display_errors", "1");
//error_reporting(E_ALL);
sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
	$pendingChallenges = getNumberPendingChallenges($mysqli, $_SESSION['user_id']);
} else {
    $logged = 'out';
}

?>

<head>

    <!-- Bootstrap core CSS -->
    <link href="/Projektgruppe/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/Projektgruppe/css/style_navbar.css" rel="stylesheet" />
    <link href="/Projektgruppe/css/style_basic.css" rel="stylesheet" />
    <link href="/Projektgruppe/css/elegant-icons-style.css" rel="stylesheet" />
</head>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="" href="/Projektgruppe/index.php">
            <div href="/Projektgruppe/index.php" class="logo navbar-brand">
                <i class="icon_house_alt"></i> Medausbild
                <span class="lite">Siegen</span>
            </div>
        </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse navbar-right">
        <ul class="nav navbar-nav">

            <?php
            echo"
                    <li class='menuItem'>
                        <a href='/Projektgruppe/php/Quiz_uebersicht.php'>
                            Quiz
                            <i class='icon_table'></i>";
            if($pendingChallenges > 0)
            {
                echo "<span class='badge bg-important'> $pendingChallenges </span>";
            }
            echo"
                        </a>
                    </li>

                    <li class='menuItem'>
                        <a href='/Projektgruppe/php/forum.php'>
                            Forum
                            <i class='icon_genius'></i>
                        </a>
                    </li>

                    <li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                            Checker
                            <i class='icon_document_alt'></i>
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li>
                                <a href='/Projektgruppe/php/checker_symptom.php'>Symptom Checker</a>
                            </li>
                            <li>
                                <a href='/Projektgruppe/php/checker_text.php'>Fall Checker</a>
                            </li>
                        </ul>
                    </li>

                    <li class='dropdown'>
                        <a href='' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>

                            Classroom
                            <i class='icon_desktop'></i>
                            <span class='caret'></span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li>
                                <a href='/Projektgruppe/php/artikel.php'>Artikel</a>
                            </li>
                            <li>
                                <a href='/Projektgruppe/php/scripts.php'>Scripts</a>
                            </li>
                        </ul>
                    </li>
                    <li class='menuItem'>
                        <a href='/Projektgruppe/php/statistik.php'>
                            Statistik
                            <i class='icon_piechart'></i>
                        </a>
                    </li>

                    <li class='menuItem'>
                        <a href='/Projektgruppe/php/contact_medausbild.php'>
                            Kontakt
                            <i class='icon_documents_alt'></i>
                        </a>
                    </li>";
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right login">
            <?php

            if($logged == 'out')
            {
                echo "<ul class='top-menu'><li><a href = '/Projektgruppe/php/login.php'>Login</a></li></ul>";
            }
            else{
                echo "<li class='dropdown'>
                            <a href='' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><div class='row profile-ava'>";

                if(strlen($_SESSION['profilbild']) > 5)
                {
                    echo "<img src='/Projektgruppe".$_SESSION['profilbild']."' style='max-width: 22px;max-height: 22px;' />";
                    /*
                    echo "<div style='width: 40px;
                    height: 40px;
                    background-image: url(\"/Projektgruppe".$_SESSION['profilbild']."\");
                    background-repeat: no-repeat;
                    background-size: contain;'></div>";*/
                }
                else
                {
                    echo "<img alt='' src='http://cdn.tictacdoc.ma/assets/images/doc/avatar-female-doc.png' style='max-height: 22px; max-width: 22px;' />";
                }

                echo $_SESSION['username']."<span class='caret'></span></div>
                                    </a>
                                    <ul class='dropdown-menu logout'>
                                        <li>
                                            <a href='/Projektgruppe/php/profil.php'>
                                                <i class='icon_profile'></i> My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href='/Projektgruppe/php/include/logout.php'>
                                                <i class='icon_key_alt'></i> Log Out
                                            </a>
                                        </li>";
                if (login_check($mysqli) == true)
                {
                    if($_SESSION['admin'] == 1)
                    {
                        echo "<li><a href='/Projektgruppe/php/admin_config.php'><i class='icon_key_alt'></i>Adminseite</a></li>";
                    }
                }
                echo "
                                    </ul>
                                </div>";
            }

            ?>
        </ul>
    </div><!--/.nav-collapse -->
</nav>
<script src="/Projektgruppe/js/bootstrap.min.js"></script>

<?php

if($logged == "in")
{
    include_once('chat.php');
}
?>