<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<html lang="en">


<head>
    <!-- include Header -->    
    <?php include('include/header.php'); ?>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>  
    <?php include ("include/navbar.php"); ?>
    
<body id="home">
	<div class="container">
        <div class="row text-center">
            <h1 style=" color: white">Olli Verschwunden!</h1>
    		<h6><span class="glyphicon glyphicon-time"></span> Post by Jane Dane,sep 27,2018</h6>
    		<br>
    		 <article>
                    <p class="text-left">
    				Attendorn. Es ist einer der wohl mysteriösesten Vermisstenfälle der letzten Jahre: Seit dem 10. Mai ist Olli verschwunden. Der afroamerikanische Langzeitstudent fuhr morgens von seinem Wohnhaus in Attendorn wenige Straßen weiter zu einer Kundin - doch dort kaum 50 Meter entfernt kam er nie an. Zwölf Hinweise gab es nach der Vermisstenanzeige, keiner brachte die Ermittler weiter. Die Angehörigen verzweifeln, die Polizei ist ratlos. Nach dem letzten Aufruf der Familie Ende Oktober erreichte die Ehefrau des Vermissten sogar ungewöhnlich viele Hinweise auf ihren Mann aus Attendorn.
    
    				Polizeisprecherin Kathryn Landwehrmeyer bestätigt: "Die Ehefrau hat daraufhin unsere Ermittlerin Petra Kipp informiert. Die Kripo hat die ersten Augenzeugen in Attendorn besucht." Leider hätten erste Überprüfungen aber nicht bestätigt, dass die Zeugen wirklich Olli gesehen haben. Kripoexpertin Petra Kipp und Ehefrau wollen die Spur, die offenbar nach Attendorn führt, dennoch noch nicht aufgeben.
    
    				Familie Kaßburg hat nun fünfeinhalb Monate quälende Ungewissheit hinter sich. Hat Olli, der Ehemann seit fast 25 Jahren, der Vater zweier erwachsener Söhne, der erfolgreiche Selbstständige, sich umgebracht? Ist er untergetaucht? Wenn ja: Vor was flüchtete er? Und warum so abrupt? "Der Zustand ist kaum auszuhalten", sagt seine Ehefrau. "Das Schlimmste ist die Ohnmacht."
    
    				Auch wenn ihr Mann fehlt und die Familie mittlerweile aus finanziellen Gründen umziehen musste, so ist er doch allgegenwärtig, sagt die 53-Jährige. Akribisch rekonstruiere sie immer wieder die Zeit Anfang Mai. Der 9. Mai etwa, ein Montag, der Tag vor dem Verschwinden ihres Mannes, war ganz gewöhnlich. Oliver fuhr an die Lakemannstraße, es war ein größerer Malerauftrag, der einige Tage in Anspruch genommen hätte. Daheim wieder angekommen, ging er dann mit einem der Söhne - der jüngere wohnt bei den Eltern - eine Job-Bewerbung durch. Mit seiner Frau schaute er einen Krimi. Normalität. Ruhig klang der Abend aus. Es war der letzte gemeinsame.
    
    				"Oliver war wohl in einer Ausnahmesituation", sagt seine Ehefrau. Sie schüttelt hilflos und nachdenklich den Kopf. "Er hat nichts angedeutet, nichts mitgenommen, nichts hinterlassen." Sein Handy wurde im Auto gefunden. Im Affekt geflohen - das ist Olli indes schon einmal. Als er das Geschichtsstudium geschmissen hat, fuhr er mit dem Zug zwölf Stunden durch die Gegend. Ziellos, wie bei einer Amnesie. "Das machen Menschen mit dissoziativen Persönlichkeitsstörungen. Sie spalten Erinnerungen an belastende Erlebnisse ab, blenden sie aus", sagt seine Frau.
    
    				Hat Olli also womöglich ein bisheriges Leben zurückgelassen und woanders ein neues begonnen, ohne es selbst überhaupt so wahrzunehmen? Spekulation. Nur vage Ansätze für Gedankenspiele, sagt seine Ehefrau. Psychiatrisch untersucht wurde ihr Mann schließlich nie. Es spreche jedenfalls nichts für eine geplante Flucht. Mit seinen Söhnen wollte er im Sommer auf ein Musikkonzert und zur Tour de France, ein neues Auto war bestellt. Von Existenzängsten sprach er nie, seit Mai wurde kein Geld vom Konto abgebucht.
    
    				Was bleibt, ist Hoffnung. So hangelt sich die Familie durch den Alltag. "Solange Oliver nicht tot gefunden wird, lebt er für uns", sagt seine Frau. Wenn entfernte Bekannte fragen, wie es denn "dem Olli" geht, stocke sie aber jedes Mal. Nichts wüsste sie lieber.
    				</p>
           	</article>
        </div>
    </div>
    <!-- Scripts -->

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>