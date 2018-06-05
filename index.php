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

					Meine dementiell erkrankte Tante, ein wahrer Drache, eine bislang lebenslustige und mobile alte Dame, wurde
nach einem Sturz aus dem Bett mit Verdacht auf Schlaganfall in die Klinik und Poliklinik für
Unfallchirurgie eingeliefert. Die Diagnose war schnell gestellt – nur „Gehirnerschütterung“ und
Beschwerden im Rücken. Dennoch begann ab der Einlieferung in die Klinik eine systematische
De-Aktivierung. Abgesehen von einem Bettgitter wurde ihr als erstes ein Katheter gelegt, weil
offenbar keine Zeit war, sie bei Toilettengängen zu begleiten. Da meine Tante nach gewisser
Zeit zudem das Bett eingekotet hatte, wurde ihr als nächstes eine Windel angelegt. Die Klingel
konnte sie nicht mehr bedienen, ihr Rufen wurde nicht „er“hört
Bei unseren Besuchen konnten wir feststellen, dass meine Tante durchaus noch das Bedürfnis
nach einer Toilette äußerte. Einfach ins Bett zu machen, war ihr nicht nachvollziehbar und
außerdem total peinlich. Leider lag im selben Zimmer keine Person, die dem Pflegepersonal die
Bedürfnisse meiner Tante hätte vermitteln können. Im Gegenteil: Die Mitpatientin war ebenfalls
dement. Sie stöhnte in einem fort über extreme Schmerzen und rief jämmerlich nach Hilfe, da
sie unoperiert im Bett lag.
Als wir zum ersten Mal das Zimmer betraten, riefen beide Patientinnen verzweifelt um Hilfe. Die
Mitpatientin lag nackt im Bett, das Nachthemd um den Kopf geschlungen – ein Zeichen, dass
sie schon lange immens um Hilfe kämpfte - doch niemand kümmerte sich um sie. Meine Tante
war schweißnass und zitterte am ganzen Körper. Beide desorientierte Patientinnen wussten
nicht, wo sie waren und was mit ihnen geschah.
Die nicht endenden Hilferufe der Mitpatientin „Wo bin ich hier? So helfen sie mir doch! Was
passiert hier mit mir? Aua, aua, aua, ich habe so schlimme Schmerzen! Was machen sie hier
mit mir? Lassen sie mich hieraus! Hilfe, Hilfe, Hilfe“, müssen bei meiner Tante Erinnerungen an
die Kriegszeit hervorgerufen haben, von der sie immer wieder – Flucht und Vertreibung –
erzählt. Alleine unser erster einstündiger Aufenthalt im Zimmer kam uns wie Folter vor.
Wir baten darum, meine Tante in ein anderes Zimmer zu verlegen, damit sie bei aller Not und
Fremdheit hätte zur Ruhe kommen können. Ein Zimmerwechsel war für uns mit der Hoffnung
verbunden, dass dort ggf. jemand lag, der in Notsituationen das Pflegepersonal hätte
verständigen können. Diese Bitte wurde abgelehnt, obwohl in zwei Zimmern jeweils nur eine
Patientin lag.

Zwei Tage später mussten wir feststellen, dass meine Tante als nächsten Akt der De-
Aktivierung eine Infusion gelegt bekommen hatte – offenbar war keine Zeit, dass jemand ihr

Getränke reichte. Außerdem hatte man sie angegurtet, da sie sehr unruhig war. Keine dieser

- 2 -

Maßnahmen, selbst die freiheitsentziehenden nicht, wurden bis zu diesem Zeitpunkt mit mir als
gerichtlich bestelltem Betreuer besprochen.
Auf meine Aufforderung, meine Tante sofort in ein anderes Zimmer zu legen, weil die
Mitpatientin auch nach deren Operation noch immer ständig um Hilfe rief und meine Tante nicht
zur Ruhe kam, erklärte mir eine Stationsschwester, sie könne sie doch nicht mit „normalen“

