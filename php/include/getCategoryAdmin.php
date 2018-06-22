<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getCategory($connection)
{

	if(isset($_POST['categoryName']))
	{
		$categoryName = filter_input(INPUT_POST, 'categoryName');
	
		$sqlStmt = "SELECT CBR_Keyword_DE.name AS Symptomname, CBR_Keyword_DE.id AS SymptomID, CBR_ICF_Kategorie.id AS ICFID FROM CBR_Keyword_DE, CBR_ICF_Kategorie WHERE CBR_Keyword_DE.ICFkat = CBR_ICF_Kategorie.id AND CBR_ICF_Kategorie.DE = ('$categoryName');";
		//$sqlStmt = "SELECT Cases.id AS caseid, Cases.name AS casename ,Cases_Kategorie_Values.kategorieid AS casekategorie, Cases_Kategorie_Values.value AS casevalue, CBR_ICF_Kategorie.DE AS katname  FROM Cases, Cases_Kategorie_Values, CBR_ICF_Kategorie WHERE Cases.name = ('$caseName') AND Cases_Kategorie_Values.caseid = Cases.id AND CBR_ICF_Kategorie.id = Cases_Kategorie_Values.kategorieid ORDER BY Cases_Kategorie_Values.kategorieid ;";
		
        $result =  mysqli_query($connection,$sqlStmt);
		
        $data = array();
        if ($result = $connection->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                $category_id = $row["ICFID"];
				$symptom_name = $row["Symptomname"];

                array_push($data,array("ICFID"=> $category_id,"Symptomname"=>$symptom_name));
            }

            // Objekt freigeben
            $result->free();
        }

		
        // Ausgabe
        foreach ($data as $d)
        {		
            $id = $d["ICFID"];
            $symptom_name = $d["Symptomname"];

            echo utf8_decode("$id,$symptom_name");
            echo ";";
        }
		
		closeConnection($connection);
	}
}

getCategory($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}
?>