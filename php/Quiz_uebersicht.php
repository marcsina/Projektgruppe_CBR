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
				<button class ="btn btn-lg" value="Einzelspieler" id="singleplayerStart"/>
			</div>
		</div>
		<!-- Multiplayer -->
		<div class ="col-lg-6 col-md-6 col-sm-12">
			<h3>Leute die dich herausgefordert haben</h3>
			<ul>
				<?php
					$array = getAllChallenges($mysqli, $_SESSION['user_id']);
					foreach($array as &$user )
					{
						echo "<li>".$user['username']." fordert dich zum Duell heraus<form action='Quiz.php' method='post'><input type='hidden' value='".$user['userID1']."'><input type='submit' value='Herausforderung annehmen'></form></li>";
					}
				?>
			</ul>

			<h3>Leute die du herausfordern kannst</h3>
			<ul>
				<?php 
					$array = getAllMembers($mysqli);
					$array2 = getAlreadyChallengedUsers($mysqli, $_SESSION['user_id']);
					$array3 = getPendingChallengesUsers($mysqli, $_SESSION['user_id']);

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
										echo "<li>".$user['username']."//".$user['id']." wurde bereits herausgefordert. Warte auf Annahme</li>";
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
										echo "<li>".$user['username']."//".$user['id']."hat dich bereits geraufgefordert. Nimm an</li>";
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
								echo "<li>".$user['username']."//".$user['id']." herausfordern <button onclick='memberButtonClicked(".$_SESSION['user_id']." ,".$user['id'].")'>Fordere Ihn heraus</button></li>";
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
		<script src="../js/Quiz_ubersicht.js"></script>
	</body>

</html>