Patientinnen zusammenlegen. Das zeigt eine erschreckende Unkenntnis über Demenz-
Erkrankungen und die Bedürfnisse dieser Menschen. Wer in Kategorien wie „normal“ und, so

der Folgeschluss, „unnormal“ denkt, ist für die Versorgung demenzkranker Patientinnen und
Patienten nicht ausreichend ausgebildet.
Auch der herbeigerufene Stationsarzt war nicht bereit, mit mir über die Situation meiner Tante
zu sprechen. Stattdessen beschwerte er sich darüber, dass ich ihm mit meinem „kleinen
Horizont“ seine Zeit stehle. Der pflegerische Zustand meiner Tante sei ihm „scheißegal“ sei,
was er auch vor jeder Kamera dieser Welt wiederholen würde.
Über die medizinische Situation meiner Tante habe ich gar nichts erfahren. Einmal abgesehen
von den persönlichen Unverschämtheiten dieses Stationsarztes zeigt auch sein Verhalten, dass
zumindest die Klinik und Poliklinik für Unfallchirurgie nicht auf die Behandlung dementiell
erkrankter Personen eingestellt ist.
Der Alltagsstress in einem Krankenhaus kann nicht als Entschuldigung für solch ein Verhalten
angeführt werden. Es ist das Denken, das verändert werden muss, wenn die Versorgung von
Patientinnen und Patienten mit dementieller Erkrankung menschenwürdig werden soll.
Erst am fünften Tag des Krankenhausaufenthaltes konnte eine zufrieden stellende Lösung
gefunden werden und das auch nur mit „Vitamin B“. Durch mein Einschalten des
Verwaltungsdirektors der Klinik, mit dem ich vorher beruflich mehrfach in Kontakt stand, hat
sich die Situation fundamental verbessert. Meine Tante wurde verlegt, die ergriffenen
freiheitsentziehenden Maßnahmen wurden nur noch in der Nacht angewandt und sie wurde
wieder aktiviert, u.a. durch eine Krankengymnastik. Alle Maßnahmen wurden von einem
Oberarzt der Klinik mit mir abgestimmt. Nach zwei weiteren Tagen Krankenhausaufenthalt
wurde meine Tante entlassen.
Diese Erlebnisse in der Klinik waren und sind für die weitere Lebenszeit meiner Tante prägend.
Sie kam in die ambulant betreute Wohngemeinschaft, in der sie seit fast zwei Jahren lebte,
schwer traumatisiert zurück. Die Betreuungskräfte konnten ihre Unruhe zunächst kaum
auffangen. Erst bei der Rückkehr in die WG wurde festgestellt, dass man in der Klinik alle
Medikamente, mit denen meine Tante seit Jahren lebte, abgesetzt hatte. Die fortwährenden
Schwitzattacken im Krankenhaus kamen also offenbar nicht nur von den Angstzuständen durch
die kriegsähnlichen Hilferufe, sondern vermutlich auch durch den Medikamentenentzug und die
damit ausgelösten körperlichen Reaktionen.
In der Wohngemeinschaft baute meine Tante innerhalb der ersten Woche trotz intensiver
Betreuung körperlich von Tag zu Tag mehr ab und konnte nach zwei Wochen das Bett nicht
mehr verlassen. Inzwischen wird ständig gelagert und über Infusionen mit Flüssigkeit versorgt.
Was ist denjenigen, die niemanden mehr haben, die sich um sie kümmern können? Und mit
denjenigen, deren Angehörige sich nicht trauen, den „Halbgöttern in Weiß“ Paroli zu bieten?
Sie sind Ärztinnen und Ärzten, Pflegerinnen und Pflegern ausgesetzt, die nicht in der Lage –
und auch willens? – sind, ihre Bedürfnisse zu erkennen und sie menschenwürdig zu behandeln.

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