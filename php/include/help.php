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
    <link rel="stylesheet" href="/css/style_help.css" type="text/css" />
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

                $hilfeTextQuizUebersicht = "Willkommen beim Quiz!
                                            <br>
                                            Hier hast du die Auswahl zwischen dem Singleplayer und Multiplayer Modus. Im Singleplayer kannst du deine Skills weiter ausbauen und damit deine Freunde im Multiplayer besiegen!
                                            <br>
                                            In jedem Modus bekommst Du 4 Fragen mit je 4 Antwortmöglichkeiten und am Ende des Quiz eine Auswertung der Spielrunde.";
                $hilfeTextQuiz = "Die zu beantwortende Frage steht oben, wähle nun eine der 4 Antworten aus, welche dir als richtig erscheint um mit dem Quiz fortzufahren.";
                $hilfeTextQuizEndseite = "Wie hast du abgeschnitten?
                                          <br>
                                          Wie schlägst du dich gegen deine Freunde im Quiz?
                                          <br>
                                          Um die Antworten auf diese Fragen zu erhalten, bist du hier genau richtig!";
                $hilfeTextForum = "Das Forum bietet Dir die Möglichkeit mit Dich mit anderen auszutauschen.
                                    <br>
                                    Dabei gibt es jeweils ein Oberthema und dieses wird unterteilt, so dass es für verschiedene Unterthemen, je ein eigenes Verzeichnis gibt. Jeder kann Diskussionsbeiträge schreiben, die andere lesen und beantworten können.";
               
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
                $hilfeTextArtikel ="Hier hast du die Möglichkeit verschiedene Artikel abzurufen, die Dir beim Lernen helfen können.";
                $hilfeTextArtikelShow ="Hier wird dir der zuvor ausgewählte Artikel angezeigt.";
                $hilfeTextScripts ="Hier hast du die Möglichkeit verschiedene Skripte abzurufen, die Dir beim Lernen helfen können.";
                $hilfeTextStatistik ="Die Statistik Seite bietet Dir einen Überblick über das Nutzungsverhalten der User.";
                $hilfeTextKontakt ="Wenn du mit uns Kontakt aufnhemen willst, bist du heir genau richtig. Wähle eine der kommunikationsanäle aus und melde ich bei uns, wenn du Fragen oder Anregungen hast.";
                $hilfeTextProfilOwn ="Auf der Profilseite kannst du eine Beschreibung über Dich hinterlassen, sehen welchen Leuten du folgst und wer Dir folgt. Zusätzlich kannst du deine Aktivitäten und Statistik abrufen.";
                $hilfeTextProfilOther = "Auf der Profilseite kannst du die Aktiväten der Person sehen und ihr folgen um gegen sie spannende Quizduelle auszutragen u";
                $hilfeTextAdmin = "Als Admin kannst du iher neue Cases für die Datenbank anlegen, Neue Kategorien und Symptome hinzufügen und ebenso wieder löschen.";
                $hilfeTextLogin = "Auf dieser Seite kannst du dich auf der Medausbild Seite einloggen.";
                $hilfeTextRegister = "Hier kannst du ein neues Konto erstellen um Teil der Medausbild Community zu werden.";


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
