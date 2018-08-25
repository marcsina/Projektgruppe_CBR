<?php

function CreateTopic($userid, $topic, $text, $kategorie, $connection) 
{
    if ($stmt = $connection->prepare("INSERT INTO Forum_Topic(titel,kategorie) VALUES('$topic','$kategorie');")) 
    {
        $stmt->execute();
    }
    
    $value = $connection->query("SELECT MAX(id) as max FROM Forum_Topic LIMIT 1;");
    $result2 = $value->fetch_assoc();
    $ergebnis = $result2['max'];
    
    if ($stmt = $connection->prepare("INSERT INTO Forum_Beitrag(inhalt,beitragsnr,topic,user) VALUES('$text',1,'$ergebnis','$userid');"))
    {
        $stmt->execute();
    }
}

function CreateBeitrag($userid, $topic, $text, $kategorie, $connection)
{
    $value = $connection->query("SELECT MAX(beitragsnr) as max FROM Forum_Beitrag WHERE topic = '".$topic."' LIMIT 1;");
    $result2 = $value->fetch_assoc();
    $ergebnis = $result2['max']+1;
    if ($stmt = $connection->prepare("INSERT INTO Forum_Beitrag(inhalt,beitragsnr,topic,user) VALUES('$text','$ergebnis','$topic','$userid');"))
    {
        $stmt->execute();
    }
}

?>