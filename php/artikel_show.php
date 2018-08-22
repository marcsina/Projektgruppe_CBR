<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
    header('Location: http://141.99.248.92/Projektgruppe/php/login.php?logged=0');
	exit;
}
?>

<html lang="en">


<head>
    <!-- include Header -->    
    <?php include('include/header.php'); ?>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>  
    <?php include ("include/navbar.php"); ?>
    
<body id="home">
	<div class="container">
        <div class="row text-center">
        	<?php
        	$sqlStmt = "SELECT * FROM Artikel WHERE id = '".$_GET["id"]."';";
            $result =  mysqli_query($mysqli,$sqlStmt);
            $data = array();
            if ($result = $mysqli->query($sqlStmt))
            {
                while ($row = $result->fetch_assoc())
                {
                    ?>
                    <h1 style=" color: white"><?php echo $row['Titel']?></h1>
                    
                    <?php
                	$value = $mysqli->query("SELECT username as nn FROM members WHERE id = '".$row['UserID']."';");
    				$result2 = $value->fetch_assoc();
    				?>
                    
    				<h6><span class="glyphicon glyphicon-time"></span> Post by <?php echo $result2['nn']?>, <?php echo $row['Datum']?></h6>
    				<br>
    		 		<article>
                    <p class="text-left"> <?php echo $row['Inhalt'] ?> </p>
           			</article>
                	<?php
                }
            
            // Objekt freigeben
            $result->free();
            } 
            ?>            
        </div>
    </div>
    <!-- Scripts -->

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>