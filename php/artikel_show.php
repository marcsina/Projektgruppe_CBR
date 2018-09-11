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
    
    header("Location: artikel_show.php?id=".$_GET["id"]."");
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
        <div class="row text-center col-md-offset-1 col-md-10">
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
    				
    				<form action="artikel_show.php?id=<?php echo $_GET["id"]?>" method="post">
    				<?php
    				$value = $mysqli->query("SELECT COUNT(id) as i FROM Artikel_Rating WHERE Artikel_id = '".$_GET["id"]."' AND value = 1;");
    				$result2 = $value->fetch_assoc();
    				$value = $mysqli->query("SELECT COUNT(id) as i FROM Artikel_Rating WHERE Artikel_id = '".$_GET["id"]."' AND value = -1;");
    				$result3 = $value->fetch_assoc();
    				$value = $mysqli->query("SELECT value as v FROM Artikel_Rating WHERE User_id = '".$userid."' AND Artikel_id = '".$_GET["id"]."';");
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
            		
                	<?php
    				}
    				?>
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
    <script>
    function insertArticleHistory(id1, id2)
    {
        $.post('include/functions_history.php',
        {
        function: "Insert_Activity_Article",
        user_id: id1,
        article_id: id2
        });
    }
    insertArticleHistory(<?php echo $userid ?>, <?php echo $_GET["id"] ?>);
    </script>
</body>
</html>