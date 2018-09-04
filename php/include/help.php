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

                $hilfeTextIndex = "Der Beginn deines großen Abenteuers auf der MedAsubild.de Seite.
                                   <br>
                                   <br>
                                   Hier siehst du welche neuen Artikel und Forumsposts es in dieser Woche gab und kannst dich direkt zu Ihnen begeben.";

                $hilfeTextQuizUebersicht = "Hilfe Text für die Quiz_ueberischt seite";
                $hilfeTextQuiz = "Hilfe Text für die Quiz_ueberischt seite";
                $hilfeTextQuizEndseite = "Hilfe Text für die Quiz_Endseite seite";
                $hilfeTextForum = "Hilfe Text für die Forum seite";
                $hilfeTextForumDemenz = "Hilfe Text für die Forum Demenz seite";
                $hilfeTextForumDemenzTopic = "Hilfe Text für Forum Topic Seite";
                $hilfeTextCheckerSymptom = "Auf dieser Seite können sie verschiedene Symptome auswählen und ihre Stärke bestimmen, um am Ende das System die passende Krankheit finden zu lassen.<br><br>
				Auf der linken Seite befindet sich eine Liste allen möglichen Symptomen. Ein Suchfeld direkt dort drüber kann beim Finden eines bestimmten Symptoms helfen. Möchten sie ein Symptom auswählen, klicken sie auf die entsprechende weiße Box. Dieses Symptom erscheint nun auf der rechten Seite<br><br>
				Mithilfe der rechten Seite können sie die Stärke des von ihnen gewählten Symptoms bestimmen: Klein, Mittel und hoch. Als standard bekommt jedes neue Symptome eine kleine Stärke. Möchten sie ein Symptom entfernen, drücken sie auf das weiße X oder klicken sie erneut auf die weiße Box im linken Fenster (dort ist nun ein Häkchen drin).<br><br>
				Haben sie ihre Auswahl beendet, klicken sie auf den 'Submit' Button. Im Anschluss sehen sie weiter unten ein Diagramm, welches ihnen das Ergebnis anzeigt. Berühren sie mit ihrem Cursor einen Balken, um die genaue Übereinstimmung festzustellen.<br><br>
				Sie können jederzeit neue Symptome hinzufügen oder entfernen und anschließend das Ergebnis neu berechnen lassen.";
                $hilfeTextCheckerText = "Auf dieser Seite können sie eine Krankheitsbeschreibung eingeben um das System die passende Krankheit finden zu lassen.<br><br>
				Auf der linken Seite befindet sich eine Textbox, in der sie einen beliebig langen Text eingeben können. Lassen sie bei der Beschreibung möglichst keine Details aus, um ein genaues Ergebnis zu erhalten.<br><br>
				Haben sie ihre Beschreibung abgeschlossen, klicken sie auf den Submit Button. Das System filtert nun ihren Text nach Symptomen, die gefundenen werden ihnen zusammen mit der Stärke auf der rechten Seite angezeigt. Weiter unten befindet sich ein Diagramm, welches ihnen das Ergebnis anzeigt. Berühren sie mit ihrem Cursor einen Balken, um die genaue Übereinstimmung festzustellen.<br><br>
				Falls sie weitere Symptome hinzufügen oder vorhandene entfernen möchten, klicken sie auf den 'Anpassen' Button.";
                $hilfeTextArtikel ="Hilfe Text für Artikel Seite";
                $hilfeTextArtikelShow ="Hilfe Text für Artikel Show Seite";
                $hilfeTextScripts ="Hilfe Text für Scripts Seite";
                $hilfeTextStatistik ="Hilfe Text für Statistik Seite";
                $hilfeTextKontakt ="Hilfe Text für Kontakt Seite";
                $hilfeTextProfilOwn ="Hilfe Text für eigene Profil Seite";
                $hilfeTextProfilOther = "Hilfe Text für andere Profil Seite";
                $hilfeTextAdmin = "Hilfe Text für Admin Seite";
                $hilfeTextLogin = "Hilfe Text für Login Seite";
                $hilfeTextRegister = "Hilfe Text für Register Seite";


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
