<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");

include 'conn.php';

/*class Answer
{
	var $kat_id;
	var $kat_name;

	function get_ID
	{
		return $this->kat_id;
	}

	function get_Name
	{
		return $this->kat_name;
	}
}*/

//shuffle answers to question
function shuffleAnswers($questionData)
{
	$i = rand(0,3);

	//Puts the correct answer on a random position
	switch($i)
	{
		case 0:
			$antwort1 = $questionData['antwort1'];
			$antwort2 = $questionData['antwort2'];
			$antwort3 = $questionData['antwort3'];
			$antwort4 = $questionData['antwort4'];
			$correctAnswer = $i;
			break;
		case 1:
			$antwort1 = $questionData['antwort2'];
			$antwort2 = $questionData['antwort1'];
			$antwort3 = $questionData['antwort3'];
			$antwort4 = $questionData['antwort4'];
			$correctAnswer = $i;
			break;
		case 2:
			$antwort1 = $questionData['antwort2'];
			$antwort2 = $questionData['antwort3'];
			$antwort3 = $questionData['antwort1'];
			$antwort4 = $questionData['antwort4'];
			$correctAnswer = $i;
			break;
		case 3:
			$antwort1 = $questionData['antwort2'];
			$antwort2 = $questionData['antwort3'];
			$antwort3 = $questionData['antwort4'];
			$antwort4 = $questionData['antwort1'];
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
	if($stmt = $mysqli->prepare("SELECT * FROM PENDING_CHALLENGE WHERE User_ID_1 = ? AND User_ID_2 = ?; "))
	{
		$stmt->bind_param('ii', $userID1, $userID2);
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
		if( rand(0,1) == 0)
		{
			$question = loadRandomQuestionHigh($mysqli);
			$type = 0;
		}else
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

if(isset($_POST['antwort1_Button'], $_POST['correctanswer']))
{
	//$p1 = filter_input(INPUT_POST, 'antwort1_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(0, $p2);
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

if(isset($_POST['continueQuiz'],$_POST['quizid']))
{
	$p1 = filter_input(INPUT_POST, 'quizid', FILTER_SANITIZE_NUMBER_INT);
	//TODO Continue QUIZ
	header('Location: ../Quiz.php');
}
?>