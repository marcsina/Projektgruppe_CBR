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
    You are currently logged <?php echo $logged ?>.
     <?php
    if($logged == 'out')
    {
        ?>
        <form style="margin-top: 0px;" action="php/include/login_process.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <?php
    }
    else
    {
        ?>
        If you are done, please <a href="php/include/logout.php">log out</a>.
        <?php
    }
    ?>
        
	
    
    <div class="container">
    	<form action="forum.php" method="post">
    	<ul class="nav top">
            <li><a href="forum.php">Forum</a></li>
        </ul>
        </form>
    <br>  
       
    <table>
        <tr>
            <th style = "min-width: 200px">Nr</th>
            <th style = "min-width: 200px">Kategorie</th>
        </tr>
        <tr>
            <td>1</td>
            <td><a href="forum_demenz.php" style="color: black;text-decoration: none;">Demenz</a></td>
        </tr>
    </table>           
        
 	</div>
 	
 	
	<script src="js/jquery-2.2.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/snowball-german.js"></script>
    <script src="js/stopWords.js"></script>
    <script src="js/script.js"></script>
    <script src="js/autocomplete.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> 

</body>
</html>