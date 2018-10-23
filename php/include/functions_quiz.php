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

function loadRandomQuestion($mysqli) {
	if($stmt = $mysqli->prepare("SELECT Cases.id, Cases.name, CBR_ICF_Kategorie.DE, Cases_Kategorie_Values.value FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid ORDER BY RAND() LIMIT 1"))
	{
		//$stmt->bind_param('i', 1);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows == 1)
		{
			$stmt->bind_result($id, $casename, $kategoriename, $value);
			$stmt->fetch();
			$res = ["casename"=>$casename, "antwort1"=>$kategoriename, "id"=>$id, "value"=>$value];
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
	//if($stmt = $mysqli->prepare("SELECT Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value > 0.7 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid AND Cases.id = ? ORDER BY RAND() LIMIT 3"))
	if($stmt = $mysqli->prepare("SELECT Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid AND Cases_Kategorie_Values.kategorieid NOT IN (SELECT Cases_Kategorie_Values.kategorieid FROM Cases_Kategorie_Values WHERE caseid = ?) GROUP BY CBR_ICF_Kategorie.id ORDER BY RAND() LIMIT 3"))
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
				$antwort2 = $kategoriename;
			}
			else if($i == 1)
			{
				$antwort3 = $kategoriename;
			}
			else if($i == 2)
			{
				$antwort4 = $kategoriename;
			}
			else
			{
				return false;
			}
			$i = $i+1;
		}

		// Überprüfe ob Frage hoch oder niedrig
		$type = 0;
		if($res['value'] <= 0.5) {
			$type = 1;
		}
		else {
			$type = 0;
		}


		$result = ["casename"=>$res['casename'], "antwort1"=>$res['antwort1'], "antwort2"=>$antwort2,"antwort3"=>$antwort3, "antwort4"=>$antwort4, "type"=>$type, "caseid"=>$res['id']];

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
	$UsedCaseIds = array();
	$doublequestion = 0;
	for($questionCounter = 0; $questionCounter < 4; $questionCounter++)
	{
        //Load random Question Type High with 50% probability and Low with 50% probability
		/*if(rand(0,1) == 0)
		{
			$question = loadRandomQuestionHigh($mysqli);
            while($question == false)
            {
                $question = loadRandomQuestionHigh($mysqli);
            }
			$type = 0;
		}
		else
		{
			$question = loadRandomQuestionLow($mysqli);
            while($question == false)
            {
                $question = loadRandomQuestionLow($mysqli);
            }
			$type = 1;
		}*/

		$question = loadRandomQuestion($mysqli);

		foreach($UsedCaseIds as $questionid) {
			if($questionid == $question['caseid']) {
				$doublequestion = 1;
			}
		}

		if($doublequestion == 1) {
			$questionCounter--;
			$doublequestion = 0;
		}
		else {
			if ($insert_stmt = $mysqli->prepare("INSERT INTO `MP_FRAGE`(`Type`, `Casename`, `Correct_A1`, `A2`, `A3`, `A4`, MP_QUIZ_ID) VALUES (?,?,?,?,?,?,?)"))
			{
				$insert_stmt->bind_param('isssssi', $question['type'], $question['casename'], $question['antwort1'], $question['antwort2'], $question['antwort3'], $question['antwort4'], $mp_quiz_ID );
				// Führe die vorbereitete Anfrage aus.
				$insert_stmt->execute();
			}
		}
    }
}

