<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_quiz.php';
include_once 'include/getAllMembers.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
	header('Location: http://141.99.248.92/Projektgruppe/php/login.php?logged=0');	
	exit;
}
?>
<html lang="de">

<head>
    <!-- include Header -->
    <?php
    include('include/header.php');
    ?>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/style3.css" rel="stylesheet">

    <!-- animate.CSS -->
    <link rel="stylesheet" href="../css/animate.css">

    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
    <!-- _______________________________________NavBar_____________________________________________________-->
    <?php
		include ("include/navbar.php");
    ?>

	<body>

		<!--Singleplayer-->
		<div class ="col-lg-6 col-md-6 col-sm-12">
			<div class ="row">
				<?php 
					//TODO Check if already running Singleplayer game is active
					$array = activeSingleplayerGame($mysqli, $_SESSION['user_id']);
					if(!is_null($array[0]['quizID']))
					{
						echo "<form action='include/functions_quiz.php' method='post'><input type='hidden' name='continueQuiz' value='true'><input type='hidden' name='quizID' value='".$array['quizID']."'><input type='hidden' value='".$_SESSION['user_id']."' name='singpleplayerUserID'><input type='submit' value='Quiz fortsetzen'></form>";
					}
					else
					{
						echo "<form action='include/functions_quiz.php' method='post'><input type='hidden' name='startQuiz' value='true'><input type='hidden' value='".$_SESSION['user_id']."' name='singpleplayerUserID'><input type='submit' value='Quiz starten'></form>";
					}
				?>
			</div>
		</div>
		<!-- Multiplayer -->
		<div class ="col-lg-6 col-md-6 col-sm-12">

			<h3>Aktuelle Spiele</h3>
			<ul>
				<?php
					$array = showCurrentMPGames($mysqli, $_SESSION['user_id']);
					foreach($array as &$user )
					{
						$message ="";
						$buttontext ="";
						if(!is_null($user['startdatum']))
						{
							$message = "Mit ".$user['username']." weiterkämpfen<br>Spiel hat begonnen am ".$user['startdatum'];
							$buttontext = "Quiz fortführen";
						}
						else 
						{
							$message = "Sie haben das Spiel gegen ".$user['username']." noch nicht begonnen";
							$buttontext = "Quiz starten";
						}
						echo "<li>".$message."<form action='include/functions_quiz.php' method='post'><input type='hidden' name='continueQuiz' value='true'><input type='hidden' name='quizID' value='".$user['quizid']."'><input type='submit' value='".$buttontext."'></form></li>";
					}
				?>
			</ul>
			<h3>Leute die dich herausgefordert haben</h3>
			<ul>
				<?php
					$array = getAllChallenges($mysqli, $_SESSION['user_id']);
					foreach($array as &$user )
					{
						echo "<li>".$user['username']." fordert dich zum Duell heraus<form action='include/functions_quiz.php' method='post'><input type='hidden' name='newQuiz' value='true'><input type='hidden' name='challengedUserID' value='".$_SESSION['user_id']."'><input type='hidden' name='challengerUserID' value='".$user['userID1']."'><input type='submit' value='Herausforderung annehmen'></form></li>";
					}
				?>
			</ul>

			<h3>Leute die du herausfordern kannst</h3>
			<ul>
				<?php 
					$array = getAllMembers($mysqli);
					$array2 = getAlreadyChallengedUsers($mysqli, $_SESSION['user_id']);
					$array3 = getPendingChallengesUsers($mysqli, $_SESSION['user_id']);
					$array4 = showCurrentMPGames($mysqli, $_SESSION['user_id']);

					$check = 0;
					//alle nutzer
					foreach($array as &$user )
					{
						//sind wirs selber?
						if($_SESSION['user_id'] != $user['id'])
						{
							//alle von uns herausgeforderten
							foreach($array2 as &$alreadyChallengedUsers)
							{
								if($user['id'] == $alreadyChallengedUsers['userID2'])
								{
									//User schon herausgefordert
									if($check == 0)
									{
										echo "<li>".$user['username']." wurde bereits herausgefordert. Warte auf Annahme</li>";
										$check = 1;
									}
								}
								else
								{
									//Dododo
								}
							}

							foreach($array3 as &$userChallengesUs)
							{
								if($user['id'] == $userChallengesUs['userID1'])
								{
									//User schon herausgefordert
									if($check == 0)
									{
										//echo "<li>".$user['username']." hat dich bereits aufgefordert. Nimm an</li>";
										$check = 1;
									}
								}
								else
								{
									//Dododo
								}
							}

							foreach($array4 as &$userWeAreAlreadyFightingWith)
							{
								if($user['id'] == $userWeAreAlreadyFightingWith['membersid'])
								{
									//User schon herausgefordert
									if($check == 0)
									{
										//echo "<li>".$userWeAreAlreadyFightingWith['username']." hat dich bereits geraufgefordert. Nimm an</li>";
										$check = 1;
									}
								}
								else
								{
									//Dododo
								}
							}

							if($check == 0)
							{
								echo "<li>".$user['username']." herausfordern <form action='include/functions_quiz.php' method='post'><input type='hidden' name='challengeUser' value='true'><input type='hidden' name='challengerUserID' value='".$_SESSION['user_id']."'><input type='hidden' name='challengedUserID' value='".$user['id']."'><input type='submit' value='Fordere ihn heraus!'></form>";
								$check = 1;
							}
						}
						else 
						{
							// Mach nix
						}
						$check = 0;
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