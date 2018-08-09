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

    <link href="../css/style3.css" rel="stylesheet" />
</head>

<body>
    <?php
    include('include/navbar.php');
    ?>

    <div class="container" style="text-align: center">
        <span>
            <h2>Auswertung</h2>
        </span>
        <!--Linke Seite -- Textuelle Darstellung-->
        <div class="col-md-6 col-sm-12">
            <div class="row">
                <h3>Auswertung</h3>
                <table>
                    <tr>
                        <th>Frage</th>
                        <th>Abgegebene Antwort</th>
                        <th>Richtige Antwort</th>
                    </tr>
                    <tr>
                        <td>Frage 1</td>
                        <td>Eigene Antwort 1</td>
                        <td>Richtige Antwort 1</td>
                    </tr>
                    <tr>
                        <td>Frage 2</td>
                        <td>Eigene Antwort 2</td>
                        <td>Richtige Antwort 2</td>
                    </tr>
                    <tr>
                        <td>Frage 3</td>
                        <td>Eigene Antwort 3</td>
                        <td>Richtige Antwort 3</td>
                    </tr>
                    <tr>
                        <td>Frage 4</td>
                        <td>Eigene Antwort 4</td>
                        <td>Richtige Antwort 4</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Rechte Seite Visuelle Darstellung-->
        <div class="col-md-6 col-sm-12">
            <div class="row">

                <div class="charty">
                    <canvas id="Chart1"></canvas>
                </div>

            </div>
        </div>

        <a href="Quiz_uebersicht.php">Zurück zur Quizübersicht</a>
    </div>


   

    <!-- Scripts -->
    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/Chart.js"></script>
    <script>
                    var ctx1 = document.getElementById("Chart1").getContext('2d');
                    var myChart1 = new Chart(ctx1, {
                        type: 'pie',
                        data: {
                            labels: ["Richtige Antworten", "Falsche Antworten"],
                            datasets: [{
                                label: 'Grafische Auswertung',
                                data: [1, 3],
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
    </script>

       
</body>
</html>