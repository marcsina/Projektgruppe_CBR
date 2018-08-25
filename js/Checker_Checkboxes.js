/*
	TO-DO:
	- Farben Impairment Buttons
*/

$(document).ready(function () {
	cbr.loadIncomingCase("no name", "no text");
	loadSymptoms();
	autocomplete(document.getElementById("input_category"), makeCategoryNamesArray());
});

var ergebnis = new Array();

function loadSymptoms() {
	var i;

	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
		//TO-DO: Beschreibungen der Symptome in Datenbank einfügen
		$('#form_symptoms').append('<div id=' + 'div_' + i + ' class="row symptom"><label class="col-md-11">' + parseInt(i+1) + ': ' + cbr.incomingCase.Symptoms[i].name + '</label><input class="col-md-1 checkboxes" type="checkbox" name="1" id=' + 'checkbox_' + i + '></div>');
	}
}

function makeCategoryNamesArray() {
	var CategoryNamesArray = [];
	var i;
	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
		CategoryNamesArray.push(cbr.incomingCase.Symptoms[i].name);
	}
	return CategoryNamesArray;
}

function autocompleteAddSymptom(nameClickedSymptom) {
	const index = cbr.incomingCase.Symptoms.map(e => e.name).indexOf(nameClickedSymptom);
	if ($("#checkbox_" + index).is(':checked')) {
		alert("Symptom bereits gesetzt");
	}
	else {
		$("#checkbox_" + index).click();
	}
}

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
	cbr.calculateSimilarityComplex();
	$('#div_ausgabe').html(buildOutput());
});

$('#btn_start').click(function () {
	var i;
	var ausgabe = "";
	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
		ausgabe = ausgabe + "Symptom " + parseInt(i * 1 + 1*1) + ": " + cbr.incomingCase.Symptoms[i].name + " Wert: " + cbr.incomingCase.Symptoms[i].wert + "\n";
	}
	alert(ausgabe);
});

// Wird ausgeführt beim Anklicken einer Checkbox
$('body').on('click', '.checkboxes', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");

	if ($("#" + clickedBtnID).is(':checked')) {
		// checked
		$('#section_symptoms').append('<div id=' + 'div_impairment_' + idOhnePrefix + ' class="symptom row"><div class="col-md-6 col-sm-6">' + parseInt(idOhnePrefix * 1 + 1 * 1) + ': ' + cbr.incomingCase.Symptoms[idOhnePrefix].name + '</div > <div class="col-md-5 col-sm-5 btn-group" data-toggle="buttons"><button id=' + 'btn_klein_' + idOhnePrefix + ' class="btn btn-info btn-sm impairmentbutton">klein</button><button id=' + 'btn_mittel_' + idOhnePrefix + ' class="btn btn-warning btn-sm impairmentbutton">mittel</button><button id=' + 'btn_hoch_' + idOhnePrefix + ' class="btn btn-danger btn-sm impairmentbutton">hoch</button></div> <div class=" col-md-1"> <button type="button" id=' + 'btn_close_' + idOhnePrefix + ' class="close btn btn-info xbutton">x</button></div></div>');
		// Standardwerte setzen
		$('#' + 'btn_klein_' + idOhnePrefix).click();
	}
	else {
		// unchecked
		$('#' + 'div_impairment_' + idOhnePrefix).remove();
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0;
	}	


});

// Wird ausgeführt beim anklicken eines Buttons zur Angabe der Stärke eines Symptoms
$('body').on('click', 'button.impairmentbutton', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");

	if (clickedBtnID.includes("klein")) {
		/*
		 * Add appropriate CSS Data before removing Commentarea
		$('#' + 'btn_klein_' + idOhnePrefix).addClass('CSSWhenButtonSelected');
		$('#' + 'btn_mittel_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		$('#' + 'btn_hoch_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		*/
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0.3;
	}
	if (clickedBtnID.includes("mittel")) {
		/*
		 * Add appropriate CSS Data before removing Commentarea
		$('#' + 'btn_mittel_' + idOhnePrefix).addClass('CSSWhenButtonSelected');
		$('#' + 'btn_klein_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		$('#' + 'btn_hoch_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		*/
		cbr.incomingCase.Symptoms[idOhnePrefix].wert = 0.6;
	}
	if (clickedBtnID.includes("hoch")) {
		/*
		 * Add appropriate CSS Data before removing Commentarea
		$('#' + 'btn_hoch_' + idOhnePrefix).addClass('CSSWhenButtonSelected');
		$('#' + 'btn_klein_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		$('#' + 'btn_mittel_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		*/
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