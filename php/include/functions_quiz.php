<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");


include_once 'functions_login.php';
include 'conn.php';

sec_session_start();

//shuffle answers to question
function shuffleAnswers($answer1, $answer2, $answer3, $answer4)
{

	$i = rand(0,3);

	//Puts the correct answer on a random position
	switch($i)
	{
		case 0:
			$antwort1 = $answer1;
			$antwort2 = $answer2;
			$antwort3 = $answer3;
			$antwort4 = $answer4;
            $position1 = 1;
            $position2 = 2;
            $position3 = 3;
            $position4 = 4;
			break;
		case 1:
			$antwort1 = $answer2;
			$antwort2 = $answer1;
			$antwort3 = $answer3;
			$antwort4 = $answer4;
			$position1 = 2;
            $position2 = 1;
            $position3 = 3;
            $position4 = 4;
			break;
		case 2:
			$antwort1 = $answer2;
			$antwort2 = $answer3;
			$antwort3 = $answer1;
			$antwort4 = $answer4;
            $position1 = 2;
            $position2 = 3;
            $position3 = 1;
            $position4 = 4;
			break;
		case 3:
			$antwort1 = $answer2;
			$antwort2 = $answer3;
			$antwort3 = $answer4;
			$antwort4 = $answer1;
            $position1 = 2;
            $position2 = 3;
            $position3 = 4;
            $position4 = 1;
			break;
	}

	 $res = ["casename"=>$questionData['casename'], "antwort1"=>$antwort1, "antwort2"=>$antwort2, "antwort3"=>$antwort3, "antwort4"=>$antwort4, "positionAnswer1"=>$position1, "positionAnswer2"=>$position2 , "positionAnswer3"=>$position3, "positionAnswer4"=>$position4];
	 return $res;
}

//Returns a random Question with random answers and correct Answer Position for High Value
function loadRandomQuestionHigh($mysqli)
{
	if($stmt = $mysqli->prepare("SELECT Cases.id, Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value = 1 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid ORDER BY RAND() LIMIT 1"))
	{
		//$stmt->bind_param('i', 1);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows == 1)
		{
			$stmt->bind_result($id, $casename, $kategoriename);
			$stmt->fetch();
			$res = ["casename"=>utf8_decode($casename), "antwort1"=>utf8_decode($kategoriename), "id"=>$id ];
		}
		else
		{
		//DB Fehler
			return false;
		}

	}
	else
	{
		//DB FEHLER
		return false;
	}

	//Gegebenfalls noch den Wert Anpassen nachdem neue Cases da sind
	if($stmt = $mysqli->prepare("SELECT Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value < 0.8 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid AND Cases.id = ? ORDER BY RAND() LIMIT 3"))
	{
		$stmt->bind_param('i', $res['id']);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($casename, $kategoriename);

		$i = 0;
		while ($stmt->fetch())
		{
			if($i == 0)
			{
				$antwort2 = utf8_decode($kategoriename);
			}
			else if($i == 1)
			{
				$antwort3 = utf8_decode($kategoriename);
			}
			else if($i == 2)
			{
				$antwort4 = utf8_decode($kategoriename);
			}
			else
			{
				return false;
			}
			$i = $i+1;
		}

		$result = ["casename"=>utf8_decode($res['casename']), "antwort1"=>utf8_decode($res['antwort1']), "antwort2"=>utf8_decode($antwort2),"antwort3"=>utf8_decode($antwort3), "antwort4"=>utf8_decode($antwort4)];

		return $result;
		//Shuffle the answers before return
		//return shuffleAnswers($result);

	}
	else
	{
	//DB Fehler
		return false;
	}

}
//Challenge someone to a Quiz
function challengeSomeone($userID1, $userID2, $mysqli)
{
	//Check if the Challenge is already in the DB
	if($stmt = $mysqli->prepare("SELECT * FROM PENDING_CHALLENGE WHERE (User_ID_1 = ? AND User_ID_2 = ?) OR (User_ID_1 = ? AND User_ID_2 = ?);"))
	{
		$stmt->bind_param('iiii', $userID1, $userID2, $userID2, $userID1);
        $stmt->execute();
        $stmt->store_result();
		//if not insert it
		if ($stmt->num_rows < 1)
		{
            if($stmt2 = $mysqli->prepare("INSERT INTO PENDING_CHALLENGE(User_ID_1, User_ID_2) VALUES (?,?);"))
            {
                $stmt2->bind_param('ii', $userID1, $userID2);
	            $stmt2->execute();
				return true;
            }
            else
            {
                return false;
            }
        }
    }
    else
    {
        return false;
    }
}

