<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include_once ($path . '/Projektgruppe/php/include/conn.php');
include_once ($path . '/Projektgruppe/php/include/functions_login.php');
include_once ($path . '/Projektgruppe/php/include/quiz_countPendingChallenges.php');
ini_set ("display_errors", "1");
error_reporting(E_ALL);
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
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="" href="/Projektgruppe/index.php">
                <i class="icon_house_alt"></i>
                <div href="/Projektgruppe/index.php" class="logo navbar-brand">
                    Medausbild
                    <span class="lite">Siegen</span>
                </div>
            </a>
            
        </div>
        <div id="navbar" class="navbar-collapse collapse">
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
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
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
            <div class="nav navbar-nav navbar-right">
                <?php
                
                    if($logged == 'out')
                    {
                        echo "<ul class='nav pull-right top-menu'><li><a href = '/Projektgruppe/php/login.php'>Login</a></li></ul>";
                    }
                    else{
                        echo "<ul class='nav pull-right top-menu'>
                                <li class='dropdown'>
                                    <a data-toggle='dropdown' class='dropdown-toggle' href='/Projektgruppe/php/profil.php'>
                                        <span class='profile-ava'>";

                                            if(strlen($_SESSION['profilbild']) > 5)
                                            {
                                                echo "<img alt='' src='/Projektgruppe".$_SESSION['profilbild']."' style='max-height: 51px; max-width: 51px;' />";
                                            }
                                            else
                                            {
                                                echo "<img alt='' src='http://cdn.tictacdoc.ma/assets/images/doc/avatar-female-doc.png' style='max-height: 51px; max-width: 51px;' />";
                                            }

                         echo"
                                        </span>
                                        <span class='username'>".
                                            $_SESSION['username']."
                                        </span>
                                        <b class='caret'></b>
                                    </a>
                                    <ul class='dropdown-menu extended logout'>
                                        <div class='log-arrow-up'></div>
                                        <li class='eborder-top'>
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
                                </li>
                            </ul>";
                    }
                    
                ?>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<script src="/Projektgruppe/js/bootstrap.min.js"></script>

<?php

if($logged == "in")
{
    include_once('chat.php');
}
?>