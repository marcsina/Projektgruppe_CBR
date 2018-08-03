<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_quiz.php';


sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<html lang="de">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>




        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">


        <link href="../css/style3.css" rel="stylesheet">

        <!-- animate.CSS -->
        <link rel="stylesheet" href="../css/animate.css">

        <link rel="stylesheet" href="../css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    </head>
    <!-- _______________________________________NavBar_____________________________________________________-->
    <?php
		include ("include/navbar.php");
    ?>



	<body>
		
		<!--Singleplayer-->
		<div class ="col-lg-6 col-md-6 col-sm-12">
			<div class ="row">
				<button class ="btn btn-lg" value="Einzelspieler" id="singleplayerStart"/>
			</div>
		</div>
		<!-- Multiplayer -->
		<div class ="col-lg-6 col-md-6 col-sm-12">
			<ul>
				<?php 
					$array = getAllChallenges($mysqli, $_SESSION['user_id']);
					foreach($array as &$user )
					{
						echo "<li>".$user['username']." fordert dich zum Duell heraus<form action='Quiz.php' method='post'><input type='hidden' value='".$user['userID1']."'><input type='submit' value='Herausforderung annehmen'></form></li>";		
					}
				?>
			</ul>
		</div>



		<!--____________________________________________________________________________________________________-->

		<!-- Scripts -->
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
	</body>

</html>