<?php
header('Content-Type: text/html; charset=utf-8');
//ini_set ("display_errors", "1");
//error_reporting(E_ALL);

include_once 'conn.php';

sec_session_start();

if(isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']))
{
   

    //mail("marc61192@gmail.com", $_POST['subject'], $_POST['message'], $_POST['subject']." ".$_POST['email']);
}
?>