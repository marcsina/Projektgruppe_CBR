﻿ <?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
//include_once 'include/functions_history.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
    //insert_Activity_Checker($mysqli, $_SESSION['user_id'], "Symptom Checker");
} else {
    $logged = 'out';
    header('Location: http://medausbild.de/php/login.php?logged=0');
    exit;
}
?>
<html lang="en">


<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style3.css" rel="stylesheet">
    <link href="../css/style_autocomplete.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">
	<link href="../css/style_checker.css" rel="stylesheet">

</head>
	<!-- _______________________________________NavBar_____________________________________________________-->
	 <?php
        include ("include/navbar.php");
     ?>

    <body id="home">
       
        <!-- _________________________Content________________________________-->
		<div class="container">


		<table style = "width: 100%;">		
                <tr >
                    <td class="title" style="width: 50%" bgcolor="#1a2732">
                        <br />
                        <div class="col-md-3">
                            Symptome
                        </div>
                        <div class="col-md-9">
                            <form autocomplete="off">
                                <input type="text" name="suche" id="input_category" placeholder="Suchen" class="form-control " value="" />
                            </form>
                        </div>
                    </td>
                    <td style = "width: 50%" class="title">Gewählte Symptome</td>
                </tr>
                
                <tr class="content">
                    <td>
						<section class ="tableau">
							<form id="form_symptoms" style = "color: #ffffff;"></form>
						</section>
        			</td>
                    <td>
        				<section id="section_symptoms" class="tableau" style = "color: #ffffff;"></section>
        			</td>
                </tr>
    		</table> 
    		
    		<!-- Button row -->
			<div id="btn_submit_div">
				<button id="btn_submit" class="btn_text btn btn-success" type="submit">Submit</button>
			</div>
			
    		<br>
    		<br>
    		
    		<table style = "width: 100%;">
                <tr class="title">
                    <td style = "width: 100%">Resultat</td>
                </tr>                
                <tr class="content">
                    <td>
        					<canvas id="Chart" ></canvas>
        			</td>
                </tr>       
    		</table>  

			<!-- 2nd Header Row -->
			<div class="row" id="div_h4" style='display: none'>
				<h4>Resultat</h4>		
			</div>
			<!-- Result row -->
			<div class="row" style='display: none'>
				<section class="col-md-offset-3 col-md-6 col-sm-12 col-xs-offset-right-3 tableau2">
					<div class="result" id='div_ausgabe' ></div>
				</section>			
			</div>	

        <!--____________________________________________________________________________________________________-->
        <!-- Scripts -->
        <script src="../js/Chart.js"></script>
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
		<script src="../js/CBR.js"></script>
        <script src="../js/jquery-2.2.2.min.js"></script>
		<script>
		$(document).ready(function () {
			var textSymptoms = JSON.parse(window.localStorage.getItem("ICSymptoms")); // Retrieving
			cbr.loadIncomingCase("no name", "no text");
			setAnzeigeNummern();
			loadSymptoms();
			autocomplete(document.getElementById("input_category"), makeCategoryNamesArray());
			
			if(textSymptoms !== null) {
				var i;
				for (i = 0; i < textSymptoms.length; i++) {
					const index = cbr.incomingCase.Symptoms.map(e => e.id).indexOf(textSymptoms[i].id);
					cbr.incomingCase.Symptoms[index].wert = textSymptoms[i].wert;
					$('#' + 'checkbox_' + cbr.incomingCase.Symptoms[index].anzeigeNummer).click();
				}
				localStorage.clear();
			}
		});

		var autocompleteVariableCheck = 0;

		var ergebnis = new Array();
		var ctx1 = document.getElementById("Chart").getContext('2d');
        var myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ["","","",""],
                datasets: [{
                    label: 'Results in %',
                    data: [0,0,0,0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

		function setAnzeigeNummern() {
			var i;
			for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
				//TO-DO: Beschreibungen der Symptome in Datenbank einf�gen
				cbr.incomingCase.Symptoms[i].anzeigeNummer = i+1;
			}
		}
        
		function loadSymptoms() {		
			var i;
			for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
				//TO-DO: Beschreibungen der Symptome in Datenbank einf�gen
				$('#form_symptoms').append('<div id=' + 'div_' + cbr.incomingCase.Symptoms[i].anzeigeNummer + ' class="row symptom"><label class="col-md-11" style="word-wrap:break-word;max-width:90%">' + cbr.incomingCase.Symptoms[i].anzeigeNummer + ': ' + cbr.incomingCase.Symptoms[i].name + '</label><input class="checkboxes" type="checkbox" name="1" id=' + 'checkbox_' + cbr.incomingCase.Symptoms[i].anzeigeNummer + '></div>');
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
        	var t1 = "";
        	var t2 = "";
        	var t3 = ""; 
        	var t4 = ""; 
        	var t5 = "";
        	var p1 = 0;
        	var p2 = 0;
        	var p3 = 0; 
        	var p4 = 0; 
        	var p5 = 0; 
        	
        	for (i = 0; i < cbr.Similarities.length; i++) {
        		ausgabe = ausgabe + "Case " + cbr.Similarities[i].id + " - " + cbr.Similarities[i].name + ": " + cbr.Similarities[i].similarity + "%<br>";
        		if(i == 0)
    			{
        			t1 = cbr.Similarities[i].name;
                    p1 = cbr.Similarities[i].similarity;

                    //Insert highest similarity into historyChecker
                    insertCheckerHistory(cbr.Similarities[i].id, p1);
    			}
    			if(i == 1)
    			{
    				t2 = cbr.Similarities[i].name;
    				p2 = cbr.Similarities[i].similarity;
    			}
    			if(i == 2)
    			{
    				t3 = cbr.Similarities[i].name;
    				p3 = cbr.Similarities[i].similarity;
    			}
    			if(i == 3)
    			{
    				t4 = cbr.Similarities[i].name;
    				p4 = cbr.Similarities[i].similarity;
    			}
    			if(i == 4)
    			{
    				t5 = cbr.Similarities[i].name;
    				p5 = cbr.Similarities[i].similarity;
    			}
        	}
			myChart1.destroy();
            myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: [t1,t2,t3,t4],
                    datasets: [{
                        label: 'Results in %',
                        data: [p1,p2,p3,p4],
                        backgroundColor: [
                        	'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ],
                        borderColor: [
                        	'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        	
        	return ausgabe;
        }

		$('#btn_submit').click(function () {	
			var i;
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

		// Wird ausgef�hrt beim Anklicken einer Checkbox
		$('body').on('click', '.checkboxes', function () {
			var clickedBtnID = $(this).attr('id');
			var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");
			
			if(autocompleteVariableCheck == 1) {
				return;
			}

			if ($("#" + clickedBtnID).is(':checked')) {
				// checked


				$('#section_symptoms').append('<div id=' + 'div_impairment_' + idOhnePrefix + ' class="symptom row" style="max-width:90%"><div class="col-md-6 col-sm-6">' + idOhnePrefix + ': ' + cbr.incomingCase.Symptoms[idOhnePrefix-1].name + '</div > <div class="col-md-5 col-sm-5 btn-group" data-toggle="buttons"><button id=' + 'btn_klein_' + idOhnePrefix + ' class="impairmentbutton">klein</button><button id=' + 'btn_mittel_' + idOhnePrefix + ' class="impairmentbutton">mittel</button><button id=' + 'btn_hoch_' + idOhnePrefix + ' class="impairmentbutton">hoch</button></div> <div class=" col-md-1"> <button type="button" id=' + 'btn_close_' + idOhnePrefix + ' class="close btn btn-info xbutton">x</button></div></div>');
				// Standardwerte setzen
				
				if(cbr.incomingCase.Symptoms[idOhnePrefix-1].wert > 0) {
					/*

					BRAUCHT UNBEDINGT ÜBERARBEITUNG DA FEHLERHAFT
					AKTUELL WERTE VON TEXT ÜBERSCHRIEBEN MIT STANDARDWERTEN

					TO-DO:
					ANZEIGEN DER GEDRÜCKTEN BUTTON VIA CSS KLASSEN

					
		$('#' + 'btn_mittel_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');
		$('#' + 'btn_hoch_' + idOhnePrefix).removeClass('CSSRemoveButtonSelected');

					*/

					if(cbr.incomingCase.Symptoms[idOhnePrefix-1].wert > 0.8) {
						$('#' + 'btn_klein_' + idOhnePrefix).addClass('niedrigUnchecked');
						$('#' + 'btn_mittel_' + idOhnePrefix).addClass('mittelUnChecked');
						$('#' + 'btn_hoch_' + idOhnePrefix).addClass('hochChecked');
					}
					else if(cbr.incomingCase.Symptoms[idOhnePrefix-1].wert > 0.3 && cbr.incomingCase.Symptoms[idOhnePrefix-1].wert < 0.8) {
						$('#' + 'btn_klein_' + idOhnePrefix).addClass('niedrigUnchecked');
						$('#' + 'btn_mittel_' + idOhnePrefix).addClass('mittelChecked');
						$('#' + 'btn_hoch_' + idOhnePrefix).addClass('hochUnchecked');
					}
					else {
						$('#' + 'btn_klein_' + idOhnePrefix).addClass('niedrigChecked');
						$('#' + 'btn_mittel_' + idOhnePrefix).addClass('mittelUnchecked');
						$('#' + 'btn_hoch_' + idOhnePrefix).addClass('hochUnchecked');
					}
				}
				else {
					$('#' + 'btn_klein_' + idOhnePrefix).click();
				}
				
			}
			else {
				// unchecked
				$('#' + 'div_impairment_' + idOhnePrefix).remove();
				cbr.incomingCase.Symptoms[idOhnePrefix-1].wert = 0;
			}	


		});



		// Wird ausgef�hrt beim anklicken eines Buttons zur Angabe der St�rke eines Symptoms
		$('body').on('click', 'button.impairmentbutton', function () {
			var clickedBtnID = $(this).attr('id');
			var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");

			if (clickedBtnID.includes("klein")) {
				cbr.incomingCase.Symptoms[idOhnePrefix-1].wert = 0.3;

				$('#' + 'btn_klein_' + idOhnePrefix).removeClass('niedrigUnchecked');
				$('#' + 'btn_mittel_' + idOhnePrefix).removeClass('mittelChecked');
				$('#' + 'btn_hoch_' + idOhnePrefix).removeClass('hochChecked');

				$('#' + 'btn_klein_' + idOhnePrefix).addClass('niedrigChecked');
				$('#' + 'btn_mittel_' + idOhnePrefix).addClass('mittelUnchecked');
				$('#' + 'btn_hoch_' + idOhnePrefix).addClass('hochUnchecked');
			}
			if (clickedBtnID.includes("mittel")) {
				cbr.incomingCase.Symptoms[idOhnePrefix-1].wert = 0.6;

				$('#' + 'btn_klein_' + idOhnePrefix).removeClass('niedrigChecked');
				$('#' + 'btn_mittel_' + idOhnePrefix).removeClass('mittelUnchecked');
				$('#' + 'btn_hoch_' + idOhnePrefix).removeClass('hochChecked');

				$('#' + 'btn_klein_' + idOhnePrefix).addClass('niedrigUnchecked');
				$('#' + 'btn_mittel_' + idOhnePrefix).addClass('mittelChecked');
				$('#' + 'btn_hoch_' + idOhnePrefix).addClass('hochUnchecked');
			}
			if (clickedBtnID.includes("hoch")) {
				cbr.incomingCase.Symptoms[idOhnePrefix-1].wert = 0.9;

				$('#' + 'btn_klein_' + idOhnePrefix).removeClass('niedrigChecked');
				$('#' + 'btn_mittel_' + idOhnePrefix).removeClass('mittelChecked');
				$('#' + 'btn_hoch_' + idOhnePrefix).removeClass('hochUnchecked');

				$('#' + 'btn_klein_' + idOhnePrefix).addClass('niedrigUnchecked');
				$('#' + 'btn_mittel_' + idOhnePrefix).addClass('mittelUnchecked');
				$('#' + 'btn_hoch_' + idOhnePrefix).addClass('hochChecked');
			}

			// TO-DO: Buttondesign anpassen
		});

		// X Button Rechte Seite
            $('body').on('click', 'button.xbutton', function ()
            {
			var clickedBtnID = $(this).attr('id');
			var idOhnePrefix = clickedBtnID.replace(/.*_/g, "");
			// Symtom aus Liste entfernen
			$('#div_impairment_' + idOhnePrefix).remove();
			// Entsprechende Checkbox auf "unchecked" setzen
			$("#checkbox_" + idOhnePrefix).prop("checked", false);
			// Symptom Wert auf 0 setzen
			cbr.incomingCase.Symptoms[idOhnePrefix-1].wert = 0;

            });




            //Function to insert Data to the CheckerHistory-----------------------------------------
            function insertCheckerHistory(id1, value1)
            {
                $.post('include/functions_history.php',
                {
                    function: "Insert_Activity_Checker",
                    id: id1,
                    type: "Symptom Checker",
                    value: value1
                });
            }
            //----------------------------------------------------------------------------------------
        </script> 	
        <script src="../js/Checker_Checkboxes_autocomplete.js"></script>
        
		</div>
    </body>

</html>