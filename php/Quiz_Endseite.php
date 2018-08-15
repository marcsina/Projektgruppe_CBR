<?php
include_once 'include/conn.php';
include_once 'include/functions_quiz.php';

sec_session_start();

?>

<html lang="de">
<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />

    <link href="../css/Quiz_Endseite.css" rel="stylesheet" />
</head>

<body>
    <?php
    include('include/navbar.php');
    ?>

    <div class="container" style="text-align: center">
        <h2>Eigene Auswertung</h2>
        <!--Player 1-->
        <div class="row">
            <!--Linke Seite -- Textuelle Darstellung-->
            <div class="col-md-6 col-sm-12">
                <?php
				$array = getEndData($mysqli, $_SESSION['type'], $_SESSION['quiz_id'], $_SESSION['player']);
				echo "
				<table class='QuizEndTable'>
					<tr>
						<th>Frage</th>
						<th>Abgegebene Antwort</th>
						<th>Richtige Antwort</th>
					</tr>
				";
                $count = 0;
                debug_to_console("COUNT ARRAY".count($array));
				foreach($array as &$data)
				{
                    if($data['type'] == 0)
                    {
                        $questionString = "stark";
                    }
                    else if($data['type'] == 1)
                    {
                        $questionString = "schwach";
                    }
                    $Question = "Was ist ein ".$questionString." ausgeprägtes Symptom in dem Fall ".$data['casename']."?";

                    debug_to_console("GIVEN A //  ".$data['givenA']);
                    switch($data['givenA'])
                    {
                        case 1:
                            $answer = $data['answer1'];
                            $count++;
                            break;
                        case 2:
                            $answer = $data['answer2'];
                            break;
                        case 3:
                            $answer = $data['answer3'];
                            break;
                        case 4:
                            $answer = $data['answer4'];
                            break;
                        default:
                            $answer = "DB Fehler";
                            break;
                    }

					echo "
					<tr>
						<td>".$Question."</td>
						<td>".$answer."</td>
						<td>".$data['answer1']."</td>
					</tr>
					";
				}
				echo "</table>";
                ?>
            </div>

            <!-- Rechte Seite Visuelle Darstellung-->
            <div class="col-md-6 col-sm-12">

                <div class="charty">
                    <canvas id="Chart1"></canvas>
                </div>
            </div>

        </div>


        <!--Player 2 -->        
        <?php $secondPlayerArray = get2ndPlayerData($mysqli, $_SESSION['type'], $_SESSION['quiz_id'], $_SESSION['player']);
			if (count($secondPlayerArray)>0)
			{
				echo"<h2>Antworten von ".$secondPlayerArray[0]['opponentUsername']."</h2>";
			}    
		?>      
        <div class="row" <?php if (count($secondPlayerArray)==0){ echo "style='display:none;'"; } ?>>
			<div class="col-md-6 col-sm-12">
                <?php
				echo "

				<table class='QuizEndTable'>
					<tr>
						<th>Frage</th>
						<th>Abgegebene Antwort</th>
						<th>Richtige Antwort</th>
					</tr>
				";
                $countSecondPlayer = 0;
                debug_to_console("COUNT ARRAY".count($secondPlayerArray));
				foreach($secondPlayerArray as &$data)
				{
                    if($data['type'] == 0)
                    {
                        $questionString = "stark";
                    }
                    else if($data['type'] == 1)
                    {
                        $questionString = "schwach";
                    }
                    $Question = "Was ist ein ".$questionString." ausgeprägtes Symptom in dem Fall ".$data['casename']."?";

                    debug_to_console("GIVEN A //  ".$data['givenA']);
                    switch($data['givenA'])
                    {
                        case 1:
                            $answer = $data['answer1'];
                            $countSecondPlayer++;
                            break;
                        case 2:
                            $answer = $data['answer2'];
                            break;
                        case 3:
                            $answer = $data['answer3'];
                            break;
                        case 4:
                            $answer = $data['answer4'];
                            break;
                        default:
                            $answer = "DB Fehler";
                            break;
                    }

					echo "
					<tr>
						<td>".$Question."</td>
						<td>".$answer."</td>
						<td>".$data['answer1']."</td>
					</tr>
					";
				}
				echo "</table>";
                ?>
            </div>

            <!-- Rechte Seite Visuelle Darstellung-->
            <div class="col-md-6 col-sm-12">

                <div class="charty">
                    <canvas id="Chart2"></canvas>
                </div>
            </div>
        </div>
        
        

        <a href="Quiz_uebersicht.php">
            <button class="btn">Zurück zur Quizübersicht</button>
        </a>
    </div>




    <!-- Scripts -->
    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/Chart.js"></script>
    <script>
        var ctx1 = document.getElementById( "Chart1" ).getContext( '2d' );
        var myChart1 = new Chart( ctx1, {
            type: 'doughnut',
            data: {
                labels: ["Richtige Antworten", "Falsche Antworten"],
                datasets: [{
                    label: 'Grafische Auswertung',
                    data: [<?php echo $count;?>,<?php echo count($array)-$count;?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
						'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
						'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            /*options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }*/
        } );

        var ctx2 = document.getElementById( "Chart2" ).getContext( '2d' );
        var myChart2 = new Chart( ctx2, {
            type: 'doughnut',
            data: {
                labels: ["Richtige Antworten", "Falsche Antworten"],
                datasets: [{
                    label: 'Grafische Auswertung',
                    data: [<?php echo $countSecondPlayer;?>, <?php echo count($secondPlayerArray)-$countSecondPlayer;?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
						'rgba(255,99,132,1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            }});
    </script>
</body>
</html>