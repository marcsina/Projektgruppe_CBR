<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');
function getCases($connection)
{
        $sqlStmt = "SELECT Cases.id, Cases.name FROM Cases ORDER BY Cases.id";
        
        $result =  mysqli_query($connection,$sqlStmt);
        $data = array();
        if ($result = $connection->query($sqlStmt)) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $caseid = $row["id"];
                $name = $row["name"];

				
                array_push($data,array("caseid"=>$caseid,"name"=>$name));  
            }
            
            // Objekt freigeben
            $result->free();
        }
        
  
        // Ausgabe
        foreach ($data as $d)
        {
            $caseid = $d["caseid"];
            $name = $d["name"];			
            
            echo utf8_decode("$caseid,$name");
            echo ";";
        }
		mysqli_close($connection);
}

getCases($mysqli);
?>