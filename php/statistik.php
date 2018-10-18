<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
    $userid = $_SESSION['user_id'];
} else {
    $logged = 'out';
    $username = 'anonymous';
    header('Location: http://medausbild.de/php/login.php?logged=0');
    exit;
}

?>
<!doctype html>
<html lang="de">
<head>
    <?php include('include/header.php'); ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_statistik.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">
</head>
    <?php include ("include/navbar.php"); ?>
<body>
	<div class="container">
		<table style = "width: 100%;">
		
            <tr class="title">
                <td>User Statistik</td>
                <td>Forum Statistik</td>
            </tr>
            
            <tr class="content">
                <td>
    				<div class="charty">
    					<canvas id="Chart1" width="400" height="400"></canvas>
    				</div>
    			</td>
                <td>
    				<div class="charty">
    					<canvas id="Chart2" width="400" height="400"></canvas>
    				</div>
    			</td>
            </tr>
            
            <tr class="title">
                <td>Quiz Singleplayer Statistik</td>
                <td>Quiz Multiplayer Statistik</td>
            </tr>
            
            <tr class="content">
                <td>
    				<div class="charty">
    					<canvas id="Chart3" width="400" height="400"></canvas>
    				</div>
    			</td>
                <td>
    				<div class="charty">
    					<canvas id="Chart4" width="400" height="400"></canvas>
    				</div>
    			</td>
            </tr>
            
            <tr class="title">
                <td>Quiz Singleplayer richtige Antworten</td>
                <td>Quiz Multiplayer richtige Antworten</td>
            </tr>
            
            <tr class="content">
                <td>
    				<div class="charty">
    					<canvas id="Chart5" width="400" height="400"></canvas>
    				</div>
    			</td>
                <td>
    				<div class="charty">
    					<canvas id="Chart7" width="400" height="400"></canvas>
    				</div>
    			</td>
            </tr>
            
            <tr class="title">
                <td>Meist gefundene Ergebnisse im Checker</td>
                <td>Meist gelesene Artikel</td>
            </tr>
            
            <tr class="content">
                <td>
    				<div class="charty">
    					<canvas id="Chart6" width="400" height="400"></canvas>
    				</div>
    			</td>
                <td>
    				<div class="charty">
    					<canvas id="Chart8" width="400" height="400"></canvas>
    				</div>
    			</td>
            </tr>
        
    	</table>    
	</div>

<?php
//anzahl user
$value1 = $mysqli->query("SELECT COUNT(username) as n FROM members;");
$result1 = $value1->fetch_assoc();

//anzahl user die beiträge geschrieben haben
$value2 = $mysqli->query("SELECT COUNT(DISTINCT user) as n FROM Forum_Beitrag;");
$result2 = $value2->fetch_assoc();

//anzahl forumsbeiträge
$value3 = $mysqli->query("SELECT COUNT(id) as n FROM Forum_Beitrag;");
$result3 = $value3->fetch_assoc();

//anzahl eigene beiträge
$value4 = $mysqli->query("SELECT COUNT(id) as n FROM Forum_Beitrag WHERE user = '$userid';");
$result4 = $value4->fetch_assoc();

//anzahl spquiz
$value5 = $mysqli->query("SELECT COUNT(id) as n FROM SP_QUIZ;");
$result5 = $value5->fetch_assoc();

//eigene spquiz
$value6 = $mysqli->query("SELECT COUNT(id) as n FROM SP_QUIZ WHERE User_ID = '$userid';");
$result6 = $value6->fetch_assoc();

//anzahl mpquiz
$value7 = $mysqli->query("SELECT COUNT(id) as n FROM MP_QUIZ;");
$result7 = $value7->fetch_assoc();

//eigene mpquiz
$value8 = $mysqli->query("SELECT COUNT(id) as n FROM MP_QUIZ WHERE User_ID_1 = '$userid' OR User_ID_2 = '$userid';");
$result8 = $value8->fetch_assoc();

//4richtige
$value11 = $mysqli->query("Select count(A.SP_QUIZ_ID) as n FROM( SELECT SP_QUIZ_ID, count(*) as anzahl_richtig FROM `SP_FRAGE` Where given_a = 1 group by SP_QUIZ_ID) AS A Where anzahl_richtig = 4");
$result11 = $value11->fetch_assoc();

//3richtige
$value12 = $mysqli->query("Select count(A.SP_QUIZ_ID) as n FROM( SELECT SP_QUIZ_ID, count(*) as anzahl_richtig FROM `SP_FRAGE` Where given_a = 1 group by SP_QUIZ_ID) AS A Where anzahl_richtig = 3");
$result12 = $value12->fetch_assoc();

//2richtige
$value13 = $mysqli->query("Select count(A.SP_QUIZ_ID) as n FROM( SELECT SP_QUIZ_ID, count(*) as anzahl_richtig FROM `SP_FRAGE` Where given_a = 1 group by SP_QUIZ_ID) AS A Where anzahl_richtig = 2");
$result13 = $value13->fetch_assoc();

//1richtige
$value14 = $mysqli->query("Select count(A.SP_QUIZ_ID) as n FROM( SELECT SP_QUIZ_ID, count(*) as anzahl_richtig FROM `SP_FRAGE` Where given_a = 1 group by SP_QUIZ_ID) AS A Where anzahl_richtig = 1");
$result14 = $value14->fetch_assoc();

//0richtige
$value15 = $mysqli->query("SELECT count(DISTINCT SP_QUIZ_ID) as n FROM `SP_FRAGE` ");
$result15 = $value15->fetch_assoc();

