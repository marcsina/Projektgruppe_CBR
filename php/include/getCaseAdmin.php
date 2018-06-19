<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getMain($connection)
{
    getCategories($connection);
}



function getCase($connection)
{

	if(isset($_POST['caseName']))
	{
		$caseName = filter_input(INPUT_POST, 'caseName');
	
		$sqlStmt = "SELECT Cases.id AS caseid, Cases.name AS casename ,Cases_Kategorie_Values.kategorieid AS casekategorie, Cases_Kategorie_Values.value AS casevalue, CBR_ICF_Kategorie.DE AS katname  FROM Cases, Cases_Kategorie_Values, CBR_ICF_Kategorie WHERE Cases.name = ('$caseName') AND Cases_Kategorie_Values.caseid = Cases.id AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid ORDER BY Cases.id;";
		
        $result =  mysqli_query($connection,$sqlStmt);
		
        $data = array();
        if ($result = $connection->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                $case_id = $row["caseid"];
                $case_name = $row["casename"];
				$categorie_name = $row["katname"];
				$categorie_id = $row["casekategorie"];
				$categorie_values = $row["casevalue"];

                array_push($data,array("CaseID"=> $id,"CaseName"=>$case_name,"KatName"=>$categorie_name,"KatID"=>$categorie_id,"KatValue"=>$categorie_values));
            }

            // Objekt freigeben
            $result->free();
        }

		
        // Ausgabe
        foreach ($data as $d)
        {		
            $id = $d["CaseID"];
            $case_name = $d["CaseName"];
			$categorie_name = $d["KatName"];
			$categorie_id = $d["KatID"];
			$categorie_values = $d["KatValue"];

            echo utf8_decode("$case_id,$case_name,$categorie_name,$categorie_id,$categorie_values");
            echo ";";
        }
		
		closeConnection($connection);
	}
}

getCase($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}
?>