function activeSingleplayerGame($mysqli, $userID)
{
	//Check if the Challenge is already in the DB
	if($stmt = $mysqli->prepare("SELECT ID, startdatum FROM SP_QUIZ WHERE User_ID = ? AND status = 0"))
	{
		$stmt->bind_param('i', $userID);
        $stmt->execute();
        $stmt->store_result();
		$data = array();
		if($stmt->num_rows > 0)
		{
			$test = $stmt->num_rows;
			$stmt->bind_result($id, $startdatum);
			$stmt->fetch();

			array_push($data, array("quizID"=>$id, "startdatum"=>$startdatum));

			return $data;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

//Returns a random Question with random answers and correct Answer Position for Low Value
function loadRandomQuestionLow($mysqli)
{
	if($stmt = $mysqli->prepare("SELECT Cases.id, Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value < 0.25 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid ORDER BY RAND() LIMIT 1"))
	{
		//$stmt->bind_param('i', 1);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows == 1)
		{
			$stmt->bind_result($id, $casename, $kategoriename);
			$stmt->fetch();
			$res = ["casename"=>utf8_decode($casename), "antwort1"=>utf8_decode($kategoriename), "id"=>$id];
		}
		else
		{
		//DB Fehler
			return false;
		}

	}
	else
	{
		//DB FEHLER
		return false;
	}

	//Gegebenfalls noch den Wert Anpassen nachdem neue Cases da sind
	if($stmt = $mysqli->prepare("SELECT Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value > 0.7 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid AND Cases.id = ? ORDER BY RAND() LIMIT 3"))
	{
		$stmt->bind_param('i', $res['id']);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($casename, $kategoriename);

		$i = 0;
		while ($stmt->fetch())
		{
			if($i == 0)
			{
				$antwort2 = utf8_decode($kategoriename);
			}
			else if($i == 1)
			{
				$antwort3 = utf8_decode($kategoriename);
			}
			else if($i == 2)
			{
				$antwort4 = utf8_decode($kategoriename);
			}
			else
			{
				return false;
			}
			$i = $i+1;
		}

		$result = ["casename"=>utf8_decode($res['casename']), "antwort1"=>utf8_decode($res['antwort1']), "antwort2"=>utf8_decode($antwort2),"antwort3"=>utf8_decode($antwort3), "antwort4"=>utf8_decode($antwort4)];

		return $result;
		//Shuffle the answers before return
		//return shuffleAnswers($result);
	}
	else
	{
	//DB Fehler
		return false;
	}

}

function genereateFourQuestionsMultiplayer($mysqli, $mp_quiz_ID)
{
	for($questionCounter = 0; $questionCounter < 4; $questionCounter++)
	{
        //Load random Question Type High with 50% probability and Low with 50% probability
		if(rand(0,1) == 0)
		{
			$question = loadRandomQuestionHigh($mysqli);
			$type = 0;
		}
		else
		{
			$question = loadRandomQuestionLow($mysqli);
			$type = 1;
		}

		if ($insert_stmt = $mysqli->prepare("INSERT INTO `MP_FRAGE`(`Type`, `Casename`, `Correct_A1`, `A2`, `A3`, `A4`, MP_QUIZ_ID) VALUES (?,?,?,?,?,?,?)"))
        {
            $insert_stmt->bind_param('isssssi', $type, $question['casename'], $question['antwort1'], $question['antwort2'], $question['antwort3'], $question['antwort4'], $mp_quiz_ID );
            // Führe die vorbereitete Anfrage aus.
            $insert_stmt->execute();
        }
    }
}

function genereateFourQuestionsSingleplayer($mysqli, $sp_quiz_ID)
{

	for($questionCounter = 0; $questionCounter < 4; $questionCounter++)
	{
        //Load random Question Type High with 50% probability and Low with 50% probability
		if(rand(0,1) == 0)
		{
			$question = loadRandomQuestionHigh($mysqli);
			$type = 0;
		}
		else
		{
			$question = loadRandomQuestionLow($mysqli);
			$type = 1;
		}

		if ($insert_stmt = $mysqli->prepare("INSERT INTO `SP_FRAGE`(`Type`, `Casename`, `Correct_A1`, `A2`, `A3`, `A4`, SP_QUIZ_ID) VALUES (?,?,?,?,?,?,?)"))
        {
            $insert_stmt->bind_param('isssssi', $type, $question['casename'], $question['antwort1'], $question['antwort2'], $question['antwort3'], $question['antwort4'], $sp_quiz_ID);
            // Führe die vorbereitete Anfrage aus.
            $insert_stmt->execute();
        }
    }
}

function getAllChallenges($mysqli, $userid)
{
	$sqlStmt = "SELECT PENDING_CHALLENGE.User_ID_1, members.username FROM PENDING_CHALLENGE, members WHERE User_ID_2 = $userid AND PENDING_CHALLENGE.User_ID_1 = members.id;";
    $result = mysqli_query($mysqli,$sqlStmt);
	$data = array();
    if ($result = $mysqli->query($sqlStmt))
    {
        while ($row = $result->fetch_assoc())
        {
			$userID1= $row["User_ID_1"];
			$username = $row["username"];

			array_push($data,array("userID1"=>$userID1, "username"=>$username));
        }
        // Objekt freigeben
        $result->free();
    }
	return $data;
}

function getAlreadyChallengedUsers($mysqli, $currentUser)
{
	// Get Alle Running Challenges for current users
	if($stmt = $mysqli->prepare("SELECT * FROM PENDING_CHALLENGE WHERE User_ID_1 = ?; "))
	{
		$stmt->bind_param('i', $currentUser);
        $stmt->execute();
        $stmt->store_result();
		$data = array();

		$stmt->bind_result($id, $userid1, $userid2);

		while ($stmt->fetch())
        {
			array_push($data,array("userID2"=>$userid2));
        }
    }
    else
    {
        return false;
    }
	return $data;
}

function getPendingChallengesUsers($mysqli, $currentUser)
{
	// Get Alle Pending Challenges for current users
	if($stmt = $mysqli->prepare("SELECT * FROM PENDING_CHALLENGE WHERE User_ID_2 = ?; "))
	{
		$stmt->bind_param('i', $currentUser);
        $stmt->execute();
        $stmt->store_result();
		$data = array();

		$stmt->bind_result($id, $userid1, $userid2);

		while ($stmt->fetch())
        {
			array_push($data,array("userID1"=>$userid1));
        }
    }
    else
    {
        return false;
    }
	return $data;
}

function generateSP_Quiz($mysqli, $userID)
{
    if($stmt = $mysqli->prepare("INSERT INTO SP_QUIZ (User_ID) VALUES (?);"))
    {
        $stmt->bind_param('i', $userID);
	    if($stmt->execute())
		{
			$quiz_ID = $mysqli->insert_id;
			return $quiz_ID;
		}
		else
		{
			return false;
		}
    }
    else
    {
        return false;
    }
}

function generateMP_Quiz($mysqli, $userID1, $userID2)
{
    if($stmt = $mysqli->prepare("INSERT INTO MP_QUIZ (User_ID_1, User_ID_2) VALUES (?,?);"))
    {
        $stmt->bind_param('ii', $userID1, $userID2);
	    if($stmt->execute())
		{
			$quiz_ID = $mysqli->insert_id;
			if($stmt2 = $mysqli->prepare("DELETE FROM PENDING_CHALLENGE WHERE User_ID_1 = ? AND User_ID_2 = ?;"))
			{
				$stmt2->bind_param('ii', $userID1, $userID2);
				$stmt2->execute();
				return $quiz_ID;
			}
		}
    }
    else
    {
        return false;
    }
}

function showCurrentMPGames($mysqli, $currentUser)
{
    if($stmt = $mysqli->prepare("SELECT members.username, members.id, MP_QUIZ.ID, IF(MP_QUIZ.User_ID_1 = ?, MP_QUIZ.startdatum_user_1, MP_QUIZ.startdatum_user_2) AS startdatum FROM MP_QUIZ, members WHERE (MP_QUIZ.User_ID_1 = ? OR MP_QUIZ.User_ID_2 = ?) AND (MP_QUIZ.User_ID_1 = members.id OR MP_QUIZ.User_ID_2 = members.id) AND NOT members.id = ? ORDER BY startdatum ASC;"))
    {
        $stmt->bind_param('iiii', $currentUser, $currentUser, $currentUser, $currentUser);
	    if($stmt->execute())
		{
			$stmt->store_result();
			$data = array();

			$stmt->bind_result($username, $membersid, $quizid, $startdatum);

			while ($stmt->fetch())
			{
				array_push($data, array("username"=>$username, "membersid"=>$membersid, "quizid"=>$quizid, "startdatum"=>$startdatum));
			}

			return $data;
		}
    }
    else
    {
        return false;
    }
}

function addStartdatumForChallengerMP($mysqli, $mp_quiz_ID)
{
	if($stmt = $mysqli->prepare("SELECT startdatum_user_1 FROM MP_QUIZ WHERE ID = ?"))
	{
		$stmt->bind_param('i', $mp_quiz_ID);
		if($stmt->execute())
		{
			$stmt->store_result();
			if($stmt->num_rows >0)
			{
				$stmt->bind_result($startdatum);
				$stmt->fetch();

				//Check if $startdatum is null, if yes set it to actual time
				if(is_null($startdatum))
				{
					if($stmt = $mysqli->prepare("UPDATE MP_QUIZ SET startdatum_user_1 = CURRENT_TIMESTAMP WHERE ID= ?"))
					{
						$stmt->bind_param('i', $mp_quiz_ID);
						if($stmt->execute())
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}


	}
	else
	{
		return false;
	}



}

//insert the given answer into the DB
function insertAnswer($mysqli, $type, $player, $quiz_id, $answer)
{
    //Singleplayer
    if($type =="SP")
    {
		if($stmt = $mysqli->prepare("SELECT ID FROM SP_FRAGE WHERE Given_A = 0 AND SP_QUIZ_ID = ? ORDER BY ID ASC LIMIT 1"))
        {
            $stmt->bind_param('i', $quiz_id);
			if($stmt->execute())
			{
				$stmt->store_result();
				$stmt->bind_result($questionID);
				$stmt->fetch();

				if(!is_null($questionID))
				{
					if($stmt = $mysqli->prepare("UPDATE SP_FRAGE SET Given_A = ? WHERE SP_QUIZ_ID = ? AND ID = ?"))
					{
						$stmt->bind_param('iii', $answer, $quiz_id, $questionID);
						if($stmt->execute())
						{
							return true;
						}
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;			
			}
		}
        else
        {
            return false;
        }
    }
    //Multiplayer
    else
    {
        //Check which player
        if($player == 1)
        {
            if($stmt = $mysqli->prepare("SELECT ID FROM MP_FRAGE WHERE MP_QUIZ_ID = ? AND Given_A1 = 0 ORDER BY ID ASC LIMIT 1"))
			{
				$stmt->bind_param('i', $quiz_id);
				if($stmt->execute())
				{
					$stmt->store_result();
					$stmt->bind_result($questionID);
					$stmt->fetch();
					if($stmt = $mysqli->prepare("Update MP_FRAGE SET Given_A1 = ? WHERE MP_QUIZ_ID = ? AND ID = ?;"))
					{
						$stmt->bind_param('iii', $answer, $quiz_id, $questionID);
						if($stmt->execute())
						{
							// Yeey
						}
						else
						{
							return false;						
						}
					}
					else
					{
						return false;						
					}
				}
				else
				{
					return false;						
				}
			}
			else
			{
				return false;						
			}
        }
        else
        {
            if($stmt = $mysqli->prepare("SELECT ID FROM MP_FRAGE WHERE MP_QUIZ_ID = ? AND Given_A2 = 0 ORDER BY ID ASC LIMIT 1"))
			{
				$stmt->bind_param('i', $quiz_id);
				if($stmt->execute())
				{
					$stmt->store_result();
					$stmt->bind_result($questionID);
					$stmt->fetch();
					if($stmt = $mysqli->prepare("Update MP_FRAGE SET Given_A2 = ? WHERE MP_QUIZ_ID = ? AND ID = ?;"))
					{
						$stmt->bind_param('iii', $answer, $quiz_id, $questionID);
						if($stmt->execute())
						{
							// Yeey
						}
						else
						{
							return false;						
						}
					}
					else
					{
						return false;						
					}
				}
				else
				{
					return false;						
				}
			}
			else
			{
				return false;						
			}
        }
    }
}


function getQuizData($mysqli, $type, $quiz_ID, $player)
{
    //return array
    $data = array();

	//Singleplayer
	if($type =="SP")
	{
	    if($stmt = $mysqli->prepare("SELECT Casename, Type, Correct_A1, A2, A3, A4 FROM SP_FRAGE WHERE Given_A = 0 AND SP_QUIZ_ID = ? ORDER BY ID ASC LIMIT 1;"))
        {
            $stmt->bind_param('i',$quiz_ID);
	        $stmt->execute();

			$stmt->store_result();

			if($stmt->num_rows == 0)
			{
				return "Finish";
			}
            else
			{
				$stmt->bind_result($casename, $questionType, $correctA, $answer2, $answer3, $answer4);
				$stmt->fetch();

				if($questionType == 0)
				{
					$questionString = "stark";
				}
				else if($questionType == 1)
				{
					$questionString = "schwach";
				}

				$finalQuestion = "Was ist ein ".$questionString." ausgerägtes Symptom in dem Fall".$casename."?";

				array_push($data,array("casename"=>$casename, "questiontype"=>$questionType, "answer1"=>$correctA, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "questionString"=>$finalQuestion));

                return $data;
			}
        }
        else
        {
            return false;
        }
	}
	//Multiplayer
	else
	{

        if($player == 1)
        {

            $stmt = $mysqli->prepare("SELECT Casename, Type, Correct_A1, A2, A3, A4 FROM MP_FRAGE WHERE Given_A1 = 0 AND MP_QUIZ_ID = ? ORDER BY ID ASC LIMIT 1;");
        }
        else
        {

            $stmt = $mysqli->prepare("SELECT Casename, Type, Correct_A1, A2, A3, A4 FROM MP_FRAGE WHERE Given_A2 = 0 AND MP_QUIZ_ID = ? ORDER BY ID ASC LIMIT 1;");
        }

		if($stmt)
        {
            $stmt->bind_param('i',$quiz_ID);
	        $stmt->execute();

			$stmt->store_result();

			if($stmt->num_rows == 0)
			{
				return "Finish";
			}
            else
			{
				$stmt->bind_result($casename, $questionType, $correctA, $answer2, $answer3, $answer4);


                $stmt->fetch();

				if($questionType == 0)
				{
					$questionString = "stark";
				}
				else if($questionType == 1)
				{
					$questionString = "schwach";
				}

				$finalQuestion = "Was ist ein ".$questionString." ausgerägtes Symptom in dem Fall ".$casename."?";
				array_push($data,array("casename"=>$casename, "questiontype"=>$questionType, "answer1"=>$correctA, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "questionString"=>$finalQuestion));
				debug_to_console("GETQUIZDATA/////Position1: ".$data[0]['answer1']." Position2: ".$data[0]['answer2']." Position3: ".$data[0]['answer3']." Position4: ".$data[0]['answer4']);
                return $data;
			}
        }
        else
        {
            return false;
        }
	}
}

function endMPQuiz($mysqli, $quizid, $userid)
{
	if($stmt = $mysqli->prepare("UPDATE MP_QUIZ set enddatum_user_1 = case when User_ID_1 = ? then CURRENT_TIMESTAMP else enddatum_user_1 end, status_user_1 = case when User_ID_1 = ? then 1 else status_user_1 end, enddatum_user_2 = case when User_ID_2 = ? then CURRENT_TIMESTAMP else enddatum_user_2 end, status_user_2 = case when User_ID_2 = ? then 1 else status_user_2 end WHERE ID = ?"))
    {
        $stmt->bind_param('iiiii', $userid, $userid, $userid, $userid, $quizid);
	    if($stmt->execute())
		{

            //----------------------------------------------------------------------------------To Remove-----------------------------------------------
            debug_to_console("End MPQuiz Geht");
			return true;
		}
    }
    else
    {
        return false;
    }
}

function endSPQuiz($mysqli, $userid)
{
	if($stmt = $mysqli->prepare("UPDATE SP_QUIZ SET enddatum = CURRENT_TIMESTAMP, status = 1 WHERE User_ID = ? and status = 0"))
    {
        $stmt->bind_param('i', $userid);
	    if($stmt->execute())
		{

            //----------------------------------------------------------------------------------To Remove-----------------------------------------------
            debug_to_console("End SPQuiz Geht");
			return true;
		}
    }
    else
    {
        return false;
    }
}

function getCurrentPlayerID($mysqli, $quiz_id, $user_id)
{
	if($stmt = $mysqli->prepare("SELECT IF (`User_ID_1`= ?, 1, 2) FROM MP_QUIZ WHERE ID=?;"))
    {
		$stmt->bind_param('ii', $user_id, $quiz_id);
		 if($stmt->execute())
		{
			$stmt->store_result();
			$stmt->bind_result($playernumber);
			$stmt->fetch();

			return $playernumber;
		}
	}
    else
    {
        return false;
    }
}

//put all needed data into the session
function setQuizSession($player, $quiz_id, $type)
{
    clearQuizSession();

    $_SESSION["player"] = $player;
    $_SESSION["quiz_id"] = $quiz_id;
    $_SESSION["type"] = $type;

}

//clear the session
function clearQuizSession()
{
    unset ($_SESSION["player"]);
    unset ($_SESSION["quiz_id"]);
    unset ($_SESSION["type"]);
}

function cleanpost()
{
	unset($_POST['antwort1_Button']);
	unset($_POST['antwort2_Button']);
	unset($_POST['antwort3_Button']);
	unset($_POST['antwort4_Button']);


	unset($_POST['positionAnswer1']);
	unset($_POST['positionAnswer2']);
	unset($_POST['positionAnswer3']);
	unset($_POST['positionAnswer4']);
}
//----------------TODO   Type der Quiz.php übergeben----------------------------
if(isset($_POST['antwort1_Button']))
{
	$position1 = filter_input(INPUT_POST, 'positionAnswer1', FILTER_SANITIZE_NUMBER_INT);
	$position2 = filter_input(INPUT_POST, 'positionAnswer2', FILTER_SANITIZE_NUMBER_INT);
	$position3 = filter_input(INPUT_POST, 'positionAnswer3', FILTER_SANITIZE_NUMBER_INT);
	$position4 = filter_input(INPUT_POST, 'positionAnswer4', FILTER_SANITIZE_NUMBER_INT);

    debug_to_console("Position1: ".$position1." Position2: ".$position2." Position3: ".$position3." Position4: ".$position4);

    if($position1 == 1)
    {
        $answer = 1;
    }
	else if($position2 == 1)
    {
        $answer = 2;
    }
	else if($position3 == 1)
    {
        $answer = 3;
    }
	else if($position4 == 1)
    {
        $answer = 4;
    }

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $answer);
	cleanpost();
}

if(isset($_POST['antwort2_Button']))
{
	$position1 = filter_input(INPUT_POST, 'positionAnswer1', FILTER_SANITIZE_NUMBER_INT);
	$position2 = filter_input(INPUT_POST, 'positionAnswer2', FILTER_SANITIZE_NUMBER_INT);
	$position3 = filter_input(INPUT_POST, 'positionAnswer3', FILTER_SANITIZE_NUMBER_INT);
	$position4 = filter_input(INPUT_POST, 'positionAnswer4', FILTER_SANITIZE_NUMBER_INT);

    debug_to_console("Position1: ".$position1." Position2: ".$position2." Position3: ".$position3." Position4: ".$position4);

    if($position1 == 2)
    {
        $answer = 1;
    }
	else if($position2 == 2)
    {
        $answer = 2;
    }
	else if($position3 == 2)
    {
        $answer = 3;
    }
	else if($position4 == 2)
    {
        $answer = 4;
    }

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $answer);
	cleanpost();
}

if(isset($_POST['antwort3_Button']))
{
	$position1 = filter_input(INPUT_POST, 'positionAnswer1', FILTER_SANITIZE_NUMBER_INT);
	$position2 = filter_input(INPUT_POST, 'positionAnswer2', FILTER_SANITIZE_NUMBER_INT);
	$position3 = filter_input(INPUT_POST, 'positionAnswer3', FILTER_SANITIZE_NUMBER_INT);
	$position4 = filter_input(INPUT_POST, 'positionAnswer4', FILTER_SANITIZE_NUMBER_INT);

    debug_to_console("Position1: ".$position1." Position2: ".$position2." Position3: ".$position3." Position4: ".$position4);

    if($position1 == 3)
    {
        $answer = 1;
    }
	else if($position2 == 3)
    {
        $answer = 2;
    }
	else if($position3 == 3)
    {
        $answer = 3;
    }
	else if($position4 == 3)
    {
        $answer = 4;
    }

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $answer);
	cleanpost();
}

if(isset($_POST['antwort4_Button']))
{
	$position1 = filter_input(INPUT_POST, 'positionAnswer1', FILTER_SANITIZE_NUMBER_INT);
	$position2 = filter_input(INPUT_POST, 'positionAnswer2', FILTER_SANITIZE_NUMBER_INT);
	$position3 = filter_input(INPUT_POST, 'positionAnswer3', FILTER_SANITIZE_NUMBER_INT);
	$position4 = filter_input(INPUT_POST, 'positionAnswer4', FILTER_SANITIZE_NUMBER_INT);

    debug_to_console("Position1: ".$position1." Position2: ".$position2." Position3: ".$position3." Position4: ".$position4);

    if($position1 == 4)
    {
        $answer = 1;
    }
	else if($position2 == 4)
    {
        $answer = 2;
    }
	else if($position3 == 4)
    {
        $answer = 3;
    }
	else if($position4 == 4)
    {
        $answer = 4;
    }

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $answer);

	cleanpost();
}

//Anderen User herausfordern
if(isset($_POST['challengeUser'],$_POST['challengedUserID'],$_POST['challengerUserID']))
{
	$p1 = filter_input(INPUT_POST, 'challengerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'challengedUserID', FILTER_SANITIZE_NUMBER_INT);
	challengeSomeone($p1, $p2 ,$mysqli);
	header('Location: ../Quiz_uebersicht.php');
}

/*
*	Nutzer wurde herausgefordert und nimmt Quiz an, wird in tabelle eingetragen. Start MP QUIZ (Challenged Perspektive)
*/
if(isset($_POST['newQuiz'],$_POST['challengedUserID'],$_POST['challengerUserID']))
{
	$p1 = filter_input(INPUT_POST, 'challengerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'challengedUserID', FILTER_SANITIZE_NUMBER_INT);
	$quiz_ID = generateMP_Quiz($mysqli, $p1, $p2);

	genereateFourQuestionsMultiplayer($mysqli, $quiz_ID);

	setQuizSession(2, $quiz_ID, "MP");

	//Go to Quiz
	header('Location: ../Quiz.php');
}


//MP fortführen oder starten
if(isset($_POST['continueQuiz'],$_POST['quizID'], $_POST['playernumber'], $_POST['checkStarted']))
{


	$quiz_id = filter_input(INPUT_POST, 'quizID', FILTER_SANITIZE_NUMBER_INT);
	$playernumber = filter_input(INPUT_POST, 'playernumber', FILTER_SANITIZE_NUMBER_INT);
	$checkStarted = filter_input(INPUT_POST, 'checkStarted', FILTER_SANITIZE_NUMBER_INT);

	if($checkStarted == 1)
	{
		addStartdatumForChallengerMP($mysqli, $quiz_id);
	}

	setQuizSession($playernumber, $quiz_id, "MP");

	//TODO Continue QUIZ
	header('Location: ../Quiz.php');
}

//Continue SP QUiz
if(isset($_POST['continueQuiz'],$_POST['singpleplayerUserID'],$_POST['quizID']))
{

	$p1 = filter_input(INPUT_POST, 'singpleplayerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'quizID', FILTER_SANITIZE_NUMBER_INT);

	setQuizSession(1, $p2, "SP");
	//TODO Continue QUIZ
	header('Location: ../Quiz.php');
}

//Start SP Quiz
if(isset($_POST['startQuiz'],$_POST['singpleplayerUserID']))
{

	$p1 = filter_input(INPUT_POST, 'singpleplayerUserID', FILTER_SANITIZE_NUMBER_INT);
	$quiz_ID = generateSP_Quiz($mysqli, $p1);
	genereateFourQuestionsSingleplayer($mysqli, $quiz_ID);

	setQuizSession(1, $quiz_ID, "SP");


	//TODO Start QUIZ
	header('Location: ../Quiz.php');
}












//Show variable in console
function debug_to_console( $data )
{
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "
<script>console.log('Debug Objects: " . $output . "');</script>";
}

?>