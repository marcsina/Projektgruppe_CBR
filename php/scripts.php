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
            <h1 style=" color: white">Scripts</h1>
            <form class=" form-inline  " class=" form-control" action="scripts_search.php" method="get">
                <h2 style="text-align: center; font-size: 30px; color: white"> </h2>
                <div class=" col-md-offset-1 col-md-10">
                    <button type="submit" class="btn btn-sucess" class="form-control" style=" color: black">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                    <input class="form-control" type="search" placeholder="Artikel suchen..." aria-label="Search" style="width: 400px;" name="searchtitel" id="searchtitel">
                </div>
            </form>
        </div>
    
        <div class="row">
            <section class=" col-md-offset-1 col-md-7 pour">
                <h4><small style=" color: white">Aktuelle Scripts</small></h4>
                <hr>
                <?php
                $sqlStmt = "SELECT * FROM Scripts ORDER BY Datum DESC;";
                $result =  mysqli_query($mysqli,$sqlStmt);
                $data = array();
                if ($result = $mysqli->query($sqlStmt))
                {
                    $i=0;
                    while ($row = $result->fetch_assoc())
                    {
                        ?>
                        <article>
                    	<a href="../pdf/<?php echo $row['id']?>.pdf" target="_blank"><h3><strong><?php echo $row['Titel']?></strong></h3></a>
                    	
                    	<?php
                    	$value = $mysqli->query("SELECT username as nn FROM members WHERE id = '".$row['UserID']."';");
        				$result2 = $value->fetch_assoc();
        				?>
        				
                    	<h6><span class="glyphicon glyphicon-time"></span> Post by <?php echo $result2['nn']?>, <?php echo $row['Datum']?></h6>
                		</article>
                    	<?php
                    	$i++;
                    }
                
                // Objekt freigeben
                $result->free();
                } 
                ?>
            </section>
    
            <aside class=" col-md-3 peno">
                <h4><small style=" color: white">ALLE SCRIPTS</small></h4>
                <hr>
            	<form class=" form-inline  " class=" form-control" action="scripts_search.php" method="get">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">                                                        
                            <a>
                                <button title="Demenz" type="submit" name="searchtitel" value="Demenz" style="width:100%;text-align:left;color: black">Demenz</button>
                            </a>                                                         
                        </div>
                    </div>
                </form>
            </aside>
        </div>
    </div>
    <!-- Scripts -->

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>