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
}

?>
<!doctype html>
<html lang="de">
<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_statistik.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">

</head>

<!-- include Navbar -->
    <?php
            include ("include/navbar.php");
    ?>

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

var ctx2 = document.getElementById("Chart2").getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ["All Replies", "Your Replies"],
        datasets: [{
            label: 'Number of Replies',
            data: [<?php echo $result3['n'] ?>, <?php echo $result4['n'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
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
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
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
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
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
</script> 	
<script src="../js/jquery-2.2.2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>