//5meist checker
$value16 = $mysqli->query("select Case_ID,Cases.name as n, count(History_Checker.ID) as c from `History_Checker`, `Cases` WHERE History_Checker.Case_ID = Cases.id group by `Case_ID` order by c desc ");
$result16 = $value16->fetch_assoc();
$result162 = $value16->fetch_assoc();
$result163 = $value16->fetch_assoc();
$result164 = $value16->fetch_assoc();
$result165 = $value16->fetch_assoc();

//4richtige
$value17 = $mysqli->query("Select count(A.MP_QUIZ_ID) as n FROM( SELECT MP_QUIZ_ID, count(*) as anzahl_richtig FROM `MP_FRAGE` Where Given_A1 = 1 or Given_A2 = 1 group by MP_QUIZ_ID) AS A Where anzahl_richtig = 4");
$result17 = $value17->fetch_assoc();

//3richtige
$value18 = $mysqli->query("Select count(A.MP_QUIZ_ID) as n FROM( SELECT MP_QUIZ_ID, count(*) as anzahl_richtig FROM `MP_FRAGE` Where Given_A1 = 1 or Given_A2 = 1 group by MP_QUIZ_ID) AS A Where anzahl_richtig = 3");
$result18 = $value18->fetch_assoc();

//2richtige
$value19 = $mysqli->query("Select count(A.MP_QUIZ_ID) as n FROM( SELECT MP_QUIZ_ID, count(*) as anzahl_richtig FROM `MP_FRAGE` Where Given_A1 = 1 or Given_A2 = 1 group by MP_QUIZ_ID) AS A Where anzahl_richtig = 2");
$result19 = $value19->fetch_assoc();

//1richtige
$value20 = $mysqli->query("Select count(A.MP_QUIZ_ID) as n FROM( SELECT MP_QUIZ_ID, count(*) as anzahl_richtig FROM `MP_FRAGE` Where Given_A1 = 1 or Given_A2 = 1 group by MP_QUIZ_ID) AS A Where anzahl_richtig = 1");
$result20 = $value20->fetch_assoc();

//0richtige
$value21 = $mysqli->query("SELECT count(DISTINCT MP_QUIZ_ID) as n FROM `MP_FRAGE` ");
$result21 = $value21->fetch_assoc();

//5meist Artikel
$value22 = $mysqli->query("select History_Article.ID,Artikel.Titel as n, count(History_Article.ID) as c from `History_Article`, `Artikel` WHERE History_Article.Article_ID = Artikel.id group by `Article_ID` order by c desc ");
$result22 = $value22->fetch_assoc();
$result222 = $value22->fetch_assoc();
$result223 = $value22->fetch_assoc();

?>

<script src="../js/Chart.js"></script>
<script>
var ctx1 = document.getElementById("Chart1").getContext('2d');
var myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ["Registered Users", "Active Users"],
        datasets: [{
            label: 'Number of Users',
            data: [<?php echo $result1['n'] ?>, <?php echo $result2['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)'
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

var ctx2 = document.getElementById("Chart2").getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ["All Replies", "Your Replies"],
        datasets: [{
            label: 'Number of Replies',
            data: [<?php echo $result3['n'] ?>, <?php echo $result4['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
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

var ctx3 = document.getElementById("Chart3").getContext('2d');
var myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ["All SP Quiz", "Your SP Quiz"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $result5['n'] ?>, <?php echo $result6['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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

var ctx4 = document.getElementById("Chart4").getContext('2d');
var myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: ["All MP Quiz", "Your MP Quiz"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $result7['n'] ?>, <?php echo $result8['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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

var ctx5 = document.getElementById("Chart5").getContext('2d');
var myChart5 = new Chart(ctx5, {
    type: 'pie',
    data: {
        labels: ["4 richtig","3 richtig","2 richtig","1 richtig","0 richtig"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $result11['n'] ?>, <?php echo $result12['n'] ?>, <?php echo $result13['n'] ?>, <?php echo $result14['n'] ?>, <?php echo $result15['n']-$result14['n']-$result13['n']-$result12['n']-$result11['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    }
});

var ctx7 = document.getElementById("Chart7").getContext('2d');
var myChart7 = new Chart(ctx7, {
    type: 'pie',
    data: {
        labels: ["4 richtig","3 richtig","2 richtig","1 richtig","0 richtig"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $result17['n'] ?>, <?php echo $result18['n'] ?>, <?php echo $result19['n'] ?>, <?php echo $result20['n'] ?>, <?php echo $result21['n']-$result20['n']-$result19['n']-$result18['n']-$result17['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    }
});

var ctx6 = document.getElementById("Chart6").getContext('2d');
var myChart6 = new Chart(ctx6, {
    type: 'pie',
    data: {
        labels: ["<?php echo $result16['n'] ?>","<?php echo $result162['n'] ?>","<?php echo $result163['n'] ?>","<?php echo $result164['n'] ?>","<?php echo $result165['n'] ?>"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $result16['c'] ?>, <?php echo $result162['c'] ?>, <?php echo $result163['c'] ?>, <?php echo $result164['c'] ?>, <?php echo $result165['c'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    }
});

var ctx8 = document.getElementById("Chart8").getContext('2d');
var myChart8 = new Chart(ctx8, {
    type: 'pie',
    data: {
        labels: ["<?php echo $result22['n'] ?>","<?php echo $result222['n'] ?>","<?php echo $result223['n'] ?>"],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $result22['c'] ?>, <?php echo $result222['c'] ?>, <?php echo $result223['c'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)',
                'rgba(255, 159, 64, 0.6)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    }
});
</script> 	
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>