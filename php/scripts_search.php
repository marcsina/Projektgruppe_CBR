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
    header('Location: http://medausbild.de/php/login.php?logged=0');
    exit;
    $username = 'anonymous';
}

if(isset($_POST["rate"]))
{
    $value = $mysqli->query("SELECT value as i FROM Scripts_Rating WHERE User_id = '".$userid."' AND Script_id = '".$_POST["scriptid"]."';");
    $result = $value->fetch_assoc();
    if (mysqli_num_rows($value) > 0) {
        if($result['i']!=$_POST["rate"])
        {
            UpdateRatingScript($userid,$_POST["scriptid"],$_POST["rate"],$mysqli);
            echo "updated";
        }
        else
        {
            DeleteRatingScript($userid,$_POST["scriptid"],$mysqli);
            echo "deleted";
        }
    }
    else {
        CreateRatingScript($userid,$_POST["scriptid"],$_POST["rate"],$mysqli);
        echo "inserted";
    }
    
    header("Location: scripts_search.php?searchtitel=".$_GET["searchtitel"]."");
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
    
            <section class=" col-md-offset-1">
                <h4><small style=" color: white">Gefundene Scripts</small></h4>
                <hr>
                <?php
                $sqlStmt = "SELECT * FROM Scripts WHERE Titel LIKE '%".$_GET["searchtitel"]."%' ORDER BY Datum DESC;";
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
                    	
                		<form action="scripts_search.php?searchtitel=<?php echo $_GET["searchtitel"]?>" method="post">
                		<?php
                    	$value = $mysqli->query("SELECT COUNT(id) as i FROM Scripts_Rating WHERE Script_id = '".$row['id']."' AND value = 1;");
        				$result2 = $value->fetch_assoc();
        				$value = $mysqli->query("SELECT COUNT(id) as i FROM Scripts_Rating WHERE Script_id = '".$row['id']."' AND value = -1;");
        				$result3 = $value->fetch_assoc();
        				$value = $mysqli->query("SELECT value as v FROM Scripts_Rating WHERE User_id = '".$userid."' AND Script_id = '".$row['id']."';");
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
                    	<input type="hidden" name="scriptid" value=<?php echo $row['id']?>/>
                    	<button type="submit" name="rate" value="1" style="background:none;color:inherit;"> &#128077; </button> <?php echo $result2['i']?> 
                    	<button type="submit" name="rate" value="-1" style="background:none;color:inherit;">&#128078; </button> <?php echo $result3['i']?> 
                    	</form>
                		</article>
                    	<?php
        				}
        				
        				if($found == 1)
        				{
        				    ?>
                    	<input type="hidden" name="scriptid" value=<?php echo $row['id']?>/>
                    	<button type="submit" name="rate" value="1" style="background:green;color:inherit;"> &#128077; </button> <?php echo $result2['i']?> 
                    	<button type="submit" name="rate" value="-1" style="background:none;color:inherit;">&#128078; </button> <?php echo $result3['i']?> 
                    	</form>
                		</article>
                    	<?php
        				}
        				
        				if($found == -1)
        				{
        				    ?>                  	
                    	<input type="hidden" name="scriptid" value=<?php echo $row['id']?>/>
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
        </div>
	</div>



    <!-- Scripts -->

    <script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>