<?php
include_once 'php/include/conn.php';
include_once 'php/include/functions_login.php';

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <!-- user-scalable für mobile devices -->
    <meta name="description" content="...">
    <meta name="author" content="...">
    <title>MedAusbild Forum</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/style_forum.css" rel="stylesheet">

</head>
<body>

	<!-- include Navbar -->
    <?php
            include ("php/include/navbar.php");
    ?>
    
    
        
	
    
    <div class="container">
    	<form action="forum.php" method="post">
    	<ul class="nav top">
            <li><a href="forum.php">Forum</a></li>
        <?php
        if(isset($_POST["topic"]))
        {
            $value = $mysqli->query("SELECT kategorie as k FROM Forum_Topic WHERE id = '".$_POST["topic"]."';");
            $result2 = $value->fetch_assoc();
            $value2 = $mysqli->query("SELECT name as n FROM Forum_Kategorie WHERE id = '".$result2['k']."';");
            $result3 = $value2->fetch_assoc();
            ?>
            
            <li><a><button type="submit" name="kategorie" value=<?php echo $result2['k']?>>-><?php echo $result3['n']?></button></a></li>  
            
            <?php
            $value = $mysqli->query("SELECT titel as n FROM Forum_Topic WHERE id = '".$_POST["topic"]."';");
            $result2 = $value->fetch_assoc();
            ?>
            <li><a>-><?php echo $result2['n']?></a></li>
            <?php
        }
        else if(isset($_POST["kategorie"]))
        {
            $value = $mysqli->query("SELECT name as n FROM Forum_Kategorie WHERE id = '".$_POST["kategorie"]."';");
            $result2 = $value->fetch_assoc();
            ?>
            <li><a>-><?php echo $result2['n']?></a></li>
            <?php
        }
        ?>
        </ul>
        </form>
    <br>  
       
    <table>
    	
    <?php
    if(isset($_POST["topic"]))
    {
        $value = $mysqli->query("SELECT titel as t FROM Forum_Topic WHERE id = '".$_POST["topic"]."';");
        $result2 = $value->fetch_assoc();
        ?>
        <tr>
            <th style = "min-width: 200px">Thema</th>
            <th style = "min-width: 900px"><?php echo $result2['t']?></th>
            <th></th>
        </tr>
        <?php
        $sqlStmt = "SELECT * FROM Forum_Beitrag WHERE topic = '".$_POST['topic']."';";
        
        $result =  mysqli_query($mysqli,$sqlStmt);
        $data = array();
        if ($result = $mysqli->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                ?>                
                <tr style = "border: 1px solid black">
                	<?php
                	$value = $mysqli->query("SELECT username as n FROM members WHERE id = '".$row['user']."';");
                    $result2 = $value->fetch_assoc();
                    ?>
                    <td style = "border: 1px solid black;vertical-align:top;">Name: <?php echo $result2['n']?></td>
                    <td style = "border: 1px solid black"><?php echo $row['inhalt']?> <br><br>geschrieben am: <?php echo $row['datum']?></td>
                    <td style = "border: 1px solid black"><?php echo $row['beitragsnr']?></td>
                </tr>      
            	<?php
            }
        
        // Objekt freigeben
        $result->free();
        }
    }
    else if(isset($_POST["kategorie"]))
    {
        ?>
        <tr>
            <th style = "min-width: 200px">Nr</th>
            <th style = "min-width: 200px">Topic</th>
            <th style = "min-width: 200px">Beiträge</th>
            <th style = "min-width: 200px">Letzter Beitrag</th>
        </tr>
        <?php
        $sqlStmt = "SELECT * FROM Forum_Topic WHERE kategorie = '".$_POST['kategorie']."';";
        
        $result =  mysqli_query($mysqli,$sqlStmt);
        $data = array();
        if ($result = $mysqli->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                ?>
                <form action="forum.php" method="post">
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><button type="submit" name="topic" value=<?php echo $row['id']?>><?php echo $row['titel']?> </button></td>
                    <?php
                    $value = $mysqli->query("SELECT COUNT(*) as total FROM Forum_Beitrag WHERE topic = '".$row['id']."';");
                    $result2 = $value->fetch_assoc();
					?>
                    <td><?php echo $result2['total']?></td>
                    
                    <?php
                    $value = $mysqli->query("SELECT MAX(datum) as max FROM Forum_Beitrag WHERE topic = '".$row['id']."';");
                    $result2 = $value->fetch_assoc();
					?>
                    <td><?php echo $result2['max']?></td>
                </tr>
                </form>
            	<?php
            }
        
        // Objekt freigeben
        $result->free();
        }
    }
    else
    {
        ?>
        <tr>
            <th style = "min-width: 200px">Nr</th>
            <th style = "min-width: 200px">Kategorie</th>
        </tr>
        <?php
        
        $sqlStmt = "SELECT * FROM Forum_Kategorie;";
        
        $result =  mysqli_query($mysqli,$sqlStmt);
        $data = array();
        if ($result = $mysqli->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                ?>
                <form action="forum.php" method="post">
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><button type="submit" name="kategorie" value=<?php echo $row['id']?>><?php echo $row['name']?> </button></td>
                </tr>
                </form>
            	<?php
            }
        
        // Objekt freigeben
        $result->free();
        }
    }
    
    ?> 
    </table>           
        
 	</div>
	<script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/snowball-german.js"></script>
    <script src="js/stopWords.js"></script>
    <script src="js/script.js"></script>
    <script src="js/autocomplete.js"></script>

</body>
</html>