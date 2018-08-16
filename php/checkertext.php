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
    <?php
    include('include/header.php');
    ?>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style3.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">

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
			<div class="col-md-offset-5 col-xs-offset-right-5 col-md-2 col-sm-12">
				<button id="btn_submit" class=" btn btn-success" type="submit" style="background-color: #1a2732;">Submit</button>
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
        });

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
        			$('#section_symptoms').append('<div id=' + 'div_impairment_' + i + ' class="row" style="max-width:90%"><br><div class="col-md-7 col-sm-3">' + cbr.incomingCase.Symptoms[i].name + '</div > <div class=" col-md-offset-2 col-md-2 col-sm-offset-2 col-sm-2 ">' + cbr.incomingCase.Symptoms[i].wert + '</div></div>');
        		}		
        	}
        	// Berechnung und Ausgabe des Ergebnisses
        	cbr.calculateSimilarityComplex();
        	$('#div_ausgabe').html(buildOutput());
        });
        </script> 	
		</div>

		<div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="pastHint" style="display:none"><b>Person info will be listed here...</b></div>
    </body>

</html>