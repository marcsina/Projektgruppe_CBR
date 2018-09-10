<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_classroom.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
    $userid = $_SESSION['user_id'];
} else {
    $logged = 'out';
    header('Location: http://141.99.248.104/php/login.php?logged=0');
    exit;
    $username = 'anonymous';
}

if(isset($_POST["rate"]))
{
    $value = $mysqli->query("SELECT value as i FROM Artikel_Rating WHERE User_id = '".$userid."' AND Artikel_id = '".$_POST["artikelid"]."';");
    $result = $value->fetch_assoc();
    if (mysqli_num_rows($value) > 0) {
        if($result['i']!=$_POST["rate"])
        {
            UpdateRatingArtikel($userid,$_POST["artikelid"],$_POST["rate"],$mysqli);
            echo "updated";
        }
        else 
        {
            DeleteRatingArtikel($userid,$_POST["artikelid"],$mysqli);
            echo "deleted";
        }
        
    }
    else {
        CreateRatingArtikel($userid,$_POST["artikelid"],$_POST["rate"],$mysqli);
        echo "inserted";
    }
        
    header('Location: artikel.php');
    exit();
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
            <h1 style=" color: white">Artikel</h1>
            <form class=" form-inline  " class=" form-control" action="artikel_search.php" method="get">
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
                <h4><small style=" color: white">Aktuelle Artikel</small></h4>
                <hr>
                <?php
                $sqlStmt = "SELECT * FROM Artikel ORDER BY Datum DESC;";
                $result =  mysqli_query($mysqli,$sqlStmt);
                $data = array();
                if ($result = $mysqli->query($sqlStmt))
                {
                    $i=0;
                    while ($row = $result->fetch_assoc())
                    {
                        ?>
                        <article>
                    	<a href="artikel_show.php?id=<?php echo $row['id']?>"><h3><strong><?php echo $row['Titel']?></strong></h3></a>
                    	
                    	<?php
                    	$value = $mysqli->query("SELECT username as nn FROM members WHERE id = '".$row['UserID']."';");
        				$result2 = $value->fetch_assoc();
        				?>
        				
                    	<h6><span class="glyphicon glyphicon-time"></span> Post by <?php echo $result2['nn']?>, <?php echo $row['Datum']?></h6>
                    	<p><?php echo substr($row['Inhalt'], 0, 500)?>...</p>
                    	
                    	<?php
                    	$value = $mysqli->query("SELECT COUNT(id) as i FROM Artikel_Rating WHERE Artikel_id = '".$row['id']."' AND value = 1;");
        				$result2 = $value->fetch_assoc();
        				$value = $mysqli->query("SELECT COUNT(id) as i FROM Artikel_Rating WHERE Artikel_id = '".$row['id']."' AND value = -1;");
        				$result3 = $value->fetch_assoc();
        				$value = $mysqli->query("SELECT value as v FROM Artikel_Rating WHERE User_id = '".$userid."' AND Artikel_id = '".$row['id']."';");
        				if (mysqli_num_rows($value) > 0)
        				{
        				    $result4 = $value->fetch_assoc();
        				    $found = $result4['v'];
        				    
        				}
        				else
        				{
        				    $found = 0;
        				}
        				
        				if($found == 0)
        				{
        				?>
                    	<form action="artikel.php" method="post">
                    	<input type="hidden" name="artikelid" value=<?php echo $row['id']?>/>
                    	<button type="submit" name="rate" value="1" style="background:none;color:inherit;"> &#128077; </button> <?php echo $result2['i']?> 
                    	<button type="submit" name="rate" value="-1" style="background:none;color:inherit;">&#128078; </button> <?php echo $result3['i']?> 
                    	</form>
                		</article>
                    	<?php
        				}
        				
        				if($found == 1)
        				{
        				    ?>
                    	<form action="artikel.php" method="post">
                    	<input type="hidden" name="artikelid" value=<?php echo $row['id']?>/>
                    	<button type="submit" name="rate" value="1" style="background:green;color:inherit;"> &#128077; </button> <?php echo $result2['i']?> 
                    	<button type="submit" name="rate" value="-1" style="background:none;color:inherit;">&#128078; </button> <?php echo $result3['i']?> 
                    	</form>
                		</article>
                    	<?php
        				}
        				
        				if($found == -1)
        				{
        				    ?>
                    	<form action="artikel.php" method="post">
                    	<input type="hidden" name="artikelid" value=<?php echo $row['id']?>/>
                    	<button type="submit" name="rate" value="1" style="background:none;color:inherit;"> &#128077; </button> <?php echo $result2['i']?> 
                    	<button type="submit" name="rate" value="-1" style="background:red;color:inherit;">&#128078; </button> <?php echo $result3['i']?> 
                    	</form>
                		</article>
                    	<?php
        				}
                    	$i++;
                    }
                
                // Objekt freigeben
                $result->free();
                } 
                ?>
            </section>
    
            <aside class=" col-md-3 peno">
                <h4><small style=" color: white">ALLE ARTIKEL</small></h4>
                <hr>
            	<form class=" form-inline  " class=" form-control" action="artikel_search.php" method="get">
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