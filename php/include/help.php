<?php
include_once 'conn.php';
include_once 'functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';

}

?>


<html>

<head>
    <link rel="stylesheet" href="/Projektgruppe/css/style_help.css" type="text/css" />
</head>

<!--chat.start()-->

<body>


    <span class="Help_Button" onclick="openNavHelp()">Hilfe &#9776; </span>

    <div id="mySidenavHelp" class="sidenavHelp">
        <label id="Label_Header">
            Hilfe
        </label>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavHelp()">&times;</a>

        <div id="page-wrap">

            <div id="help-wrap">


                <!--TODODODODOD-->
                <?php

                $hilfeTextIndex = "Der Beginn deines gro�en Abenteuers auf der MedAsubild.de Seite.
                                   <br>
                                   <br>
                                   Hier siehst du welche neuen Artikel und Forumsposts es in dieser Woche gab und kannst dich direkt zu Ihnen begeben.";

                $hilfeTextQuizUebersicht = "Hilfe Text f�r die Quiz_ueberischt seite";
                $hilfeTextQuiz = "Hilfe Text f�r die Quiz_ueberischt seite";
                $hilfeTextQuizEndseite = "Hilfe Text f�r die Quiz_Endseite seite";
                $hilfeTextForum = "Hilfe Text f�r die Forum seite";
                $hilfeTextForumDemenz = "Hilfe Text f�r die Forum Demenz seite";
                $hilfeTextForumDemenzTopic = "Hilfe Text f�r Forum Topic Seite";
                $hilfeTextCheckerSymptom = "Hilfe Text f�r Symptom Checker Seite";
                $hilfeTextCheckerText = "Hilfe Text f�r Text Checker Seite";
                $hilfeTextArtikel ="Hilfe Text f�r Artikel Seite";
                $hilfeTextArtikelShow ="Hilfe Text f�r Artikel Show Seite";
                $hilfeTextScripts ="Hilfe Text f�r Scripts Seite";
                $hilfeTextStatistik ="Hilfe Text f�r Statistik Seite";
                $hilfeTextKontakt ="Hilfe Text f�r Kontakt Seite";
                $hilfeTextProfilOwn ="Hilfe Text f�r eigene Profil Seite";
                $hilfeTextProfilOther = "Hilfe Text f�r andere Profil Seite";
                $hilfeTextAdmin = "Hilfe Text f�r Admin Seite";
                $hilfeTextLogin = "Hilfe Text f�r Login Seite";
                $hilfeTextRegister = "Hilfe Text f�r Register Seite";


                if(strpos($_SERVER['REQUEST_URI'], "index.php"))
                {
                    echo $hilfeTextIndex;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "Quiz_uebersicht.php")){
                    echo $hilfeTextQuizUebersicht;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "Quiz.php")){
                    echo $hilfeTextQuiz;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "Quiz_Endseite.php")){
                    echo $hilfeTextQuizEndseite;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "forum.php")){
                    echo $hilfeTextForum;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "forum_demenz.php?topic")){
                    echo $hilfeTextForumDemenzTopic;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "forum_demenz.php")){
                    echo $hilfeTextForumDemenz;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "checker_symptom.php")){
                    echo $hilfeTextCheckerSymptom;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "checker_text.php")){
                    echo $hilfeTextCheckerText;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "artikel.php")){
                    echo $hilfeTextArtikel;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "artikel_show.php")){
                    echo $hilfeTextArtikelShow;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "scripts.php")){
                    echo $hilfeTextScripts;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "statistik.php")){
                    echo $hilfeTextStatistik;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "contact_medausbild.php")){
                    echo $hilfeTextKontakt;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "profil.php?username")){
                    echo $hilfeTextProfilOther;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "profil.php")){
                    echo $hilfeTextProfilOwn;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "admin_config.php")){
                    echo $hilfeTextAdmin;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "login.php")){
                    echo $hilfeTextLogin;
                }
                else if(strpos($_SERVER['REQUEST_URI'], "register.php")){
                    echo $hilfeTextRegister;
                }
                else
                {
                    echo "Unbekannte Seite";
                }


                ?>
            </div>

        </div>

    </div>



</body>

</html>

<script>

    //store the chat-show status
    var opened = 0;
    
    //Show the chat and store it in a local and a session variable
    function openNavHelp() {
        if (opened == 0) {
            document.getElementById("mySidenavHelp").style.height = "55%";
            opened = 1;
        }
        else {
            closeNavHelp();
        }
    }

    //Close the chat and store it in session and local
    function closeNavHelp() {
        document.getElementById("mySidenavHelp").style.height = "0%";
        opened = 0;
    }

</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
