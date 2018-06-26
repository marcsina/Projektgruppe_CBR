/*
	TO-DO:
	- Submit Button ben�tigt 2 Klicks ???
	- Autocomplete
	- CBR aktuell nur f�r ersten 10 F�lle, da Aufbau DB sich ge�ndert hat
	- Farben Impaitment Buttons
*/

$(document).ready(function () {
	cbr.loadIncomingCase("no name", "no text");
	loadSymptoms();
});

var ergebnis = new Array();

function loadSymptoms() {
	var i;

	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
		//TO-DO: Beschreibungen der Symptome in Datenbank einf�gen
		$('#form_symptoms').append('<div id=' + 'div_' + i + ' class="row"><label class="col-md-4" for= "1" > <abbr title="TO-DO: Beschreibungen von Symptomen in DB">' + cbr.incomingCase.Symptoms[i].id + ': ' + cbr.incomingCase.Symptoms[i].name + '</abbr></label><input class="col-md-4 checkboxes" type="checkbox" name="1" id=' + 'checkbox_' + i + '></div>');
	}
}



$('#btn_submit').click(function () {
	cbr.loadAllArrays();
	cbr.calculateSimilaritySimple();
	$('#div_ausgabe').html(cbr.ergebnisse);
});

$('#btn_start').click(function () {
	var i;
	var ausgabe = "";
	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
		ausgabe = ausgabe + "Symptom " + parseInt(i * 1 + 1*1) + ": " + cbr.incomingCase.Symptoms[i].name + " Wert: " + cbr.incomingCase.Symptoms[i].wert + "\n";
	}
	alert(ausgabe);
});

// Wird ausgef�hrt beim Anklicken einer Checkbox
$('body').on('click', '.checkboxes', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");

	if ($("#" + clickedBtnID).is(':checked')) {
		// checked
		$('#section_symptoms').append('<div id=' + 'div_impairment_' + idOhnePrefix + ' class="row"><br><div class="col-md-3 col-sm-3">' + parseInt(idOhnePrefix*1 + 1*1) + ': ' + cbr.incomingCase.Symptoms[idOhnePrefix].name + '</div > <div class=" col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-7 btn-group " data-toggle="buttons"><button id=' + 'btn_klein_' + idOhnePrefix + ' class="btn btn-info btn-sm impairmentbutton">klein</button><button id=' + 'btn_mittel_' + idOhnePrefix + ' class="btn btn-warning btn-sm impairmentbutton">mittel</button><button id=' + 'btn_hoch_' + idOhnePrefix + ' class="btn btn-danger btn-sm impairmentbutton">hoch</button></div> <div class=" col-md-1"> <button type="button" id=' + 'btn_close_' + idOhnePrefix + ' class="close btn btn-info xbutton">x</button></div></div>');
		// Standardwerte setzen
		$('#' + 'btn_klein_' + idOhnePrefix).click();
	}
	else {
		// unchecked
		$('#' + 'div_impairment_' + idOhnePrefix).remove();
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0;
	}	


});

// Wird ausgef�hrt beim anklicken eines Buttons zur Angabe der St�rke eines Symptoms
$('body').on('click', 'button.impairmentbutton', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");

	if (clickedBtnID.includes("klein")) {
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0.3;
	}
	if (clickedBtnID.includes("mittel")) {
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0.6;
	}
	if (clickedBtnID.includes("hoch")) {
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0.9;
	}

	// TO-DO: Buttondesign anpassen
});

// X Button Rechte Seite
$('body').on('click', 'button.xbutton', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");
	// Symtom aus Liste entfernen
	$('#div_impairment_' + idOhnePrefix).remove();
	// Entsprechende Checkbox auf "unchecked" setzen
	$("#checkbox_" + idOhnePrefix).prop("checked", false);
	// Symptom Wert auf 0 setzen
	cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0;

});