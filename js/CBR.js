class CBR {
	constructor() {
		this.incomingCase;
		this.Cases = [];
		this.Results = ["Banana", "Orange", "Apple", "Mango"];
		this.Similarities = ["Banana", "Orange", "Apple", "Mango"];
		this.ergebnisse = "";
	}

	loadAllArrays() {
		var string_caseValues = $("#cbrhint").text();


		var split_end = string_caseValues.split('[||separatorend||]');

		var i;
		for (i = 0; i < split_end.length; i++) {

			var split_mid = split_end[i].split('(//separatormid//)');
			if (this.Cases[split_mid[0] - 1] + "" === "undefined") {
				this.Cases[split_mid[0] - 1] = new Case(split_mid[0] - 1, "fake", "faketext");
			}
			var symptom = new Symptom(split_mid[1], "name", split_mid[2]);
			this.GiveCaseSymptom(split_mid[0] - 1, symptom);
		}

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
		this.ergebnisse = "";
		var i;
		for (i = 0; i < this.Cases.length; i++) {
			var percentageValue = 0;
			var numberSymptoms = 0;
			var zwischen = 0 ;
			var k;
			for (k = 0; k < this.incomingCase.Symptoms.length; k++) {
				var wij = 1;

				if(this.incomingCase.Symptoms[k].wert>0&&this.Cases[i].Symptoms[k].wert>0)
				{
					zwischen = this.incomingCase.Symptoms[k].wert/this.Cases[i].Symptoms[k].wert*1;
					
					if(zwischen > 1)
					{
						zwischen = 1/zwischen;
					}
					numberSymptoms += 1;
					percentageValue += zwischen*1;
				}
				else if(this.incomingCase.Symptoms[k].wert>0&&this.Cases[i].Symptoms[k].wert==0)
				{
					zwischen = 0;
					numberSymptoms += 1;
					percentageValue += zwischen*1;
				}
				else if(this.incomingCase.Symptoms[k].wert==0&&this.Cases[i].Symptoms[k].wert>0)
				{
					zwischen = 0;
					numberSymptoms += 1;
					percentageValue += zwischen*1;
				}
			}
			var factor = Math.pow(10, 2);
			this.Similarities[i] = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
			this.ergebnisse = this.ergebnisse + "" + "incomingCase: " + this.incomingCase.id + "          Case: " + this.Cases[i].id + "          Similarity: " + this.Similarities[i] +"%<br>";
		}
	}
	
	calculateSimilaritySimple() {
		this.ergebnisse = "";
		var i;		
		for (i = 0; i < 10; i++) {
		//for (i = 0; i < this.Cases.length; i++) {
			var percentageValue = 0;
			var numberSymptoms = 0;
			var zwischen = 0 ;
			var k;
			for (k = 0; k < this.incomingCase.Symptoms.length; k++) {
				var wij = 1;

				if(this.incomingCase.Symptoms[k].wert>0&&this.Cases[i].Symptoms[k].wert>0)
				{
					zwischen = 1;
					numberSymptoms += 1;
					percentageValue += zwischen*1;
				}
				else if(this.incomingCase.Symptoms[k].wert>0&&this.Cases[i].Symptoms[k].wert==0)
				{
					zwischen = 0;
					numberSymptoms += 1;
					percentageValue += zwischen*1;
				}
				else if(this.incomingCase.Symptoms[k].wert==0&&this.Cases[i].Symptoms[k].wert>0)
				{
					zwischen = 0;
					numberSymptoms += 1;
					percentageValue += zwischen*1;
				}
			}
			var factor = Math.pow(10, 2);
			this.Similarities[i] = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
			this.ergebnisse = this.ergebnisse + "" + "incomingCase: " + this.incomingCase.id + "          Case: " + this.Cases[i].id + "          Similarity: " + this.Similarities[i] +"%<br>";
		}
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
		this.name = "coolerOlli";

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

function getCasesFromDatabase(database) {
	if (database === "") {
		$("#cbrhint").html("Verbindung konnte nicht aufgebaut werden");
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
				$("#cbrhint").text(this.responseText);
			}
		};
		xmlhttp.open("GET", "http://141.99.248.92/Projektgruppe/php/include/getCaseValues.php", false);
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
	getCasesFromDatabase("MedAusbildSS18");
});

var cbr = new CBR();

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