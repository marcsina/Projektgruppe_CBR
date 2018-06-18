<?php
include_once 'include/conn.php';
include_once 'include/functions_login.php';

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

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style2.css" rel="stylesheet">
    <link href="../css/style_forum.css" rel="stylesheet">

</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- role für browser zur erkennung-->
        <div class="container">
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <!-- erzeugen die 3 striche-->
                </button>
                <a class="navbar-brand" href="../index.php">MedAusbild</a>
                <!-- Titel der Navbar-->
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="menuItem">
                        <a href="../diag_seite_new.html">Diagnose</a>
                    </li>
                    <li class="menuItem">
                        <a href="../quiz1.html">Quiz</a>
                    </li>
                    <li class="menuItem">
                        <a href="../checker1.html">Checker</a>
                    </li>

                    <li class="menuItem">
                        <a href="#...">Classroom</a>
                    </li>
                    <li class="menuItem">
                        <a href="#...">Forum</a>
                    </li>
                    <li class="menuItem">
                        <a href="#contact">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--container-->
    </nav>
    
    
        
	
    
    <div class="container">
    
    	<ul class="nav top">
            <li><a href="forum.php">Forum</a></li>
        </ul>
    
    <br>  
       
    <table>
    	
    <?php
    
    if(isset($_POST["kategorie"]))
    {
        ?>
        <tr>
            <th>Nr</th>
            <th>Topic</th>
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
                    <td><?php echo $row['titel']?></td>
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
            <th>Nr</th>
            <th>Kategorie</th>
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
	<script src="../js/jquery-2.2.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/snowball-german.js"></script>
    <script src="../js/stopWords.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/autocomplete.js"></script>

</body>
</html>