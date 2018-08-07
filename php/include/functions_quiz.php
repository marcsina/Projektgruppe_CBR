<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");

include 'conn.php';

//shuffle answers to question
function shuffleAnswers($questionData)
{
	$i = rand(0,3);

	//Puts the correct answer on a random position
	switch($i)
	{
		case 0:
			$antwort1 = $questionData['answer1'];
			$antwort2 = $questionData['answer2'];
			$antwort3 = $questionData['answer3'];
			$antwort4 = $questionData['answer4'];
			$correctAnswer = $i;
			break;
		case 1:
			$antwort1 = $questionData['answer2'];
			$antwort2 = $questionData['answer1'];
			$antwort3 = $questionData['answer3'];
			$antwort4 = $questionData['answer4'];
			$correctAnswer = $i;
			break;
		case 2:
			$antwort1 = $questionData['answer2'];
			$antwort2 = $questionData['answer3'];
			$antwort3 = $questionData['answer1'];
			$antwort4 = $questionData['answer4'];
			$correctAnswer = $i;
			break;
		case 3:
			$antwort1 = $questionData['answer2'];
			$antwort2 = $questionData['answer3'];
			$antwort3 = $questionData['answer4'];
			$antwort4 = $questionData['answer1'];
			$correctAnswer = $i;
			break;
	}

	 $res = ["casename"=>$questionData['casename'], "antwort1"=>$antwort1, "antwort2"=>$antwort2, "antwort3"=>$antwort3, "antwort4"=>$antwort4, "correctAnswerPosition"=>$correctAnswer];
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
	if($stmt = $mysqli->prepare("SELECT ID, startdatum FROM SP_QUIZ WHERE User_ID = ?"))
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
			$stmt->bind_result($startdatum);

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

//insert the given answer into the DB
function insertAnswer($mysqli, $quiz_id, $question_id, $answer)
{

    if($stmt = $mysqli->prepare("Update SP_QUIZ SET Given_A = ? WHERE SP_QUIZ_ID = ? AND ID = ? ;"))
    {
        $stmt->bind_param('sii', $answer, $quiz_id, $question_id);
	    $stmt->execute();

    }
    else
    {
        return false;
    }

}


function getQuizData($mysqli, $type, $quiz_ID)
{
	//Singleplayer
	if($type =="SP")
	{
	    if($stmt = $mysqli->prepare("SELECT Casename, Type, Correct_A1, A2, A3, A4 FROM SP_FRAGE WHERE Given_A != 0 AND SP_QUIZ_ID = ? ORDER BY ID ASC LIMIT 1;"))
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
				$data = array();


				if($questionType == 0)
				{
					$questionString = "stark";
				}
				else if($questionType == 1)
				{
					$questionString = "schwach";
				}

				$finalQuestion = "Was ist ein ".$questionString." ausgerägtes Symptom in dem Fall".$casename."?";


				array_push($data,array("casename"=>$casename, "questiontype"=>$questionType, "answer1"=> $correctA, "answer2"=>$answer2, "answer3"=>$answer3, "answer4"=>$answer4, "questionString"=>$finalQuestion));

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
		if($stmt = $mysqli->prepare("SELECT Casename, Type FROM MP_FRAGE WHERE Given_A != 0 AND MP_QUIZ_ID = ? ORDER BY ID ASC LIMIT 1;"))
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
				$stmt->bind_result($casename, $questionType);
				if($questionType == 0)
				{
					$questionString = "stark";
				}
				else if($questionType == 1)
				{
					$questionString = "schwach";
				}

				$finalQuestion = "Was ist ein ".$questionString." ausgerägtes Symptom in dem Fall".$casename."?";
				return utf8_decode($finalQuestion);
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
	/*if($stmt = $mysqli->prepare("UPDATE MP_QUIZ (User_ID_1, User_ID_2) VALUES (?,?);"))
	update MP_QUIZ
  set enddatum_user_1 = case
                  when User_ID_1 = 10 then CURRENT_TIMESTAMP
                  else CURRENT_TIMESTAMP
                 end,
                 enddatum_user_2 = case
                  when User_ID_1 = 10 then CURRENT_TIMESTAMP
                  else CURRENT_TIMESTAMP
                 end
where ID = 29
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
    }*/
}

function endSPQuiz($mysqli)
{

}

if(isset($_POST['antwort1_Button']))
{
     insertAnswer($mysqli, $_POST['quizID'], $question_id, $_POST['antwort1_Button']);
}

if(isset($_POST['antwort2_Button'], $_POST['correctanswer']))
{
	//$p1 = filter_input(INPUT_POST, 'antwort2_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(1, $p2);
}

if(isset($_POST['antwort3_Button'], $_POST['correctanswer']))
{
	//$p1 = filter_input(INPUT_POST, 'antwort3_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(2, $p2);
}

if(isset($_POST['antwort4_Button'], $_POST['correctanswer']))
{
	//$p1 = filter_input(INPUT_POST, 'antwort4_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(3, $p2);
}

/*
*	Nutzer wurde herausgefordert und nimmt Quiz an, wird in tabelle eingetragen
*/
if(isset($_POST['newQuiz'],$_POST['challengedUserID'],$_POST['challengerUserID']))
{
	$p1 = filter_input(INPUT_POST, 'challengerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'challengedUserID', FILTER_SANITIZE_NUMBER_INT);
	$quiz_ID = generateMP_Quiz($mysqli, $p1, $p2);

	genereateFourQuestionsMultiplayer($mysqli, $quiz_ID);

	//Go to Quiz
	header('Location: ../Quiz.php');
}
if(isset($_POST['challengeUser'],$_POST['challengedUserID'],$_POST['challengerUserID']))
{
	$p1 = filter_input(INPUT_POST, 'challengerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'challengedUserID', FILTER_SANITIZE_NUMBER_INT);
	challengeSomeone($p1, $p2 ,$mysqli);
	header('Location: ../Quiz_uebersicht.php');
}

//Multiplayer
if(isset($_POST['continueQuiz'],$_POST['quizid']))
{
	$p1 = filter_input(INPUT_POST, 'quizid', FILTER_SANITIZE_NUMBER_INT);
	//TODO Continue QUIZ
	header('Location: ../Quiz.php');
}

//Continue SP QUiz
if(isset($_POST['continueQuiz'],$_POST['singpleplayerUserID'],$_POST['quizID']))
{
	$p1 = filter_input(INPUT_POST, 'singpleplayerUserID', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'quizID', FILTER_SANITIZE_NUMBER_INT);

	addStartdatumForChallengerMP($mysqli, $p2);
	//TODO Continue QUIZ
	header('Location: ../Quiz.php');
}

//Start SP Quiz
if(isset($_POST['startQuiz'],$_POST['singpleplayerUserID']))
{
	$p1 = filter_input(INPUT_POST, 'singpleplayerUserID', FILTER_SANITIZE_NUMBER_INT);
	$quiz_ID = generateSP_Quiz($mysqli, $p1);
	genereateFourQuestionsSingleplayer($mysqli, $quiz_ID);
	//TODO Start QUIZ
	header('Location: ../Quiz.php');
}
?>