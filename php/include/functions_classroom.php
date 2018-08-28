<?php

function CreateRatingArtikel($userid,$artikelid,$value, $connection) 
{
    if ($stmt = $connection->prepare("INSERT INTO Artikel_Rating(Artikel_id,value,User_id) VALUES('$artikelid','$value','$userid');")) 
    {
        $stmt->execute();
    }
}

function UpdateRatingArtikel($userid,$artikelid,$value, $connection)
{
    if ($stmt = $connection->prepare("UPDATE Artikel_Rating SET value = '$value' WHERE Artikel_id = '$artikelid' AND User_id = '$userid';"))
    {
        $stmt->execute();
    }
}

function CreateRatingScript($userid,$scriptid,$value, $connection)
{
    if ($stmt = $connection->prepare("INSERT INTO Scripts_Rating(Script_id,value,User_id) VALUES('$scriptid','$value','$userid');"))
    {
        $stmt->execute();
    }
}

function UpdateRatingScript($userid,$scriptid,$value, $connection)
{
    if ($stmt = $connection->prepare("UPDATE Scripts_Rating SET value = '$value' WHERE Script_id = '$scriptid' AND User_id = '$userid';"))
    {
        $stmt->execute();
    }
}

?>