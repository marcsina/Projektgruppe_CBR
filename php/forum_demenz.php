<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';
include_once 'include/functions_forum.php';

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
    $userid = $_SESSION['user_id'];
} else {
    $logged = 'out';
    header('Location: http://141.99.248.92/Projektgruppe/php/login.php?logged=0');
	exit;
    $username = 'anonymous';
}

if(isset($_POST["createtopic"]))
{
    if(isset($_POST["inserttopic"])&&isset($_POST["inserttext"])&&$_POST["inserttopic"]!=""&&$_POST["inserttext"]!="")
    {
        $value = $mysqli->query("SELECT id FROM Forum_Topic WHERE titel = '".$_POST["inserttopic"]."' LIMIT 1;");
        $result = $value->fetch_assoc();
        if (mysqli_num_rows($value) > 0) { 
            echo "topic existiert bereits";
        }
        else {
            CreateTopic($userid,$_POST["inserttopic"],$_POST["inserttext"],1,$mysqli);
            echo "topic erstellt";
        }

    }
    header('Location: forum_demenz.php');
    exit();
}

if(isset($_POST["createbeitrag"]))
{
    if(isset($_POST["inserttext"])&&$_POST["inserttext"]!="")
    {
        CreateBeitrag($userid,$_POST["topic"],$_POST["inserttext"],1,$mysqli);
    }
    header('Location: forum_demenz.php?topic='.$_POST["topic"].'');
    exit();
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
            <li ><a style = "font-weight: normal" href="forum.php">Forum</a></li>
            <li ><a style = "font-weight: normal" href="forum_demenz.php">-> Demenz</a></li>
        <?php
        if(isset($_GET["topic"]))
        {
            $value = $mysqli->query("SELECT name as n FROM Cases WHERE id = '".$_GET["topic"]."';");
            $result2 = $value->fetch_assoc();
            ?>
            <li ><a style = "font-weight: normal">-> Topic: <?php echo $result2['n']?></a></li>
            <?php
        }
        ?>
        </ul>
    <br>  
       
    	
    <?php
    if(isset($_GET["topic"]))
    {
        $value = $mysqli->query("SELECT name as t FROM Cases WHERE id = '".$_GET["topic"]."';");
        $result2 = $value->fetch_assoc();
        ?>
        <table style = "width: 100%;">
        <tr bgcolor = "#1a2732">
            <th >Thema:</th>
            <th ><?php echo $result2['t']?></th>
        </tr>
        </table>
        
        <?php 
        
        $value = $mysqli->query("SELECT text as tt FROM Cases WHERE id = '".$_GET["topic"]."';");
        $result2 = $value->fetch_assoc();
        
        ?>
        
        <table style = "width: 100%;">
        <tr bgcolor = "#2d4457">
        	
            <th style="color: white;font-weight: normal">
            <details>
        	<p>
            <?php echo $result2['tt']?>
            </p>
            </details>
            </th>
        </tr>
        </table>
        
        <br>
        <?php
        $sqlStmt = "SELECT * FROM Forum_Beitrag WHERE topic = '".$_GET['topic']."';";
        
        $result =  mysqli_query($mysqli,$sqlStmt);
        $data = array();
        if ($result = $mysqli->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                ?> 
                             
                
                	<?php
                	$value = $mysqli->query("SELECT username as n FROM members WHERE id = '".$row['user']."';");
                    $result2 = $value->fetch_assoc();
                    ?>
                <table style = "width: 100%;">
                <tr bgcolor = "#1a2732">  
                	<td style = "width: 200px"><div style="font-size: 12px;color: #007aff;"><?php echo $row['beitragsnr']?></div> </td>
                	<td><div style="font-size: 12px;color: #007aff;"><?php echo $row['datum']?></div></td>
                </tr>     
                <tr bgcolor = "#2d4457">
                    <td style = "vertical-align:top;padding:10px;font-color: white;font-weight: bold"><a href="profil.php?username=<?php echo $result2['n'] ?>" style = "color:white;"><?php echo $result2['n']?></a></td>
                    <td style = "padding:10px;font-color: white;"><?php echo $row['inhalt']?> <br> <br> </td>
                </tr> 
                </table>  
                <br>   
            	<?php
            	$i++;
            }
        
        // Objekt freigeben
        $result->free();
        }
    }
    else
    {
        ?>
        <table style = "width: 100%;">
        <tr bgcolor = "#1a2732">
            <th style = "min-width: 50px">Nr</th>
            <th style = "min-width: 200px">Topic</th>
            <th style = "min-width: 200px">Beiträge</th>
            <th style = "min-width: 200px">Letzter Beitrag</th>
        </tr>
        <?php
        /*$sqlStmt = "SELECT * FROM Forum_Topic WHERE kategorie = 1 ORDER BY id DESC;";*/
        $sqlStmt = "SELECT * FROM Cases ORDER BY id DESC;";
        $result =  mysqli_query($mysqli,$sqlStmt);
        $data = array();
        if ($result = $mysqli->query($sqlStmt))
        {
            $i=0;
            while ($row = $result->fetch_assoc())
            {
                ?>
                <form action="forum_demenz.php" method="get">
               	<tr bgcolor = "#2d4457">
               	
                <td><?php echo $row['id']?></td>
                
                <?php
                $value = $mysqli->query("SELECT text as tt FROM Cases WHERE id = '".$row['id']."';");
        		$result2 = $value->fetch_assoc();
        		?>
                
                <td><button class="nicehover" title="<?php echo substr($result2['tt'], 0, 1000)?>" type="submit" name="topic" value=<?php echo $row['id']?> style="height:100%;width:100%;text-align:left"><?php echo $row['name']?></button></td>
                <?php
                $value = $mysqli->query("SELECT COUNT(*) as total FROM Forum_Beitrag WHERE topic = '".$row['id']."';");
                $result2 = $value->fetch_assoc();
				?>
                <td><?php echo $result2['total']?></td>
                
                <?php
                $value = $mysqli->query("SELECT MAX(datum) as max FROM Forum_Beitrag WHERE topic = '".$row['id']."';");
                $result2 = $value->fetch_assoc();
				?>
                <td><?php echo date("d-m-Y ", strtotime($result2['max'])) ," at ", date(" H:i", strtotime($result2['max']))?></td>
                </tr>
                </form>
            	<?php
            	$i++;
            }
        
        // Objekt freigeben
        $result->free();
        } 
    }
    ?> 
    </table>           
    <?php    
    if(!isset($_GET["topic"]))
    {
       /* if($logged == 'in')
        {
            ?>
            <br><br>
            <a style="color: black;text-decoration: none;font-size: 25px;">Neues Thema</a>
            <form action="forum_demenz.php" method="post">
            Thema: <input type="text" name="inserttopic" id="topic"/><br><br>
            <textarea rows="8" cols="175" onclick="this.value=''" name="inserttext" id="text"> Enter text here...</textarea>
            <input type="submit" name="createtopic" value="Erstellen"/>
            </form>
            <?php
        } */
    }
    else 
    {
        if($logged == 'in')
        {
            ?>
            <br><br>
            <a style="color: white;text-decoration: none;font-size: 25px;">Neuer Beitrag</a>
            <form action="forum_demenz.php" method="post">
            <textarea class="col-lg-12 col-md-12 col-sm-12" rows="8" cols="175" onclick="this.value=''" name="inserttext" id="text" style="resize: none;border: 1px;border-style: solid;resize: vertical"> Enter text here...</textarea>
            <input name="topic" style="display:none" value=<?php echo $_GET["topic"]?>></input>
            <br>
            <br>
            <input type="submit" name="createbeitrag" value="Verschicken" style=" color: black"/>
            </form>
            <?php
        }
    }
    
    
    ?>
    
 	</div>
	<script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>