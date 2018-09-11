 <?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include     'include/functions_history.php';


sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
    //insert_Activity_Checker($mysqli, $_SESSION['user_id'], "Text Checker");
} else {
    $logged = 'out';
    header('Location: http://141.99.248.104/php/login.php?logged=0');
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
                <tr class="title">
                    <td style = "width: 50%">Ihr Text</td>
                    <td style = "width: 50%">Gefundene Symptome</td>
                </tr>
                
                <tr class="content">
                    <td>
						<section class ="tableau">
							<textarea class="textar" id="textarea_eingabe" name="textarea_eingabe" style = "width: 100%;height:100%;" ></textarea>
						</section>
        			</td>
                    <td>
        				<section id="section_symptoms" class="tableau" style = "color: #ffffff"></section>
        			</td>
                </tr>
    		</table> 
    		
    		<!-- Button row -->
			<div id="buttonrow" class="col-sm-12">
				<button id="btn_submit" class="btn btn-success btn_text" type="submit" >Submit</button>
				<button id="btn_anpassen" class="btn btn-success btn_text" style="display:none" type="submit" >Anpassen</button>
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
			<div class="row newRow">
				<h4 class="col-md-offset-3 col-md-1 col-sm-1">Resultat</h4>		
			</div>
			<!-- Result row -->
			<div class="row">
				<section class="col-md-offset-3 col-md-6 col-sm-12 col-xs-offset-right-3 tableau2">
					<div class="result" id='div_ausgabe'></div>
				</section>			
			</div>	

        <!-- Scripts -->
        <script src="../js/Chart.js"></script>
        <script src="../js/german-porter-stemmer.js"></script>
        <script src="../js/stopWords.js"></script>
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/text_analyse.js"></script>
		<script src="../js/CBR.js"></script>
		<script src="../js/snowball-german.js"></script>
        <script>
        $(document).ready(function () {
        	cbr.loadIncomingCase("no name", "no text");
			setVisualLayout();
        });

        var ctx1 = document.getElementById("Chart").getContext('2d');
		var myChart1;       

		function setVisualLayout() {
			myChart1 = new Chart(ctx1, {
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
		}
        
        function buildOutput() {
        	/*var ausgabe = $("#div_ausgabe").text();*/
            var ausgabe ="<p>";
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

			/////////////////////////// BUG FIX ECKE
			/*var check1 = "";
			var check2 = "";

			for(i = 0; i < cbr.Cases.length; i++) {
				check2 = check2 + "Caseid: " + cbr.Cases[i].id + " ||| Arraylength: " + cbr.Cases[i].Symptoms.length + "\n";
			}
			alert(check2);

			for(i = 0; i < cbr.incomingCase.Symptoms.length; i++)
			{
				if(cbr.incomingCase.Symptoms[i].wert > 0) {
					check1 = check1 + "ID: " + cbr.incomingCase.Symptoms[i].id + " ||| Name: " + cbr.incomingCase.Symptoms[i].name + " ||| Wert: " + cbr.incomingCase.Symptoms[i].wert + "\n";
				}
			}
			//alert(check1);*/
        	///////////////////////////
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
        	
            ausgabe =ausgabe+"</p>";
        	return ausgabe;
        }

        $('#btn_submit').click(function () {
        	// Filtern der Symptome und �bergabe an CBR


			$('#section_symptoms').html("");
        	var text = $('#textarea_eingabe').val();
        	var kategorieAusTextArray = new Array();

        	try {
				kategorieAusTextArray = extractKeywords(text);
			}
			catch(error) {
				if($('#btn_anpassen').is(":visible")) {
					$('#btn_anpassen').hide();
				}
				alert("Bitte geben sie einen korrekten Text ein.\n\n" + "Fehlermeldung: " + error);
				myChart1.destroy();
				setVisualLayout();
				return;
			}
			
        	var i;
        	for (i = 0; i < kategorieAusTextArray.length; i++) {
        		if (isNaN(kategorieAusTextArray[i].weight)) {
        			// mach nix
					//
					if($('#btn_anpassen').is(":visible")) {
						$('#btn_anpassen').hide();						
					}
        		}
        		else {
        			
					
					const index = cbr.incomingCase.Symptoms.map(e => e.id).indexOf(kategorieAusTextArray[i].katID);
					cbr.incomingCase.Symptoms[index].wert = kategorieAusTextArray[i].weight;
				
					
					if($('#btn_anpassen').is(":hidden")) {
						$('#btn_anpassen').show();
					}  

        		}
        	}
		

			
        	// Anzeigen der gefilterten Symptome
        	for (i = 0; i < cbr.incomingCase.Symptoms.length; i++) {   		
				if (cbr.incomingCase.Symptoms[i].wert > 0) {
					if(cbr.incomingCase.Symptoms[i].wert > 0.3 && cbr.incomingCase.Symptoms[i].wert < 0.8) {
						$('#section_symptoms').append('<div id=' + 'div_impairment_' + cbr.incomingCase.Symptoms[i].id + ' class="symptom row"><div class="col-md-6 col-sm-6">' + cbr.incomingCase.Symptoms[i].id + ': ' + cbr.incomingCase.Symptoms[i].name + '</div > <div class="col-md-5 col-sm-5"><label id=' + 'lbl_mittel_' + cbr.incomingCase.Symptoms[i].id + ' class="mittelChecked">Mittel</label></div></div>');
					}
					else if(cbr.incomingCase.Symptoms[i].wert >= 0.8) {
						$('#section_symptoms').append('<div id=' + 'div_impairment_' + cbr.incomingCase.Symptoms[i].id + ' class="symptom row"><div class="col-md-6 col-sm-6">' + cbr.incomingCase.Symptoms[i].id + ': ' + cbr.incomingCase.Symptoms[i].name + '</div > <div class="col-md-5 col-sm-5"><label id=' + 'lbl_hoch_' + cbr.incomingCase.Symptoms[i].id + ' class="hochChecked">Hoch</label></div></div>');
					}
					else {
						$('#section_symptoms').append('<div id=' + 'div_impairment_' + cbr.incomingCase.Symptoms[i].id + ' class="symptom row"><div class="col-md-6 col-sm-6">' + cbr.incomingCase.Symptoms[i].id + ': ' + cbr.incomingCase.Symptoms[i].name + '</div > <div class="col-md-5 col-sm-5"><label id=' + 'lbl_klein_' + cbr.incomingCase.Symptoms[i].id + ' class="niedrigChecked">Niedrig</label></div></div>');
					}
					//$('#section_symptoms').append('<div id=' + 'div_impairment_' + cbr.incomingCase.Symptoms[i].id + ' class="symptom row"><div class="col-md-6 col-sm-6">' + parseInt(cbr.incomingCase.Symptoms[i].id * 1 + 1 * 1) + ': ' + cbr.incomingCase.Symptoms[i].name + '</div > <div class="col-md-5 col-sm-5 btn-group" data-toggle="buttons"><button id=' + 'btn_klein_' + cbr.incomingCase.Symptoms[i].id + ' class="btn btn-info btn-sm impairmentbutton">klein</button><button id=' + 'btn_mittel_' + cbr.incomingCase.Symptoms[i].id + ' class="btn btn-warning btn-sm impairmentbutton">mittel</button><button id=' + 'btn_hoch_' + cbr.incomingCase.Symptoms[i].id + ' class="btn btn-danger btn-sm impairmentbutton">hoch</button></div> <div class=" col-md-1"> <button type="button" id=' + 'btn_close_' + cbr.incomingCase.Symptoms[i].id + ' class="close btn btn-info xbutton">x</button></div></div>');
        			//$('#section_symptoms').append('<div id=' + 'div_impairment_' + i + ' class="row" style="max-width:90%"><br><div class="col-md-7 col-sm-3">' + cbr.incomingCase.Symptoms[i].name + '</div > <div class=" col-md-offset-2 col-md-2 col-sm-offset-2 col-sm-2 ">' + cbr.incomingCase.Symptoms[i].wert + '</div></div>');
        		}	
				
        	}
				
        	// Berechnung und Ausgabe des Ergebnisses
        	cbr.calculateSimilarityComplex();
        	$('#div_ausgabe').append(buildOutput());
			// Neuen Incoming Case erstellen für nächsten Durchlauf
			cbr.loadIncomingCase("no name", "no text");
        });


		$('#btn_anpassen').click(function () {	
			var symptomArray = [];
			var i;
			for(i = 0; i < cbr.incomingCase.Symptoms.length; i++) {
				if(cbr.incomingCase.Symptoms[i].wert > 0) {
					symptomArray.push(cbr.incomingCase.Symptoms[i]);
					
				}
			}
			
			if(symptomArray.length > 0) {
				window.localStorage.setItem("ICSymptoms", JSON.stringify(symptomArray));
				window.location.href = "http://141.99.248.104/php/checker_symptom.php";
			}
			else {
				alert("Mindestens ein Symptom muss gefunden werden");
			}
		});
		

			


        //Function to insert Data to the CheckerHistory-----------------------------------------
        function insertCheckerHistory(id1, value1)
        {
            $.post('include/functions_history.php',
            {
                function: "Insert_Activity_Checker",
                id: id1,
                type: "Text Checker",
                value: value1
            });
        }
        //----------------------------------------------------------------------------------------

        </script> 	
		</div>

		<div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="pastHint" style="display:none"><b>Person info will be listed here...</b></div>
    </body>

</html>