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
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        
		<link href="../css/style3.css" rel="stylesheet">

    </head>

	<!-- _______________________________________NavBar_____________________________________________________-->
        <?php
        include ("php/include/navbar.php");
        ?>

    <body id="home">
        
        <!-- _________________________Content________________________________-->

		<div class="container">

			<!-- Header Row -->
			<div class="row newRow">
				<div class="col-md-6">
					<div class="col-md-3"> 
						<h4>Ihr Text</h4>
					</div>
					<div class="col-md-9">
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-8 col-sm-8">
						<h4>Gefundene Symptome</h4>
					</div>
					<div class=" col-md-3 col-sm-5">
						<div ><h4>Gewichtung</h4></div>
					</div>
				</div>
			</div>
			<!-- Content Row: User Text and found Symptoms --> 
			<div class="row">
				<div class="col-md-6">
					<section class ="tableau">
						<textarea class="textar" id="textarea_eingabe" name="textarea_eingabe"></textarea>
					</section>
				</div>

				<div class="col-md-6">
					<section id="section_symptoms" class="tableau"></section>
				</div>
			</div>											
			<!-- Button row -->
			<div class="row newRow">
				<div class="col-md-offset-5 col-xs-offset-right-5 col-md-2 col-sm-12">
					<button id="btn_submit" class=" btn btn-success" type="submit" align="center">Submit</button>
				</div>
			</div>
			<!-- 2nd Header Row -->
			<div class="row newRow">
				<h4 class="col-md-offset-3 col-md-1 col-sm-1">Resultat</h4>		
			</div>
			<!-- Result row -->
			<div class="row">
				<section class="col-md-offset-3 col-md-6 col-sm-12 col-xs-offset-right-3 tableau2">
					<div class="result" id='div_ausgabe'></div>
				</section>			
			</div>	
			
		


        <!-- Scripts -->
        <script src="../js/german-porter-stemmer.js"></script>
        <script src="../js/stopWords.js"></script>
        <script src="../js/jquery-2.2.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/script.js"></script>
		<script src="../js/CBR.js"></script>
		<script src="../js/snowball-german.js"></script>
		<script src="../js/Checker_text.js"></script>
		</div>

		<div id="txtHint" style="display:none"><b>Person info will be listed here...</b></div>
		<div id="pastHint" style="display:none"><b>Person info will be listed here...</b></div>
    </body>

</html>