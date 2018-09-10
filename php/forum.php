<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
    header('Location: http://141.99.248.104/php/login.php?logged=0');
	exit;
}

?>
<!doctype html>
<html lang="de">
<head>
    <?php include('include/header.php'); ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_forum.css" rel="stylesheet">
</head>
    <?php include ("include/navbar.php"); ?>
<body>
    <div class="container">
    	<ul class="nav top">
            <li><a style = "font-weight: normal" href="forum.php">Forum</a></li>
        </ul>
    <br>  
       
    <table style = "width: 100%;">
        <tr bgcolor = "#1a2732">
            <th style = "width: 50px">Nr</th>
            <th>Kategorie</th>
        </tr>
        <tr bgcolor = "#2d4457">
            <td>1</td>
            <td><a href="forum_demenz.php" style="color: white;text-decoration: none;"><div class="nicehover" style="height:100%;width:100%">Demenz</div></a></td>
        </tr>
    </table>           
        
 	</div>
 	
	<script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>