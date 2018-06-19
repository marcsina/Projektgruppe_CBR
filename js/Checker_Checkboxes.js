$(document).ready(function () {
	loadSymptoms();
});

var ergebnis = new Array();

function loadSymptoms() {
	//TO-DO: Symptome aus der Datenbank laden
	var symptome = ["kopfschmerzen", "fussschmerzen", "herzschmerz"];
	var i;
	for (i = 0; i < symptome.length; i++) {
		var symptom = symptome[i];
		//TO-DO: Beschreibungen der Symptome in Datenbank einfügen
		$('#form_symptoms').append('<div id=' + 'div_' + symptome[i] + ' class="row"><label class="col-md-4" for= "1" > <abbr title="TO-DO: Beschreibungen von Symptomen in DB">' + symptome[i] + '</abbr></label><input class="col-md-4 checkboxes" type="checkbox" name="1" id=' + 'checkbox_' + symptome[i] + '></div>');
	}
}



$('#btn_submit').click(function () {

});

$('#btn_start').click(function () {
	//AlertAusgabe ersetzen durch Auswertung und anschließender Ausgabe in einem Textfeld
	var i;
	var ausgabe = "";
	for (i = 1; i < ergebnis.length+1; i++) {
		ausgabe = ausgabe + "Symptom " + i + ": " + ergebnis[i-1] + "\n";
	}
	alert(ausgabe);
});

// Wird ausgeführt beim Nnklicken einer Checkbox
$('body').on('click', '.checkboxes', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");

	if ($("#" + clickedBtnID).is(':checked')) {
		// checked
		$('#section_symptoms').append('<div id=' + 'div_impairment' + idOhnePrefix + ' class="row"><br><div class="col-md-3 col-sm-3">' + idOhnePrefix + '</div > <div class=" col-md-offset-2 col-md-6 col-sm-offset-2 col-sm-7 btn-group " data-toggle="buttons"><button id=' + 'btn_klein_' + idOhnePrefix + ' class="btn btn-info btn-sm impairmentbutton">klein</button><button id=' + 'btn_mittel_' + idOhnePrefix + ' class="btn btn-warning btn-sm impairmentbutton">mittel</button><button id=' + 'btn_hoch_' + idOhnePrefix + ' class="btn btn-danger btn-sm impairmentbutton">hoch</button></div> <div class=" col-md-1"> <button type="button" class="close btn btn-info" data-dismiss="modal">x</button></div></div>');
		//TO-DO: Standardwert für Symptom setzen
		ergebnis.push(idOhnePrefix);
	}
	else {
		// unchecked
		$('#' + 'div_impairment' + idOhnePrefix).remove();
		//TO-DO: Symptom Wert zurücksetzen (0); Vielleicht unnötig
		var index = ergebnis.indexOf(idOhnePrefix);
		ergebnis.splice(index, 1);
	}	


});

// Wird ausgeführt beim anklicken eines Buttons zur Angabe der Stärke eines Symptoms
$('body').on('click', 'button.impairmentbutton', function () {
	var clickedBtnID = $(this).attr('id');
	var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");
	var impairment = "";

	if (clickedBtnID.includes("klein")) {
		alert("Symptom: " + idOhnePrefix + " - " + "geringe Einfluss");
	}
	if (clickedBtnID.includes("mittel")) {
		alert("Symptom: " + idOhnePrefix + " - " + "mittlerer Einfluss");
	}
	if (clickedBtnID.includes("hoch")) {
		alert("Symptom: " + idOhnePrefix + " - " + "riesiger Einfluss");
	}
	
	//TO-DO: Stärke im Symptom gemäß Eingabe aktualisieren
});