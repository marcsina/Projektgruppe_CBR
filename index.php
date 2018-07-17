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
			<title>MedAusbild</title>

			  <!-- Bootstrap CSS -->
			  <link href="css/bootstrap.min.css" rel="stylesheet">
			  
			  <!--external css-->
			  <!-- font icon -->
			  
			  
			  <link href="css/font-awesome.min.css" rel="stylesheet" />
  
			  <!-- Custom styles -->
 
			  
  
			  <link href="css/style-responsive.css" rel="stylesheet" />
  
			  <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
 
		</head>

		<!-- include Navbar -->
		<?php
			include ("php/include/navbar.php");
		?>

    <body>
		
		

		


        <!-- _________________________Content________________________________-->
        

        <!-- Scripts -->
        <!--<script src="js/german-porter-stemmer.js"></script>-->
		<script src="js/snowball-german.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
		<script src="js/CBR.js"></script>
		<script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
		

    </body>

</html>