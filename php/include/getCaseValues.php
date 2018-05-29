<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getMain($connection)
{
    getCaseValues($connection);
}


//Gibt alle CIMAWA Werte der Fälle zürück
function getCaseValues($connection)
{
        $sqlStmt = "SELECT Cases_Kategorie_Values.caseid, Cases_Kategorie_Values.kategorieid, Cases_Kategorie_Values.value FROM Cases_Kategorie_Values ORDER BY Cases_Kategorie_Values.caseid, Cases_Kategorie_Values.kategorieid;";
        
        $result =  mysqli_query($connection,$sqlStmt);
        $data = array();
        if ($result = $connection->query($sqlStmt)) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $caseid = $row["caseid"];
                $kategorieid = $row["kategorieid"];
				$value = $row["value"];

				
                array_push($data,array("caseid"=>$caseid,"kategorieid"=>$kategorieid,"value"=>$value));  
            }
            
            // Objekt freigeben
            $result->free();
        }
        
  
        // Ausgabe
        foreach ($data as $d)
        {
            $caseid = $d["caseid"];
            $kategorieid = $d["kategorieid"];
            $value = $d["value"];				
            
            echo utf8_decode("$caseid(//separatormid//)$kategorieid(//separatormid//)$value");
            echo "[||separatorend||]";
        }
		
	
		closeConnection($connection);
  
  
}
 
getCaseValues($mysqli);
 
//Verbindung schließen.
function closeConnection($connection){
  mysqli_close($connection);
}
?>