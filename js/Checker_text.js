$(document).ready(function () {
	cbr.loadIncomingCase("no name", "no text");
});

function buildOutput() {
	var ausgabe = "";
	var ausgabe = ausgabe + "Ergebnisse des Vergleichs mit der Datenbank:<br><br>";
	var i;
	for (i = 0; i < cbr.Similarities.length; i++) {
		ausgabe = ausgabe + "Case " + cbr.Similarities[i].id + " - " + cbr.Similarities[i].name + ": " + cbr.Similarities[i].similarity + "%<br>";
	}
	return ausgabe;
}

$('#btn_submit').click(function () {
	// Filtern der Symptome und �bergabe an CBR 
	var text = $('#textarea_eingabe').val();
	var kategorieAusTextArray = new Array();
	kategorieAusTextArray = extractKeywords(text);

	var i;
	for (i = 0; i < kategorieAusTextArray.length; i++) {
		if (isNaN(kategorieAusTextArray[i].weight)) {
			// mach nix
		}
		else {
			cbr.incomingCase.Symptoms[i].wert = kategorieAusTextArray[i].weight;
		}
	}

	// Anzeigen der gefilterten Symptome
	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
		if (cbr.incomingCase.Symptoms[i].wert > 0) {
			$('#section_symptoms').append('<div id=' + 'div_impairment_' + i + ' class="row"><br><div class="col-md-7 col-sm-3">' + cbr.incomingCase.Symptoms[i].name + '</div > <div class=" col-md-offset-2 col-md-2 col-sm-offset-2 col-sm-2 ">' + cbr.incomingCase.Symptoms[i].wert + '</div></div>');
			if(i == 0)
			{
				
			}
			if(i == 1)
			{
				
			}
			if(i == 2)
			{
				
			}
		}		
	}

	// Berechnung und Ausgabe des Ergebnisses
	cbr.calculateSimilarityComplex();
	$('#div_ausgabe').html(buildOutput());
});