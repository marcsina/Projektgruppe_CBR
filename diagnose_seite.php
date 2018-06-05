<?php include_once 'php/include/conn.php'; ?>
<!doctype html>
<html lang="en">

    <!--Muss später am server eine php datei sein damit das geht -->
    

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <!-- user-scalable für mobile devices -->
        <meta name="description" content="...">
        <meta name="author" content="...">
        <title>MedAusbild</title>





        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <link href="css/style2.css" rel="stylesheet">

    </head>

<body id="home">
    <!-- include Navbar -->
	<?php
		include ("php/include/navbar.php");
	?>

	<span style="min-width:900px;text-align:center">

		<div class="col-md-offset-1 col-md-2 col-md-offset-1">

			<div class="white">
	
				<button type="button" class="btn btn-link"> 
					<div class="bloc">
						<img src="Fotos/Verhalten.jpg" class="img-circle" alt="Verhalten"  style="width:70px;height:70px;" />
							<br><B>Verhalten</B>
					</div>
				</button>
			</div>
		</div>

		<div class="col-md-offset-1 col-md-2 col-md-offset-1">
			<div class="white">
				<button type="button" class="btn btn-link">
					<div class="bloc">
						<img src="Fotos/photo_analyse.jpg" class="img-circle" alt="photo_analyse" style="width:70px;height:70px;"/>
							<br><B>Photo Analyse</B>
					</div>
				</button>
			</div>
		</div>
    
		<div class="col-md-offset-1 col-md-2 col-md-offset-1">
			<div class="white">
				<button type="button" class="btn btn-link">
					<div class="bloc">
						<img src="Fotos/graph.jpg" class="img-circle" alt="graph"  style="width:70px;height:70px;" />
							<br><B>Graph</B>
					</div>
				</button>
			</div>
		</div>
	</span>



	<div class="Fallbeschreibung_container">
		<div class="Fallbeschreibung col-md-6">
			<div class="well">
			   <p > <h4 class="text-justify"><B>Fallbeispiel 12: Alzheimer-Demenz</B></h4><br>
				66-jähriger Patient, geschieden, lebte bislang alleine in eigener Paterrewohnung in unmittelbarer Nachbarschaft zur Familie des Sohnes, in ländlicher Umgebung. Der Patient versorgte sich alleine, kaufte ein, machte sich sein Essen. Es gibt einen Aldi und einen Bäcker in der Nähe. Es gibt eine Arztpraxis mit drei Ärztinnen/Ärzten, die den ländlichen Bereich versorgen. Für größere Erledigungen muss er in den nächst größeren Ort, z. B. mit dem Auto oder mit den öffentlichen Verkehrsmitteln, fahren.
			</div>
        

			<section class="col-md-6">
				<div class="well">
					 <h4 class="text-center"><B> images</B></h4>
					 <a href="Fotos/alzheimer.jpg"><img src="Fotos/alzheimer.jpg" alt="Photo de innere_medizin" title="Cliquez pour agrandir" align="middle"  style="width:200px;height:100px;" /></a>
					 <a href="Fotos/alzheimer1.jpg"><img src="Fotos/alzheimer1.jpg" alt="Photo de innere_medizin" title="Cliquez pour agrandir" align="middle"  style="width:200px;height:100px;" /></a>
					 <a href="Fotos/alzheimer2.jpg"><img src="Fotos/alzheimer2.jpg" alt="Photo de innere_medizin" title="Cliquez pour agrandir" align="middle"  style="width:150px;height:100px;" /></a></div>
			</section>
        
			<div class="col-lg-12">
				<p ><h4 class="text-center"><B>Antwort </B></h4>
			</div>
		</div>
		<footer class="row">
			<div class="  col-md-offset-1 col-md-10 col-md-offset-1">
				<div class="well">
					<textarea rows="8" cols="175" onclick="this.value=''"> Enter text here...</textarea>
						<input type="submit" id="06_btn" class="btn btn-primary"  btn-xs name="submit" value="save" >
				</div>
			</div>
		</footer>   
	</div>

	<!-- second nested column -->
	<div class="col-md-12" align="right" >
	<!-- column content -->                 
		<button type="button" id="02_btn" class="btn btn-primary  btn-xs">submit</button>
		<button type="button" id="05_btn" class="btn btn-primary  btn-xs" >anderer_Fall</button>
	</div>


        <!--____________________________________________________________________________________________________-->


        <!-- Scripts -->
        <script src="js/german-porter-stemmer.js"></script>
        <script src="js/stopWords.js"></script>
        <script src="js/jquery-2.2.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>

</body>

</html>