function genereateFourQuestionsMultiplayer($mysqli)
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

		if ($insert_stmt = $mysqli->prepare("INSERT INTO `MP_FRAGE`(`Type`, `Casename`, `Correct_A1`, `A2`, `A3`, `A4`) VALUES (?,?,?,?,?,?)")) {
            $insert_stmt->bind_param('isssss', $type, $question['casename'], $question['antwort1'], $question['antwort2'], $question['antwort3'], $question['antwort4'] );
            // Führe die vorbereitete Anfrage aus
            if (! $insert_stmt->execute()) {
			//Fehler beim EIntrag in DB
                return false;
            }
        }

	}
}