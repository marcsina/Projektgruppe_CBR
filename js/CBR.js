class CBR {
	constructor() {
		this.incomingCase;
		this.Cases = [];
		this.Results = [];
		this.Similarities = [];
		this.ergebnisse = "";
	}

	loadAllArrays() {

		//Loads All Cases from Database
		getCasesFromDatabase("MedAusbildSS18", cbr.Cases);
		//Fills all Cases with Symptoms
		getCaseValuesFromDatabase("MedAusbildSS18", cbr.Cases);

		var ausgabe = "";
		/*for (i = 0; i < this.Cases[2].Symptoms.length; i++) {
			ausgabe = ausgabe + "Symptom " + parseInt(i * 1 + 1 * 1) + ": " + this.Cases[0].Symptoms[i].id + " Wert: " + this.Cases[0].Symptoms[i].wert + "\n";
		}
		alert(ausgabe);*/


	}

	loadIncomingCaseFromDB(nr) {
		this.incomingCase = this.Cases[nr];
	}

	loadIncomingCase(name, text) {
		this.incomingCase = new Case(-1, name, text);

		// Gets Categories for Symptoms from Database and stores them into an Array
		getCategoriesFromDatabase("MedAusbildSS18", this.incomingCase.Symptoms);
	}

	// Vergleich zwischen Incoming Case und Case Base
	calculateSimilarityComplex() {
		this.Similarities = [];
		this.ergebnisse = "";
		var i;

		for (i = 0; i < this.Cases.length; i++) {
			var percentageValue = 0;
			var numberSymptoms = 0;
			var zwischen = 0;
			var result = 0;
			var k;

			const copyArrayCaseSymptoms = this.Cases[i].Symptoms.slice();
			const copyArrayIncomingCaseSymptoms = this.incomingCase.Symptoms.slice();

			//Symptome in eingehendem Fall überprüfen
			for (k = copyArrayIncomingCaseSymptoms.length - 1; k >= 0; k--) {
				var wij = 1;
				const index = copyArrayCaseSymptoms.map(e => e.id).indexOf(copyArrayIncomingCaseSymptoms[k].id);

				//Symptom in eingehendem fall vorhanden, aber nicht in Fall aus CaseBase
				if (index == -1) {
					if (copyArrayIncomingCaseSymptoms[k].wert > 0) {
						zwischen = 0;
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
				}
				//Symptom in eingehendem Fall und in Fall aus Case Base vorhanden
				else {
					if (copyArrayIncomingCaseSymptoms[k].wert > 0 && copyArrayCaseSymptoms[index].wert > 0) {
						zwischen = copyArrayIncomingCaseSymptoms[k].wert / copyArrayCaseSymptoms[index].wert * 1;
						if (zwischen > 1) {
							zwischen = 1 / zwischen;
						}
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
					else if (copyArrayIncomingCaseSymptoms[k].wert > 0 && copyArrayCaseSymptoms[index].wert == 0) {
						zwischen = 0;
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
					else if (copyArrayIncomingCaseSymptoms[k].wert == 0 && copyArrayCaseSymptoms[index].wert > 0) {
						zwischen = 0;
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
					copyArrayCaseSymptoms.splice(index, 1);
				}
				copyArrayIncomingCaseSymptoms.splice(k, 1);
			}

			//Symptome des Falles aus der Case base überprüfen
			//Symptom in Fall aus Case Base vorhanden, aber nicht im eingehenden Fall
			for (k = copyArrayCaseSymptoms.length - 1; k >= 0; k--) {
				zwischen = 0;
				numberSymptoms += 1;
				percentageValue += zwischen * 1;

				copyArrayCaseSymptoms.splice(k, 1);

			}
			var factor = Math.pow(10, 2);
			this.Cases[i].similarity = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
			this.Similarities.push(this.Cases[i]);
			//this.ergebnisse = this.ergebnisse + "" + "incomingCase: " + this.incomingCase.id + "          Case: " + this.Cases[i].id + "          Similarity: " + this.Similarities[i] + "%<br>";			
		}
		this.Similarities.sort((a, b) => parseFloat(b.similarity) - parseFloat(a.similarity));

		
	}
	
	calculateSimilaritySimple() {
		this.Similarities = [];
		this.ergebnisse = "";
		var i;
		
		for (i = 0; i < this.Cases.length; i++) {
			var percentageValue = 0;
			var numberSymptoms = 0;
			var zwischen = 0;
			var result = 0;
			var k;
			const copyArrayCaseSymptoms = this.Cases[i].Symptoms.slice();
			const copyArrayIncomingCaseSymptoms = this.incomingCase.Symptoms.slice();

			//Symptome in eingehendem Fall überprüfen
			for (k = copyArrayIncomingCaseSymptoms.length-1; k >= 0; k--) {
				var wij = 1;
				const index = copyArrayCaseSymptoms.map(e => e.id).indexOf(copyArrayIncomingCaseSymptoms[k].id);

				//Symptom in eingehendem fall vorhanden, aber nicht in Fall aus CaseBase
				if (index == -1) { 
					zwischen = 0;
					numberSymptoms += 1;
					percentageValue += zwischen * 1;					
				}
				//Symptom in eingehendem Fall und in Fall aus Case Base vorhanden
				else {
					if (copyArrayIncomingCaseSymptoms[k].wert > 0 && copyArrayCaseSymptoms[index].wert > 0) {
						zwischen = 1;
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
					else if (copyArrayIncomingCaseSymptoms[k].wert > 0 && copyArrayCaseSymptoms[index].wert == 0) {
						zwischen = 0;
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
					else if (copyArrayIncomingCaseSymptoms[k].wert == 0 && copyArrayCaseSymptoms[index].wert > 0) {
						zwischen = 0;
						numberSymptoms += 1;
						percentageValue += zwischen * 1;
					}
					copyArrayCaseSymptoms.splice(index, 1);
				}				
				copyArrayIncomingCaseSymptoms.splice(k, 1);				
			}

			//Symptome des Falles aus der Case base überprüfen
			//Symptom in Fall aus Case Base vorhanden, aber nicht im eingehenden Fall
			for (k = copyArrayCaseSymptoms.length - 1; k >= 0; k--) {
				zwischen = 0;
				numberSymptoms += 1;
				percentageValue += zwischen * 1;

				copyArrayCaseSymptoms.splice(k, 1);

			}
			var factor = Math.pow(10, 2);
			this.Cases[i].similarity = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
			this.Similarities.push(this.Cases[i]);
			//this.ergebnisse = this.ergebnisse + "" + "incomingCase: " + this.incomingCase.id + "          Case: " + this.Cases[i].id + "          Similarity: " + this.Similarities[i] + "%<br>";			
		}
		this.Similarities.sort((a, b) => parseFloat(b.similarity) - parseFloat(a.similarity));
	}

	GiveCaseSymptom(nr, S) {
		this.Cases[nr].Symptoms.push(S);
	}

	GiveCaseReference(nr, R) {
		this.Cases[nr].Referenzen.push(R);
	}
}

class Case {
	constructor(pid, pname, ptext) {
		this.id = pid;
		this.name = pname;
		this.text = ptext;
		this.similarity = 0;
		this.Symptoms = [];
		this.Referenzen = [];
	}

	initiateSymptoms(){
		var i;
		for (i = 0; i < 110; i++) {
			this.Symptoms[i] = 0;
		}
	}
	
	loadAllArrays() {
		//Symptons

		//References
	}
}

class Referenz {
	constructor(pid, npame, ptext) {
		this.id = pid;
		this.name = pname;
		this.text = ptext;
		this.Symptoms = [];
	}

	loadAllArrays() {
		//Symptoms
	}
}

class Symptom {
	constructor(pid, pname, pwert) {
		this.id = pid;
		this.name = pname;
		this.wert = pwert;
		//       this.wij = pwij;
		//       this.Keyword = [];
	}

	loadAllArrays() {

	}
}

var cbr = new CBR();

//Gets all Symptoms and their values for all Cases
function getCaseValuesFromDatabase(database, arrayCases) {
	if (database === "") {
		return;
	} else {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				var split_end = this.responseText.split(';');
				//alert(split_end.length); // = In DB 1540 einträge, aber split_end bzw. Server Response = 1513 ?????????????????????????????
				var i;
				for (i = 0; i < split_end.length; i++) {

					var split_mid = split_end[i].split(',');

					const index = cbr.Cases.map(e => e.id).indexOf(split_mid[0]);
					
					cbr.GiveCaseSymptom(index, new Symptom(split_mid[1], "name", split_mid[2]));
				}
				
			}
		};
		
		xmlhttp.open("GET", "http://141.99.248.92/Projektgruppe/php/include/getCaseValues.php", false);
		xmlhttp.send();
		
	}
}

//Original function from admin_config
//Gets Cases from DB
function getCasesFromDatabase(database, arrayCases) {
	if (database === "") {
		return;
	} else {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {
				//String bei jedem ; splitten und in array packen
				var array_erste_Stufe = this.responseText.split(';');

				//Erste Stufe jeden eintrag bei , splitten und in neuen array packen
				var array_zweite_Stufe = new Array();
				for (i = 0; i < array_erste_Stufe.length - 1; i++) {
					array_zweite_Stufe.push(array_erste_Stufe[i].split(','));
				}
				//Zweite Stufe als Klassen erstellen und in array_keywords speichern
				for (i = 0; i < array_zweite_Stufe.length; i++) {
					arrayCases.push(new Case(array_zweite_Stufe[i][0], array_zweite_Stufe[i][1], "Text nicht verfügbar"));
				}
			}
		};
		xmlhttp.open("GET", "http://141.99.248.92/Projektgruppe/php/include/getCases.php", false);
		xmlhttp.send();
	}
}

//Original from admin_config
//Get Categories from DB
function getCategoriesFromDatabase(database, array_symptoms) {
	if (database === "") {
		return;
	} else {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (this.readyState === 4 && this.status === 200) {

				var array_split_IntoDatasets = this.responseText.split(";");
				var array_split_DatasetsIntoSingleData = new Array();
				for (i = 0; i < array_split_IntoDatasets.length - 1; i++) {
					array_split_DatasetsIntoSingleData.push(array_split_IntoDatasets[i].split(","));
				}
				for (i = 0; i < array_split_DatasetsIntoSingleData.length; i++) {
					array_symptoms.push(new Symptom(array_split_DatasetsIntoSingleData[i][0], array_split_DatasetsIntoSingleData[i][1], 0));
				}
			}
		};
		xmlhttp.open("GET", "http://141.99.248.92/Projektgruppe/php/include/getCategories.php", false);
		xmlhttp.send();
	}
}

function AddCase_Check(form,name,beschreibung,hiddenkat) {
	
	var supercase = new Case(0,name.value+"", beschreibung.value+"");
	supercase.initiateSymptoms();
	var Categories = "";
	Categories = Categories+""+1+"|"+supercase.Symptoms[0]
	var i;
	for (i = 1; i < supercase.Symptoms.length; i++) {
		Categories = Categories+";"+(i+1)+"|"+supercase.Symptoms[i]
	}
	
	//TODO an dieser Stelle die Textanalyse zur festlegung der Symptome einbauen

	hiddenkat.value = Categories;

	form.submit();
	return true;
}

$(document).ready(function () {
	cbr.loadAllArrays();	
});

function wasnschrott() {
	//alert(cbr.Cases[8].id);
	var ausgabe = "";
	var k;
	for (k = 0; k < cbr.Cases.length; k++) {
		ausgabe = ausgabe + cbr.Cases[k].id + "\n";
	}
	alert(ausgabe);
}

$('#cbr').click(function () {

	var testcbr = new CBR();
	testcbr.loadAllArrays();
	
	/*testcbr.loadIncomingCase();
	testcbr.ergebnisse = testcbr.ergebnisse + "---------------------------------------------------------------------------------------Incoming Case<br>";
	testcbr.ergebnisse = testcbr.ergebnisse + "<pre style=\"color:#000000;\">"
	testcbr.ergebnisse = testcbr.ergebnisse + "                          Simple<br><br>";
	testcbr.calculateSimilaritySimple();
	testcbr.ergebnisse = testcbr.ergebnisse + "</pre>"
	testcbr.ergebnisse = testcbr.ergebnisse + "<pre style=\"color:#000000;\">"
	testcbr.ergebnisse = testcbr.ergebnisse + "                          Complex<br><br>";
	testcbr.calculateSimilarityComplex();
	testcbr.ergebnisse = testcbr.ergebnisse + "</pre>"
	testcbr.ergebnisse = testcbr.ergebnisse + "<br>";
	testcbr.loadIncomingCaseFromDB(0);
	testcbr.ergebnisse = testcbr.ergebnisse + "---------------------------------------------------------------------------------------Case From DB<br>";
	testcbr.ergebnisse = testcbr.ergebnisse + "<pre style=\"color:#000000;\">"
	testcbr.ergebnisse = testcbr.ergebnisse + "                          Simple<br><br>";
	testcbr.calculateSimilaritySimple();
	testcbr.ergebnisse = testcbr.ergebnisse + "</pre>"
	testcbr.ergebnisse = testcbr.ergebnisse + "<pre style=\"color:#000000;\">"
	testcbr.ergebnisse = testcbr.ergebnisse + "                          Complex<br><br>";
	testcbr.calculateSimilarityComplex();
	testcbr.ergebnisse = testcbr.ergebnisse + "</pre>"
	testcbr.ergebnisse = testcbr.ergebnisse + "---------------------------------------------------------------------------------------Ende CBR<br>";
	$("#CBRtestfeld").html(testcbr.ergebnisse);*/
	
});