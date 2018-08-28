<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_quiz.php';
include_once 'include/getAllFriends.php';

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
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
	<link href="../css/style_autocomplete.css" rel="stylesheet">
    <link href="../css/style3.css" rel="stylesheet" />
    <link href="../css/Quiz_uebersicht.css" rel="stylesheet" />

    <!-- animate.CSS -->
    <!--<link rel="stylesheet" href="../css/animate.css" />

    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
</head>
<!-- _______________________________________NavBar_____________________________________________________-->
<?php
include ("include/navbar.php");
?>

<body>
    <div class="container">
        <!--Singleplayer-->
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="row">

                <h2 class="opt" style="font-size: 30px; font-family: arial, Helvetica, sans-serif; font-style: italic; text-align: center; font-weight: bold;"> Singleplayer </h2>
                <p style="text-align: center; font-style: italic; font-size: 20px; font-weight: 300;">
                    Quiz von
                    <b>Demenz</b> fortführen
                </p>
                <div style="text-align: center;">
                    <?php
            //TODO Check if already running Singleplayer game is active
            $array = activeSingleplayerGame($mysqli, $_SESSION['user_id']);
            if(!is_null($array[0]['quizID']))
            {
                echo "<form action='include/functions_quiz.php' method='post'>
                        <input type='hidden' name='continueQuiz' value='true'>
                        <input type='hidden' name='quizID' value='".$array[0]['quizID']."'>
                        <input type='hidden' value='".$_SESSION['user_id']."' name='singpleplayerUserID'>
                        <input class='btn-uebersicht btn-uebersicht-green' type='submit' value='Quiz fortsetzen'>
                    </form>";
            }
            else
            {
                echo "<form action='include/functions_quiz.php' method='post'>
                        <input type='hidden' name='startQuiz' value='true'>
                        <input type='hidden' value='".$_SESSION['user_id']."' name='singpleplayerUserID'>
                        <input class='btn-uebersicht btn-uebersicht-green' type='submit' value='Quiz starten'>
                    </form>";
            }
                    ?>
                    </div>
                </div>
        </div>

        <!-- Multiplayer -->
        <div class="col-lg-6 col-md-6 col-sm-12" style="border-left: 1px solid #ddd;">
            <div class="row">
                <h1 class="opt" style="font-size: 30px; font-family: arial, Helvetica, sans-serif; font-style: italic; text-align: center; font-weight: bold;"> Multiplayer</h1>
                


				<div class=" col-lg-12 col-md-12 col-sm-12">
                    <?php
						$array = showCurrentMPGames($mysqli, $_SESSION['user_id']);
						$count = 0;

						if(count($array)>0)
						{
							echo "
								<h3 class='multip' style='text-align: center;'>
									<b>
										<u>Aktuelle Spiele</u>
									</b>
								</h3>
								<table class='table table-striped'>
									<thead>
										<tr>
											<th scope='col'>#</th>
											<th scope='col'>Benutzername</th>
											<th scope='col'></th>
											<th scope='col'>Status</th>
										</tr>
									</thead>
									<tbody>
							";

							foreach($array as &$user )
							{
								$playernumber = getCurrentPlayerID($mysqli, $user['quizid'], $_SESSION['user_id']);
								$message ="";
								$buttontext ="";
								$checkStarted = 0;
								if(!is_null($user['startdatum']))
								{
									if($user['status_user_1'] == 0 && $playernumber == 1)
									{
										 $message = "Begonnen am ".$user['startdatum'];
										$buttontext = "Quiz fortführen";
									}
									else if($user['status_user_2'] == 0 && $playernumber == 2)
									{
										 $message = "Begonnen am ".$user['startdatum'];
										$buttontext = "Quiz fortführen";
									}
									else if($user['status_user_1'] == 0 || $user['status_user_2'] == 0)
									{
										$message = "Sie haben das Spiel mit ".$user['username']." bereits abgeschlossen.";
										$buttontext = "Zur Endseite";
									}
								}
								else
								{
									$message = "Spiel noch nicht gestartet";
									$buttontext = "Quiz starten";
									$checkStarted = 1;
								}

								echo "
									<tr>
										<td scope='row'>".++$count."</td>
										<td>

											<label>".$user['username']."</label>

										</td>
										<td>
											<form class='form-inline' action='include/functions_quiz.php' method='post'>
												<input type='hidden' name='continueQuiz' value='true'>
												<input type='hidden' name='playernumber' value='".$playernumber."'>
												<input type='hidden' name='quizID' value='".$user['quizid']."'>
												<input type='hidden' name='checkStarted' value='".$checkStarted."'>
												<input class='btn-uebersicht btn-uebersicht-green' type='submit' value='".$buttontext."'>
											</form>
										</td>
										<td>

												".$message."

										</td>
									</tr>
								";
							}

							echo "</tbody>
							</table>";
						}
                    ?>
				</div>
                

                <div class=" col-lg-12 col-md-12 col-sm-12">
                    
                    
                    <?php
                    $array = getAllChallenges($mysqli, $_SESSION['user_id']);
                    $count = 0;
                    if(count($array) > 0)
                    {
                        echo "<h3 class='Multip' style='text-align: center;'>
                                        <b>
                                            <u>Leute die dich herausgefordert haben</u>
                                        </b>
                                    </h3>
                                    <table class='table table-striped'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>#</th>
                                                <th scope='col'>Benutzername</th>
                                                <th scope='col'></th>
                                            </tr>
                                        </thead>
                                    <tbody>";

                        foreach($array as &$user )
                        {
                            echo "
                                    <tr>
                                    <td scope='row'>".++$count."</td>
                                    <td>
                                        <label>".$user['username']."</label>
                                    </td>
                                    <td>
										    <form class='form-inline' action='include/functions_quiz.php' method='post'>



											    <input type='hidden' name='newQuiz' value='true'>
											    <input type='hidden' name='challengedUserID' value='".$_SESSION['user_id']."'>
											    <input type='hidden' name='challengerUserID' value='".$user['userID1']."'>
											    <div class='form-group'>
                                                    <input class='btn-uebersicht btn-uebersicht-green' type='submit' name='action' value='annehmen'/>
											    </div>
											    <div class='form-group'>
                                                    <input class='btn-uebersicht btn-uebersicht-red' type='submit' name='action' value='ablehnen'>
											    </div>
										    </form>
									    </td>
								    </tr>";
                        }

                        echo"</tbody> </table>";
                    }


                    ?>
                    
                </div>



                <div class=" col-lg-12 col-md-12 col-sm-12" >
                    
                    <?php					
                        $array = getAllFriends($mysqli, $_SESSION['user_id']);
                        $array2 = getAlreadyChallengedUsers($mysqli, $_SESSION['user_id']);
                        $array3 = getPendingChallengesUsers($mysqli, $_SESSION['user_id']);
                        $array4 = checkCurrentMPGamesForChallenges($mysqli, $_SESSION['user_id']);

                        $check = 0;


                        echo "	<h3 class='Multip' style='text-align: center;'>
                                        <b>
                                            <u>Leute die du herausfordern kannst</u>
                                        </b>
								</h3>

								<form autocomplete='off'>
        							<input type='text' name='suche' id='input_category' placeholder='Suchen' class='form-control ' value=''>
        						</form>

                                <table class='table table-striped' id = 'table_user'>
                                    <thead>
                                        <tr>
                                            <th scope='col'>#</th>
                                            <th scope='col'>Benutzername</th>
                                            <th scope='col' style='text-align:center;'>Status</th>
                                        </tr>
                                    </thead>
                                <tbody>";

						//Convert data for autocomplete to javascript
						
						$js_array = json_encode($array);
						$js_getAlreadyChallengedUsers = json_encode($array2);
						$js_getPendingChallengesUsers = json_encode($array3);
						$js_checkCurrentMPGamesForChallenges = json_encode($array4);
						$js_sessionID = json_encode($_SESSION['user_id']);			

						echo "
						<script type='text/javascript'>

						var javascript_array = ".$js_array.";
						var alreadyChallengedUsers_array = ".$js_getAlreadyChallengedUsers.";
						var pendingChallengesUsers_array = ".$js_getPendingChallengesUsers.";
						var currentMPGamesForChallenges_array = ".$js_checkCurrentMPGamesForChallenges.";
						var sessionID = ".$js_sessionID.";
						
						</script>
						";

						// Convert end

                        //alle nutzer
						$count = 0;
						foreach($array as &$user )
						{
							$message="";
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
											echo "
												<tr>

													<td >
														".++$count."
													</td>
													<td>
														".$user['username']."
													</td>
													<td class='table_style_uebersicht'>
														Warte auf Annahme
													</td>
												</tr>
											";
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
											$check = 1;
											//echo "<li>".$userWeAreAlreadyFightingWith['username']." hat dich bereits geaufgefordert. Nimm an</li>";
										}
									}
									else
									{
										//Dododo
									}
								}

								if($check == 0)
								{
									echo "
									<tr>

										<td >
											".++$count."
										</td>
										<td>
											".$user['username']."
										</td>
										<td class='table_style_uebersicht'>
											<form class='form-inline' action='include/functions_quiz.php' method='post'>
												<input type='hidden' name='challengeUser' value='true'>
												<input type='hidden' name='challengerUserID' value='".$_SESSION['user_id']."'>
												<input type='hidden' name='challengedUserID' value='".$user['id']."'>
												<input  class='btn-uebersicht btn-uebersicht-green' type='submit' value='Fordere ihn heraus!'>
											</form>
										</td>
									</tr>
									";
								}
								else
								{
									$check = 0;
								}

							}
						}
                        echo "</tbody> </table>";
                    ?>
                    

                </div>



                
                </div>
        </div>

        <div></div>

        <!--____________________________________________________________________________________________________-->

        <!-- Scripts -->
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript">	
			$(document).ready(function () {				
				autocompleteMemberSearch(document.getElementById('input_category'), javascript_array);
			});


			function autocompleteMemberSearch(inp, userarray) {
				inp.addEventListener("input", function (e) {
					var i, val = this.value;

					closeAllLists();
					if (!val) {
						resetList();
						return false;
					}

					var count = 0;
					var check = 0;

					userarray.forEach(user => {
						if (user.username.toUpperCase().includes(val.toUpperCase())) {
							if(sessionID != user.id) {
								alreadyChallengedUsers_array.forEach(alreadyChallengedUser => {
									if(user.id == alreadyChallengedUser.userID2) {
										if(check == 0) {
											count++;
											$("#table_user").find('tbody').append("<tr><td>"+count+"</td><td>"+ user.username+"</td><td class='table_style_uebersicht'>Warte auf Annahme</td></tr>");
											check = 1;
										}
									}
								});

								pendingChallengesUsers_array.forEach(userChallengesUs => {
									if(user.id == userChallengesUs.userID1) {
										if(check == 0) {
											check == 1;
										}						
									}
								});

								currentMPGamesForChallenges_array.forEach(userWeAreAlreadyFightingWith => {
									if(user.id == userWeAreAlreadyFightingWith.membersid) {
										if(check == 0) {
											check = 1;
										}
									}
								});

								if(check == 0) {
									count++;
									$("#table_user").find('tbody').append("<tr><td>"+count+"</td><td>"+user.username+"</td><td class='table_style_uebersicht'><form class='form-inline' action='include/functions_quiz.php' method='post'><input type='hidden' name='challengeUser' value='true'><input type='hidden' name='challengerUserID' value='"+sessionID+"'><input type='hidden' name='challengedUserID' value='"+user.id+"'><input  class='btn-uebersicht btn-uebersicht-green' type='submit' value='Fordere ihn heraus!'></form></td></tr>");
								}
								else {
									check = 0;
								}
							}
							else {
								// Bei selbstfund nichts tun
							}
						}								
					});
				});

				function closeAllLists(elmnt) {
					//resets shown List
					$("#table_user tbody tr").remove()
				}

				function resetList() {
					var count = 0;
					var check = 0;

					userarray.forEach(user => {
						if(sessionID != user.id) {
							alreadyChallengedUsers_array.forEach(alreadyChallengedUser => {
								if(user.id == alreadyChallengedUser.userID2) {
									if(check == 0) {
										count++;
										$("#table_user").find('tbody').append("<tr><td>"+count+"</td><td>"+ user.username+"</td><td class='table_style_uebersicht'>Warte auf Annahme</td></tr>");
										check = 1;
									}
								}
							});

							pendingChallengesUsers_array.forEach(userChallengesUs => {
								if(user.id == userChallengesUs.userID1) {
									if(check == 0) {
										check == 1;
									}						
								}
							});

							currentMPGamesForChallenges_array.forEach(userWeAreAlreadyFightingWith => {
								if(user.id == userWeAreAlreadyFightingWith.membersid) {
									if(check == 0) {
										check = 1;
									}
								}
							});

							if(check == 0) {
								count++;
								$("#table_user").find('tbody').append("<tr><td>"+count+"</td><td>"+user.username+"</td><td class='table_style_uebersicht'><form class='form-inline' action='include/functions_quiz.php' method='post'><input type='hidden' name='challengeUser' value='true'><input type='hidden' name='challengerUserID' value='"+sessionID+"'><input type='hidden' name='challengedUserID' value='"+user.id+"'><input  class='btn-uebersicht btn-uebersicht-green' type='submit' value='Fordere ihn heraus!'></form></td></tr>");
							}
							else {
								check = 0;
							}						
						}
						else {
							// Bei selbstfund nichts tun
						}
					});
				}
			}

		</script>

        </div>


</body>
</html>