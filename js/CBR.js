class CBR {
	constructor() {
		this.incomingCase;
		this.Cases = [];
		//       this.AllReferences = ["Banana", "Orange", "Apple", "Mango"];
		//       this.AllSymptoms = ["Banana", "Orange", "Apple", "Mango"];
		this.Results = ["Banana", "Orange", "Apple", "Mango"];
		this.Similarities = ["Banana", "Orange", "Apple", "Mango"];
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

	loadIncomingCase() {
		this.incomingCase = new Case(-1, "Incoming Case", $("#input-textarea").text());
		var i;
		var k;
		var value = 0;

		for (i = 0; i < this.Cases[0].Symptoms.length; i++) {
            for ( k = 0; k < absolute_final_array.length; k++) {							
                if ( i == absolute_final_array[k].katID) {
                    value = absolute_final_array[k].weight;	
				}
			}
			this.incomingCase.Symptoms.push(new Symptom(i, "bla", value));
			value = 0;
		}
		
	}

	// Vergleich zwischen Incoming Case und Case Base
	calculateSimilarityComplex() {
//		var ergebnisse = "";
//		var i;
//		for (i = 0; i < this.Cases.length; i++) {
//			var percentageValue = 0;
//			var numberSymptoms = 0;
//			var k;
//			for (k = 0; k < this.incomingCase.Symptoms.length; k++) {
//				var wij = 1;
//
//				percentageValue = percentageValue + (this.incomingCase.Symptoms[k].wert * this.Cases[i].Symptoms[k].wert * wij);
//
//				if (this.incomingCase.Symptoms[k].wert > 0) {
//					numberSymptoms += 1;
//				}
//			}
//
//			var factor = Math.pow(10, 2);
//			this.Similarities[i] = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
//			ergebnisse = ergebnisse + "<br>" + "incomingCase: " + this.incomingCase.id + " Case: " + this.Cases[i].id + " Similarity: " + this.Similarities[i];
//
//		}
		
		var ergebnisse = "";
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
				}
				else
				{
					zwischen = 0;
				}
				
				percentageValue += zwischen*1;
				

				if (this.incomingCase.Symptoms[k].wert > 0) {
					numberSymptoms += 1;
				}
			}
			var factor = Math.pow(10, 2);
			this.Similarities[i] = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
			ergebnisse = ergebnisse + "<br>" + "incomingCase: " + this.incomingCase.id + " Case: " + this.Cases[i].id + " Similarity: " + this.Similarities[i];
		}
		
		ergebnisse = ergebnisse + "<br>";
		this.loadIncomingCaseFromDB(0);
		i = 0;
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
				}
				else
				{
					zwischen = 0;
				}
				
				percentageValue += zwischen*1;
				

				if (this.incomingCase.Symptoms[k].wert > 0) {
					numberSymptoms += 1;
				}
			}
			var factor = Math.pow(10, 2);
			this.Similarities[i] = Math.round(((percentageValue * 100) / numberSymptoms) * factor) / factor;
			ergebnisse = ergebnisse + "<br>" + "incomingCase: " + this.incomingCase.id + " Case: " + this.Cases[i].id + " Similarity: " + this.Similarities[i];
		}

		$("#CBRtestfeld").html(ergebnisse);
	}
	
	calculateSimilaritySimple() {
		//this.loadIncomingCaseFromDB(0);
		var ergebnisse = "";
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
			ergebnisse = ergebnisse + "<br>" + "incomingCase: " + this.incomingCase.id + " Case: " + this.Cases[i].id + " Similarity: " + this.Similarities[i] +"%";
		}
		ergebnisse = ergebnisse + "<br>";
		$("#CBRtestfeld").html(ergebnisse);
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
		xmlhttp.open("GET", "http://141.99.248.92/Projektgruppe/php/include/getCaseValues.php", true);
		xmlhttp.send();
	}
}

$(document).ready(function () { getCasesFromDatabase("MedAusbildSS18"); });

$('#cbr').click(function () {

	var testcbr = new CBR();
	testcbr.loadAllArrays();
	testcbr.loadIncomingCase();
	testcbr.calculateSimilaritySimple();
	// testcbr.GiveCaseSymptom(0, new Symptom(1,"ollisyndrom",5));
	// alert("was da los");
	//$("#CBRtestfeld").html(testcbr.Cases[0].Symptoms[0].name + " " + testcbr.Cases[1] + " " + testcbr.incomingCase.id);

});