function genereateFourQuestionsSingleplayer($mysqli, $sp_quiz_ID)
{
	$UsedCaseIds = array();
	$doublequestion = 0;
	for($questionCounter = 0; $questionCounter < 4; $questionCounter++)
	{
        //debug_to_console("SP-QUESTIONS: ".$questionCounter);
        //Load random Question Type High with 50% probability and Low with 50% probability
		/*if(rand(0,1) == 0)
		{
			$question = loadRandomQuestionHigh($mysqli);
            while($question == false)
            {
                $question = loadRandomQuestionHigh($mysqli);
            }
			$type = 0;
		}
		else
		{
			$question = loadRandomQuestionLow($mysqli);
            while($question == false)
            {
                $question = loadRandomQuestionLow($mysqli);
            }
			$type = 1;
		}*/

		$question = loadRandomQuestion($mysqli);

		foreach($UsedCaseIds as $questionid) {
			if($questionid == $question['caseid']) {
				$doublequestion = 1;
			}
		}

		if($doublequestion == 1) {
			$questionCounter--;
			$doublequestion = 0;
		}
		else {
			array_push($UsedCaseIds, $question['caseid']);
			if ($insert_stmt = $mysqli->prepare("INSERT INTO `SP_FRAGE`(`Type`, `Casename`, `Correct_A1`, `A2`, `A3`, `A4`, SP_QUIZ_ID) VALUES (?,?,?,?,?,?,?)"))
			{
				$insert_stmt->bind_param('isssssi', $question['type'], $question['casename'], $question['antwort1'], $question['antwort2'], $question['antwort3'], $question['antwort4'], $sp_quiz_ID);
				// Führe die vorbereitete Anfrage aus.
				$insert_stmt->execute();
			}
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
    if($stmt = $mysqli->prepare("INSERT INTO SP_QUIZ (User_ID, startdatum) VALUES (?,CURRENT_TIMESTAMP);"))
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
    if($stmt = $mysqli->prepare("INSERT INTO MP_QUIZ (User_ID_1, User_ID_2, startdatum_user_2) VALUES (?,?, CURRENT_TIMESTAMP);"))
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

function declineChallenge ($mysqli, $userID1, $userID2)
{
	if($stmt = $mysqli->prepare("DELETE FROM PENDING_CHALLENGE WHERE User_ID_1 = ? AND User_ID_2 = ?;"))
    {
        $stmt->bind_param('ii', $userID1, $userID2);
	    if($stmt->execute())
		{
			return true;
		}
    }
    else
    {
        return false;
    }
}

function showCurrentMPGames($mysqli, $currentUser)
{
    if($stmt = $mysqli->prepare("SELECT members.username, members.id, MP_QUIZ.ID, IF(MP_QUIZ.User_ID_1 = ?, MP_QUIZ.startdatum_user_1, MP_QUIZ.startdatum_user_2) AS startdatum, status_user_1, status_user_2, User_ID_1, User_ID_2 FROM MP_QUIZ, members WHERE (MP_QUIZ.User_ID_1 = ? OR MP_QUIZ.User_ID_2 = ?) AND (MP_QUIZ.User_ID_1 = members.id OR MP_QUIZ.User_ID_2 = members.id) AND NOT members.id = ? AND NOT (status_user_1 = 1 AND status_user_2 = 1) ORDER BY startdatum ASC;"))
    {
        $stmt->bind_param('iiii', $currentUser, $currentUser, $currentUser, $currentUser);
	    if($stmt->execute())
		{
			$stmt->store_result();
			$data = array();

			$stmt->bind_result($username, $membersid, $quizid, $startdatum, $status_user_1, $status_user_2, $User_ID_1, $User_ID_2);

			while ($stmt->fetch())
			{
				array_push($data, array("username"=>$username, "membersid"=>$membersid, "quizid"=>$quizid, "startdatum"=>$startdatum, "status_user_1"=>$status_user_1, "status_user_2"=>$status_user_2));
			}

			return $data;
		}
    }
    else
    {
        return false;
    }
}

function checkCurrentMPGamesForChallenges($mysqli, $currentUser)
{
    if($stmt = $mysqli->prepare("SELECT members.id,  status_user_1, status_user_2, IF(MP_QUIZ.User_ID_1 = ?, startdatum_user_1, startdatum_user_2) as startdatum FROM MP_QUIZ, members WHERE (MP_QUIZ.User_ID_1 = ? OR MP_QUIZ.User_ID_2 = ?) AND (MP_QUIZ.User_ID_1 = members.id OR MP_QUIZ.User_ID_2 = members.id) AND NOT members.id = ? ORDER BY startdatum ASC;"))
    {
        $stmt->bind_param('iiii', $currentUser, $currentUser, $currentUser, $currentUser);
	    if($stmt->execute())
		{
			$stmt->store_result();
			$data = array();

			$stmt->bind_result($membersid, $status_user_1, $status_user_2, $startdatum);

			while ($stmt->fetch())
			{
				if($status_user_1 == 0 || $status_user_2 == 0)
				{
					array_push($data, array("membersid"=>$membersid, "status_user_1"=>$status_user_1, "status_user_2"=>$status_user_2));
					//echo "<li>".$userWeAreAlreadyFightingWith['username']." hat dich bereits geaufgefordert. Nimm an</li>";
				}
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

function getProgressionData($mysqli, $type, $userID, $quizID, $playernumber)
{
    $data = array();
    if($type == "SP")
    {
		if($stmt = $mysqli->prepare("SELECT COUNT(id), COUNT(IF(`Given_A`>0, 1, null)) AS answered FROM `SP_FRAGE` WHERE `SP_QUIZ_ID` = ?"))
        {
            $stmt->bind_param('i',$quizID);
	        $stmt->execute();

			$stmt->store_result();

            $stmt->bind_result($countQuestions, $countAnsweredQuestions);
            $stmt->fetch();

            array_push($data,array("countQuestions"=>$countQuestions, "countAnsweredQuestions"=>$countAnsweredQuestions));
            return $data;
        }
    }
    else
    {
        if($playernumber == 1)
        {
            if($stmt = $mysqli->prepare("SELECT COUNT(id), COUNT(IF(`Given_A1`>0, 1, null)) AS answered FROM `MP_FRAGE` WHERE `MP_QUIZ_ID` = ?"))
            {
                $stmt->bind_param('i',$quizID);
	            $stmt->execute();

			    $stmt->store_result();

                $stmt->bind_result($countQuestions, $countAnsweredQuestions);
                $stmt->fetch();

                array_push($data,array("countQuestions"=>$countQuestions, "countAnsweredQuestions"=>$countAnsweredQuestions));
                return $data;
            }
        }
        else
        {
            if($stmt = $mysqli->prepare("SELECT COUNT(id), COUNT(IF(`Given_A2`>0, 1, null)) AS answered FROM `MP_FRAGE` WHERE `MP_QUIZ_ID` = ?"))
            {
                $stmt->bind_param('i',$quizID);
	            $stmt->execute();

			    $stmt->store_result();

                $stmt->bind_result($countQuestions, $countAnsweredQuestions);
                $stmt->fetch();

                array_push($data,array("countQuestions"=>$countQuestions, "countAnsweredQuestions"=>$countAnsweredQuestions));
                return $data;
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
				$finalQuestion = "Welche Funktion ist im Fall ".$casename.", ".$questionString." beeinträchtigt?";

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

				$finalQuestion = "Welche Funktion ist im Fall ".$casename.", ".$questionString." beeinträchtigt?";
				array_push($data,array("casename"=>$casename, "questiontype"=>$questionType, "answer1"=>$correctA, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "questionString"=>$finalQuestion));
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
    //OLD
    //"UPDATE MP_QUIZ set enddatum_user_1 = case when User_ID_1 = ? then CURRENT_TIMESTAMP else enddatum_user_1 end,
                                                    //status_user_1 = case when User_ID_1 = ? then 1 else status_user_1 end,
                                                    //enddatum_user_2 = case when User_ID_2 = ? then CURRENT_TIMESTAMP else enddatum_user_2 end,
                                                    //status_user_2 = case when User_ID_2 = ? then 1 else status_user_2 end
                                                    //WHERE ID = ?"

    //New. If eingefügt damit das enddatum nicht überschrieben wird falls man auf die endseite geht während der andere noch nicht abgeschlossen hat--------------------------------------------------------------------------------------------------------------------------------------------------
    //Noch genauer testen
	if($stmt = $mysqli->prepare("UPDATE MP_QUIZ set enddatum_user_1 = case when User_ID_1 = ? then IF(enddatum_user_1 is null,CURRENT_TIMESTAMP,enddatum_user_1 ) else enddatum_user_1 end,
                                                    status_user_1 = case when User_ID_1 = ? then 1 else status_user_1 end,
                                                    enddatum_user_2 = case when User_ID_2 = ? then IF(enddatum_user_2 is null,CURRENT_TIMESTAMP,enddatum_user_2) else enddatum_user_2 end,
                                                    status_user_2 = case when User_ID_2 = ? then 1 else status_user_2 end
                                                    WHERE ID = ?"))
    {
        $stmt->bind_param('iiiii', $userid, $userid, $userid, $userid, $quizid);
	    if($stmt->execute())
		{
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
			return true;
		}
    }
    else
    {
        return false;
    }
}

function getEndData($mysqli, $type, $quizID, $User_ID)
{

    $data = array();
    if($type == "SP")
    {
		if($stmt = $mysqli->prepare("SELECT Type, Casename, Correct_A1, A2, A3, A4, Given_A FROM `SP_FRAGE` WHERE `SP_QUIZ_ID` = ?"))
        {
            $stmt->bind_param('i',$quizID);
	        $stmt->execute();

			$stmt->store_result();

            $stmt->bind_result($type, $casename, $answer1, $answer2, $answer3, $answer4, $givenA);
            while($stmt->fetch())
            {
                array_push($data,array("type"=>$type, "casename"=>$casename, "answer1"=>$answer1, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "givenA"=>$givenA));
            }
            clearQuizSession();
            return $data;
        }
    }
    else
    {
        $playernumber = getCurrentPlayerID($mysqli, $quizID, $User_ID);
        debug_to_console("PlayerNumber: ".$playernumber);

        if($playernumber == 1)
        {
            if($stmt = $mysqli->prepare("SELECT Type, Casename, Correct_A1, A2, A3, A4, Given_A1 FROM `MP_FRAGE` WHERE `MP_QUIZ_ID` = ?"))
            {
                $stmt->bind_param('i',$quizID);
	            $stmt->execute();

			    $stmt->store_result();

                $stmt->bind_result($type, $casename, $answer1, $answer2, $answer3, $answer4, $givenA);
                while($stmt->fetch())
                {
                    array_push($data,array("type"=>$type, "casename"=>$casename, "answer1"=>$answer1, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "givenA"=>$givenA));
                }

                return $data;
            }
        }
        else
        {
            if($stmt = $mysqli->prepare("SELECT Type, Casename, Correct_A1, A2, A3, A4, Given_A2 FROM `MP_FRAGE` WHERE `MP_QUIZ_ID` = ?"))
            {
                $stmt->bind_param('i',$quizID);
	            $stmt->execute();

			    $stmt->store_result();

                $stmt->bind_result($type, $casename, $answer1, $answer2, $answer3, $answer4, $givenA);
                while($stmt->fetch())
                {
                    array_push($data,array("type"=>$type, "casename"=>$casename, "answer1"=>$answer1, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "givenA"=>$givenA));
                }

                return $data;
            }
        }
    }
}

function get2ndPlayerData($mysqli, $quizID)
{

    $playernumber = getCurrentPlayerID($mysqli,$quizID, $_SESSION['user_id']);

    $data = array();
    if($playernumber == 1)
    {
        if($stmt = $mysqli->prepare("SELECT Type, Casename, Correct_A1, A2, A3, A4, Given_A2, members.username FROM `MP_FRAGE`, MP_QUIZ, members WHERE MP_FRAGE.MP_QUIZ_ID = ? AND MP_FRAGE.MP_QUIZ_ID = MP_QUIZ.ID AND MP_QUIZ.User_ID_2 = members.id AND Given_A2 != 0 ORDER BY MP_FRAGE.ID ASC"))
        {
            $stmt->bind_param('i',$quizID);
	        $stmt->execute();

			$stmt->store_result();

            $stmt->bind_result($type, $casename, $answer1, $answer2, $answer3, $answer4, $givenA, $opponentUsername);
            while($stmt->fetch())
            {
                array_push($data,array("type"=>$type, "casename"=>$casename, "answer1"=>$answer1, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "givenA"=>$givenA, "opponentUsername"=>$opponentUsername));
            }
            clearQuizSession();
            return $data;
        }
    }
    else
    {
        if($stmt = $mysqli->prepare("SELECT Type, Casename, Correct_A1, A2, A3, A4, Given_A1, members.username FROM `MP_FRAGE`, MP_QUIZ, members WHERE MP_FRAGE.MP_QUIZ_ID = ? AND MP_FRAGE.MP_QUIZ_ID = MP_QUIZ.ID AND MP_QUIZ.User_ID_1 = members.id  AND Given_A1 != 0 ORDER BY MP_FRAGE.ID ASC"))
        {
            $stmt->bind_param('i',$quizID);
	        $stmt->execute();

			$stmt->store_result();

            $stmt->bind_result($type, $casename, $answer1, $answer2, $answer3, $answer4, $givenA, $opponentUsername);
            while($stmt->fetch())
            {
                array_push($data,array("type"=>$type, "casename"=>$casename, "answer1"=>$answer1, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "givenA"=>$givenA, "opponentUsername"=>$opponentUsername));
            }
            clearQuizSession();
            return $data;
        }
    }
}

function getCurrentPlayerID($mysqli, $quiz_id, $user_id)
{
    debug_to_console("getcurrentplayerid");
    debug_to_console("quizid".$quiz_id);
    debug_to_console("userid".$user_id);
	if($stmt = $mysqli->prepare("SELECT IF (`User_ID_1`= ?, 1, 2) FROM MP_QUIZ WHERE ID=?;"))
    {
		$stmt->bind_param('ii', $user_id, $quiz_id);
        if($stmt->execute())
		{
			$stmt->store_result();
			$stmt->bind_result($playernumber);
			$stmt->fetch();
            debug_to_console($playernumber);

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

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $position1);
	cleanpost();
}

if(isset($_POST['antwort2_Button']))
{
	$position2 = filter_input(INPUT_POST, 'positionAnswer2', FILTER_SANITIZE_NUMBER_INT);

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $position2);
	cleanpost();
}

if(isset($_POST['antwort3_Button']))
{
	$position3 = filter_input(INPUT_POST, 'positionAnswer3', FILTER_SANITIZE_NUMBER_INT);

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $position3);
	cleanpost();
}

if(isset($_POST['antwort4_Button']))
{
	$position4 = filter_input(INPUT_POST, 'positionAnswer4', FILTER_SANITIZE_NUMBER_INT);

    insertAnswer($mysqli, $_SESSION['type'], $_SESSION['player'], $_SESSION['quiz_id'], $position4);
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
if(isset($_POST['newQuiz'],$_POST['challengedUserID'],$_POST['challengerUserID'], $_POST['action']))
{
	$p1 = filter_input(INPUT_POST, 'challengerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'challengedUserID', FILTER_SANITIZE_NUMBER_INT);

	if ($_POST['action'] == 'annehmen')
	{
		// Anfrage angenommen
		$quiz_ID = generateMP_Quiz($mysqli, $p1, $p2);
		genereateFourQuestionsMultiplayer($mysqli, $quiz_ID);
		setQuizSession(2, $quiz_ID, "MP");

		//Go to Quiz
		header('Location: ../Quiz.php');
	}
	else
	{
		// Anfrage abgelehnt
		declineChallenge($mysqli, $p1, $p2);
		header('Location: ../Quiz_uebersicht.php');
	}

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