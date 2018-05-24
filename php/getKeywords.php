<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include('conn.php');

function getMain($connection)
{
    getKeywordsCBR($connection);
}



function getKeywordsCBR($connection)
{
    $sqlStmt = "SELECT CBR_Keyword_DE.id, CBR_Keyword_DE.name, CBR_ICF_Kategorie.id AS katid ,CBR_ICF_Kategorie.DE FROM CBR_Keyword_DE, CBR_ICF_Kategorie WHERE CBR_Keyword_DE.ICFkat = CBR_ICF_Kategorie.id ORDER BY CBR_ICF_Kategorie.id;";

        $result =  mysqli_query($connection,$sqlStmt);
        $data = array();
        if ($result = $connection->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                //$id = $row["id"];
                $name = $row["name"];
				$katid = $row["katid"];
				//$DE = $row["DE"];


                //array_push($data,array("ID"=> $id,"name"=>$name,"katid"=>$katid,"DE"=>$DE));
		array_push($data,array("name"=>$name,"katid"=>$katid));
            }

            // Objekt freigeben
            $result->free();
        }


        // Ausgabe
        foreach ($data as $d)
        {
            //$id = $d["ID"];
            $name = $d["name"];
			$katid = $d["katid"];
			//$DE = $d["DE"];

            echo utf8_decode("$name,$katid");
            echo ";";
        }

		closeConnection($connection);


}

getKeywordsCBR($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}
?>