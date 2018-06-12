<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';

 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!doctype html>
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


        <link href="css/style.css" rel="stylesheet">


    </head>

    <body id="home">
		
		<!-- include Navbar -->
		<?php
			include ("php/include/navbar.php");
		?>

		


        <!-- _________________________Content________________________________-->
        <br>
        <br>
        <br>
        <br>

        <!-- every content should be nested in a way like the example below   -->

        <!-- nested columns -->
        <div class="row first-after-navbar">
            <form>
                <!-- first nested column -->
                <div class="col-md-12">
                    <p id="input-textarea">                                                                                                               
					66-jähriger Patient, geschieden, lebte bislang alleine in eigener Paterrewohnung in unmittelbarer
Nachbarschaft zur Familie des Sohnes, in ländlicher Umgebung. Der Patient versorgte sich alleine,
kaufte ein, machte sich sein Essen. Es gibt einen Aldi und einen Bäcker in der Nähe. Es gibt eine
Arztpraxis mit drei Ärztinnen/Ärzten, die den ländlichen Bereich versorgen. Für größere Erledigungen
muss er in den nächst größeren Ort, z. B. mit dem Auto oder mit den öffentlichen Verkehrsmitteln,
fahren.

Der Patient ist in der Sprechstunde/Klinik schon seit 2004 bekannt. Er kam ursprünglich mit einem Mini-
Mental-Status (MMSE) von 30 Punkten, jedoch schon Hinweisen auf eine sehr initiale Demenz. Im

Frühjahr 2009, nach nunmehr 4 1⁄2 Jahren, ist der MMSE auf 21 Punkte gefallen. Im MRT von 2004
bestand bereits eine auffallende, eindeutig die Altersnorm überschreitende cortical betonte Hirnatrophie.
Im HMPAO-SPECT fand sich eine diffus herabgesetzte Aktivitätsbelegung bds., insbesondere links,
vereinbar mit einer neurodegenerativen Grunderkrankung, am ehesten im Sinne einer
Alzheimer-Demenz.
Der Patient ist sehr sportlich, machte zum Beispiel Krafttraining, fand aber aufgrund der Demenz in der
letzten Zeit nicht immer das richtige Maß. So kam es kürzlich zu einem Sturz vom Fahrrad mit einer
fraglichen kurzen Bewusstlosigkeit.
Er wurde daraufhin stationär untersucht, wobei keine fassbare Ursache gefunden wurde.
Der Sohn verunglückte vor vier Wochen mit dem Motorrad schwer und steht als unmittelbarer
Ansprechpartner nicht mehr zur Verfügung. Die Schwiegertochter ist berufstätig, muss die Kinder
versorgen und nun auch den verunglückten Ehemann. Der Patient konnte die Verletzung des Sohnes
nicht einschätzen und geriet in Panik. Er ging zum Hausarzt mit einem akuten Angstzustand und dem
Bild einer Progression der Demenz, wurde daraufhin eingewiesen, wobei die Aufnahme nach einem
längeren Gespräch aber nicht als sinnvoll erschien. Der Patient klagt augenblicklich über Schlaflosigkeit
und Ängste.
Der Patient wird nun wöchentlich in die Selbsthilfe- und Trainingsgruppe eingeladen. Dort kann er auch
über seine Probleme sprechen und ggf. Problemlösungen erfahren. Die Fahrt dahin fällt ihm
zunehmend schwerer.

Der Patient kann augenblicklich die Mahlzeiten nicht mehr ausreichend zubereiten; Anziehen, Ausziehen, Waschen
kann er noch selbst. Er kann sich im Dorf noch bewegen, größere Wege, z. B. in die nächst größere Stadt, sind nun
kaum mehr möglich. Der Patient kommt immer häufiger mit Zetteln in die Klinik. Die Bewältigung von Post,
Arztterminen usw. ist schwierig geworden, zumal die Anbindung an den Sohn nun nicht mehr so möglich ist. Er ist
im Begriff seine Selbständigkeit zur verlieren. Er zieht sich verstärkt zurück, geht nicht mehr häufig zum Einkaufen,
ist depressiv und verzweifelt geworden, weint häufig, auch weil er seine Demenz bemerkt und nun den Unfall
seines Sohnes betrauert.
Ganz akut klagt er über Kniebeschwerden bei Gonarthrose. In der Vergangenheit wurde schon einmal eine
Arthroskopie veranlasst. Der Patient kann nun kaum mehr Treppen steigen und plant in der nächsten Zeit einen
chirurgischen Eingriff.
					</p>
                </div>

                <!-- second nested column -->
                <div class="col-md-12">
                    <!-- column content -->
                    <button type="button" id="berechnen">GetKeywords</button>
					<button type="button" id="berechnen2">GetKeywords_New_Version</button>
                    <button type="button" id="cbr">CBR Auswertung</button>

                </div>

                <!-- third nested column -->
                <div class="col-md-12">
                    <label>
                        <output id="output-textarea"></output>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>
                        <output id="CBRtestfeld"></output>
                    </label>
                </div>
                
                       </form>
        </div>
		<div><b>Keywords from Database:</b></div>
        <div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="pastHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="cbrhint" style="display:none"><b>CaseBase Data will be displayed here</b></div>

		<br> <br>
		<div><b>Keywords found in Text</b></div>
		<div id="txtKeywords"><b></b></div>
		<br> <br>
        <!--____________________________________________________________________________________________________-->
		 <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?> 
        <form action="php/include/login_process.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <p>If you don't have a login, please <a href="php/register.php">register</a></p>
        <p>If you are done, please <a href="php/include/logout.php">log out</a>.</p>
        <p>You are currently logged <?php echo $logged ?>.</p>

		<br>
		<form action="php/include/AddCase.php"
				method="post" 
				name="addCase_form">
            Name der Krankheit: <input type='text' 
                name='krankheit' 
                id='krankheit' /><br>
			Beschreibung: <input type='text' 
                name='beschreibung' 
                id='beschreibung' /><br>	
			<input type='text' 
                name='hiddenkat' 
                id='hiddenkat' />
            <input type="button" 
                   value="addCase" 
                   onclick="return AddCase_Check(addCase_form,addCase_form.krankheit,addCase_form.beschreibung,addCase_form.hiddenkat);" /> 
        </form>

        <!-- Scripts -->
        <!--<script src="js/german-porter-stemmer.js"></script>-->
		<script src="js/snowball-german.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
		<script src="js/CBR.js"></script>
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
		

    </body>

</html>