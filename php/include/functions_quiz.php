<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");

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

//Returns a random Question with random answers and correct Answer Position
function loadRandomQuestion($mysqli)
{
	if($stmt = $mysqli->prepare("SELECT Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value = 1 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid ORDER BY RAND() LIMIT 1"))
	{
		//$stmt->bind_param('i', 1);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows == 1) 
		{
			$stmt->bind_result($casename, $kategoriename);
			$stmt->fetch();
			$res = ["casename"=>$casename, "antwort1"=>$kategoriename];
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
	if($stmt = $mysqli->prepare("SELECT Cases.name, CBR_ICF_Kategorie.DE FROM Cases, CBR_ICF_Kategorie, Cases_Kategorie_Values WHERE Cases_Kategorie_Values.value < 0.7 AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid AND Cases.id = Cases_Kategorie_Values.caseid AND Cases.name = ? ORDER BY RAND() LIMIT 3"))
	{
		$stmt->bind_param('s', $res['casename']);
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

		$result = ["casename"=>utf8_decode($res['casename']), "antwort1"=>utf8_decode($res['antwort1']), "antwort2"=>utf8_decode($antwort2),"antwort3"=>utf8_decode($antwort3), "antwort4"=>utf8_decode($antwort4)];
		
		//Shuffle the answers before return
		return shuffleAnswers($result);
	}
	else
	{
	//DB Fehler
		return false;
	}

}

function checkCorrectAnswer(givenAnswer, correctAnswer)
{
	//TODO Chris schreib hier mal was cooles
	
}


if(isset($_POST['antwort1_Button'], $_POST['correctanswer'])
{
	//$p1 = filter_input(INPUT_POST, 'antwort1_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(0, $p2);
}

if(isset($_POST['antwort2_Button'], $_POST['correctanswer'])
{
	//$p1 = filter_input(INPUT_POST, 'antwort2_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(1, $p2);
}

if(isset($_POST['antwort3_Button'], $_POST['correctanswer'])
{
	//$p1 = filter_input(INPUT_POST, 'antwort3_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(2, $p2);
}

if(isset($_POST['antwort4_Button'], $_POST['correctanswer'])
{
	//$p1 = filter_input(INPUT_POST, 'antwort4_Button', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'correctanswer', FILTER_SANITIZE_NUMBER_INT);

	//TODO
	checkCorrectAnswer(3, $p2);
}
?>